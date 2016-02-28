<?php

namespace Libraries;

/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 26/02/2016
 * Time: 11:10
 */
class Curl
{
    public function __construct() {
    }

    public function tcurl() {
        echo 'tcurl<br>';
    }

    public function tcurl2() {
        echo 'tcurl2<br>';
    }

    private $_oui = 'OUI';

    public function setOui($oui) {
        $this->_oui = $oui;
    }

    public function getOui() {
        return $this->_oui;
    }
}