<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 26/02/2016
 * Time: 00:56
 */

namespace System\Core;


use System\Exceptions\ConfigurationException;

class Configuration
{
    private $_items;

    public function __construct() {
        if(Main::getInstance()->isModDebug())
            Debug::addInstanciation(__CLASS__);
        $this->_items = array();
        $this->loadFiles();
    }

    private function loadFiles() {
        foreach(scandir(Main::getInstance()->getConfigurationPath()) as $filename) {
            if(substr($filename, -4) == 'json') {
                $this->loadFile(Main::getInstance()->getConfigurationPath().$filename);
            }
        }
    }

    private function loadFile($configuration_file_path) {
        $contentfile = @file_get_contents($configuration_file_path);
        $contentfile = json_decode($contentfile, true);
        if(is_array($contentfile)) {
            $this->_items[key($contentfile)] = $contentfile[key($contentfile)];
        }
    }

    public function getFMDriver() {
        $stringReturn = '';
        if(isset($this->database['driver']))
            $stringReturn .= 'fmdriver:'.$this->database['driver'].';';
        else
            throw new ConfigurationException('Driver not found in configuration file', ConfigurationException::CONFIGURATION_ITEM_NOT_FOUND);

        if(isset($this->database['type']))
            $stringReturn .= 'type:'.$this->database['type'].';';
        else
            throw new ConfigurationException('Type database not found in configuration file', ConfigurationException::CONFIGURATION_ITEM_NOT_FOUND);

        if(isset($this->database['host']))
            $stringReturn .= 'host:'.$this->database['host'].';';
        else
            throw new ConfigurationException('Host not found in configuration file', ConfigurationException::CONFIGURATION_ITEM_NOT_FOUND);

        if(isset($this->database['dbname']))
            $stringReturn .= 'dbname:'.$this->database['dbname'].';';
        else
            throw new ConfigurationException('Database name not found in configuration file', ConfigurationException::CONFIGURATION_ITEM_NOT_FOUND);

        if(isset($this->database['dbuser']))
            $stringReturn .= 'dbuser:'.$this->database['dbuser'].';';
        else
            throw new ConfigurationException('Database user not found in configuration file', ConfigurationException::CONFIGURATION_ITEM_NOT_FOUND);

        if(isset($this->database['dbpassword']))
            $stringReturn .= 'dbpassword:'.$this->database['dbpassword'];
        else
            throw new ConfigurationException('Database password not found in configuration file', ConfigurationException::CONFIGURATION_ITEM_NOT_FOUND);

        return $stringReturn;
    }

    public function __get($name) {
        if(array_key_exists($name, $this->_items))
            return $this->_items[$name];
        else
            throw new ConfigurationException($name.' is not an item of configuration', ConfigurationException::CONFIGURATION_ITEM_NOT_FOUND);
    }
}