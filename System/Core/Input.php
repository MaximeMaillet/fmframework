<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 25/02/2016
 * Time: 15:09
 */

namespace System\Core;


class Input
{
    private $_request_method;
    private $_headers;
    private $_datas;

    public function __construct()
    {
        if(Main::getInstance()->isModDebug())
            Debug::addInstanciation(__CLASS__);

        $this->_request_method = $_SERVER['REQUEST_METHOD'];
        $this->_headers = getallheaders();
        $this->_datas = array();
        $this->filterReceiveDatas($_GET);
        $this->filterReceiveDatas($_POST);
    }

    private function filterReceiveDatas($datas) {
        if(isset($datas)) {
            foreach($datas as $key => $value) {
                $this->_datas[htmlspecialchars($key)] = htmlspecialchars($value);
            }
        }
    }

    public function getRequestMethod() {
        return $this->_request_method;
    }

    public function getHeader($key) {
        return $this->_headers[$key];
    }
}