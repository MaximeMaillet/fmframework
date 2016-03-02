<?php

namespace Application\Controllers;
use System\Core\Controller;
use System\Core\Debug;

class User extends Controller
{
    public function __construct() {
        Debug::addLog("coucou");
        parent::__construct();
    }

    public function isi() {

        $result = $this->getModel()->isi();
        $this->view->isi($result);
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