<?php

namespace System\Core;

class Main
{
    /**
     * Environment constants
     */
    const ENVIRONMENT_PROD = 1;
    const ENVIRONMENT_PREPROD = 2;
    const ENVIRONMENT_TEST = 3;
    const ENVIRONMENT_DEV = 4;

    /**
     * Singleton - instance of Main
     * @var Main
     */
    private static $maininstance = null;

    /**
     * Path to System\ directory
     * @var string
     */
    private $_system_path;
    /**
     * Path to Application\ directory
     * @var string
     */
    private $_application_path;
    /**
     * Path to Configuration\ directory
     * @var string
     */
    private $_configuration_path;
    /**
     * Path to Libraries\ directory
     * @var string
     */
    private $_libraries_path;
    /**
     * Path to Logs\ directory
     * @var string
     */
    private $_logs_path;
    private $_main_url;
    /**
     * Instance list of working class
     * @var array
     */
    private $_instances;

    /**
     * Singleton
     * Main constructor.
     */
    private function __construct() {
        self::$maininstance = $this;
        $this->manageErrors();
        $this->loadPath();
        $this->loadClass();
    }

    /**
     * Singleton
     * Return instance of Main
     * @return Main
     */
    public static function getInstance() {

        if(is_null(self::$maininstance))
            new Main();

        return self::$maininstance;
    }

    private function manageErrors() {
        ini_set('display_errors', '1');
        error_reporting(E_ALL);

        set_error_handler(function($errno, $errstr, $errfile, $errline, array $errcontext) {

            echo 'CATCH ERRORS :<br>';
            echo 'N°'.$errno.' : '.$errstr.' ('.$errfile.' :: '.$errline.')';
        });
    }

    /**
     * Method which grab all patch for each directory of framework
     */
    private function loadPath() {
        $this->_main_url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'];
        $this->_system_path = INDEX_DIRECTORY.DIRECTORY_SEPARATOR.'System'.DIRECTORY_SEPARATOR;
        $this->_application_path = INDEX_DIRECTORY.DIRECTORY_SEPARATOR.'Application'.DIRECTORY_SEPARATOR;
        $this->_configuration_path = INDEX_DIRECTORY.DIRECTORY_SEPARATOR.'configuration'.DIRECTORY_SEPARATOR;
        $this->_libraries_path = INDEX_DIRECTORY.DIRECTORY_SEPARATOR.'Libraries'.DIRECTORY_SEPARATOR;
        $this->_logs_path = INDEX_DIRECTORY.DIRECTORY_SEPARATOR.'logs'.DIRECTORY_SEPARATOR;
    }

    /**
     * Method which load every class for framework works
     *  - Controller
     *  - Configuration
     *  - Routing
     *  - Debug (only in debug mod)
     */
    private function loadClass() {
        $this->_instances = array();

        $this->_instances['log'] = new Log();
        if(ENVIRONMENT == self::ENVIRONMENT_DEV) {
            $this->_instances['debug'] = new Debug();
            $this->_instances['panel'] = new Panel();
        }
        $this->_instances['controller'] = null;
        $this->_instances['configuration'] = new Configuration();
        $this->_instances['routing'] = new Routing();
        $this->_instances['modules'] = array();
        foreach(scandir(Main::getInstance()->getSystemPath().'Modules') as $filename) {
            if($filename != '.' && $filename != '..') {

                if(array_key_exists($filename, $this->configuration->modules))
                {
                    if($this->configuration->modules[$filename]['active']) {
                        $class_name = '\System\Modules\\'.$filename.'\Main';
                        $this->_instances[$filename] = new $class_name();
                        $this->_instances[$filename]->launch();
                    }
                }
            }
        }

    }

    /**
     * Return application path, a directory where user can create her system
     * @return string
     */
    public function getAppPath() {
        return $this->_application_path;
    }

    /**
     * Return controller path, a directory where user can create her controllers
     * @return string
     */
    public function getOwnControllersPath() {
        return $this->getAppPath().DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR;
    }

    /**
     * Return model path, a directory where user can create her models
     * @return string
     */
    public function getOwnModelsPath() {
        return $this->getAppPath().DIRECTORY_SEPARATOR.'Models'.DIRECTORY_SEPARATOR;
    }

    /**
     * Return libraries path, a directory where user can import libraries or create her own library
     * @return mixed
     */
    public function getLibrariesPath() {
        return $this->_libraries_path;
    }

    /**
     * Return configuration path, a directory where there is all configuration files
     * @return mixed
     */
    public function getConfigurationPath() {
        return $this->_configuration_path;
    }

    public function getSystemPath() {
        return $this->_system_path;
    }

    public function getLogsPath() {
        return $this->_logs_path;
    }

    public function getMainUrl() {
        return $this->_main_url;
    }

    /**
     * Magic method get which return an instance of Debug, Controller, Configuration or Routing.
     * @param string $name
     * @return stdClass
     */
    public function __get($name) {
        if(array_key_exists(strtolower($name), $this->_instances))
            return $this->_instances[strtolower($name)];
    }

    /**
     * Magic method set which set an instance of Debug, Controller, Configuration or Routing.
     * @param string $name
     * @param stdClass $value
     */
    public function __set($name, $value) {
        if(array_key_exists(strtolower($name), $this->_instances)) {
            $this->_instances[strtolower($name)] = $value;
        }
    }

    /**
     * Method which return true or false if current mod is on debug
     * @return bool
     */
    public function isModDebug() {
        if(isset($this->_instances['debug']) && !is_null($this->_instances['debug']))
            return true;
        return false;
    }
}