<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 25/02/2016
 * Time: 15:10
 */

namespace System\Core;
use \Application\Models;

class Controller
{
    private $_call_method;

    public function __construct()
    {
        if(Main::getInstance()->isModDebug())
            Debug::addInstanciation(__CLASS__, get_class($this));

        $model_class_name = '\Application\Models\\'.$this->getName();
        $view_class_name = '\Application\Views\\'.$this->getName();

        $this->_instances = array(
            'model' => new $model_class_name(),
            'view' => new $view_class_name(),
            'library' => new Library(),
            'input' => new Input(),
            'output' => new Output(),
        );
    }

    private function getName() {
        $class_name_complete = get_class($this);
        return substr($class_name_complete, strrpos($class_name_complete, '\\')+1);
    }

    public function setCallMethod(Method $method) {
        $this->_call_method = $method;
    }

    public function getCallMethod() {
        return $this->_call_method;
    }

    protected function input() {
        return $this->_instances['input'];
    }

    protected function output() {
        return $this->_instances['output'];
    }

    protected function loadLibrary($name, $label=null) {
        $this->library->load($name, $label);
    }

    protected function getModel() {
        return $this->_instances['model'];
    }

    public function __get($name) {
        if(array_key_exists(strtolower($name), $this->_instances))
            return $this->_instances[strtolower($name)];
    }

    public function main() {
        echo'<p>MAIN</p>';
    }
}