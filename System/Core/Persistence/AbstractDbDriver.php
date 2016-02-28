<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 26/02/2016
 * Time: 14:58
 */

namespace System\Core\Persistence;
use System\Core;

abstract class AbstractDbDriver
{
    protected $_connection;

    protected function __construct() {
        if(Core\Main::getInstance()->isModDebug())
            Core\Debug::addInstanciation(__CLASS__, get_class($this));
    }

    abstract public function connect($datas);
    abstract protected function checkConnectionDatas($datas);
    abstract public function query($sql, $parameters=null);
    abstract public function result($args=array());

    public function getConnection() {
        return $this->_connection;
    }
}