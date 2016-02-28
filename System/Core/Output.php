<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 25/02/2016
 * Time: 15:09
 */

namespace System\Core;
use System\Exceptions\HTTPSSTATUS_Exception;

class Output
{
    private $_headers;
    private $_status;

    public function __construct()
    {
        if(Main::getInstance()->isModDebug())
            Debug::addInstanciation(__CLASS__);
    }

    public function setHeaders($arrayKeyValue) {
        $this->_headers = $arrayKeyValue;
    }

    public function setHeader($key, $value) {
        $this->_headers[$key] = $value;
    }

    public function setResponseStatus($status) {
        if(!array_key_exists($status, Constantes::$HTTP_RESPONSE_STATUS))
            throw new HttpstatusException('HTTP status is incorrect', 'H001');

        $this->_status = $status;
    }
}