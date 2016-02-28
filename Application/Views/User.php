<?php

namespace Application\Views;
use System\Core\View;

class User extends View
{
    public function __construct() {
        parent::__construct();
    }

    public function isi($result) {
        $this->render('json', array('racine' => $result));
    }
}