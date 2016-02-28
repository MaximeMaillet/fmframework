<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 28/02/2016
 * Time: 19:28
 */

namespace System\Core;

abstract class AbstractModule
{
    protected function __construct() {
        if(Main::getInstance()->isModDebug())
            Debug::addInstanciation(__CLASS__, get_class($this));
    }

    protected function getModulePath() {
        return \System\Core\Main::getInstance()->getSystemPath().DIRECTORY_SEPARATOR.'Modules'.DIRECTORY_SEPARATOR;
    }

    protected function getMainUrl() {
        return \System\Core\Main::getInstance()->getMainUrl();
    }

    abstract public function launch();
}