<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 26/02/2016
 * Time: 10:13
 */

namespace System\Core;


class Method
{
    private $_method_name;
    private $_Controller;
    private $_parameters;

    public function __construct($Controller, $methodName, $parameters=array()) {
        if(Main::getInstance()->isModDebug())
            Debug::addInstanciation(__CLASS__);

        $this->_Controller = $Controller;
        $this->_method_name = $methodName;
        $this->_parameters = $parameters;
    }

    public function getName() {
        return $this->_method_name;
    }
}