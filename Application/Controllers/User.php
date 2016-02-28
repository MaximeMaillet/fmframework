<?php

namespace Application\Controllers;
use System\Core\Controller;

class User extends Controller
{
    public function __construct() {
        parent::__construct();
    }

    public function isi() {
        $this->loadLibrary('Curl');
        $this->loadLibrary('Curl', 'MyCurl');
        $this->loadLibrary('Facebook/MyFacebook');
        $this->getModel()->isi();
    }

    public function _1_isi() {

    }

    public function _2_isi() {
        echo'<hr>';
        echo __METHOD__;
        echo'<hr>';
    }

    public function _2_0_isi() {
        echo'<hr>';
        echo __METHOD__;
        echo'<hr>';
    }

    public function _2_1_1_isi() {
        echo'<hr>';
        echo __METHOD__;
        echo'<hr>';
    }
}