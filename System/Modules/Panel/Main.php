<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 28/02/2016
 * Time: 19:34
 */

namespace System\Modules\Panel;

class Main extends \System\Core\AbstractModule
{
    private $_controller;

    public function __construct() {
        parent::__construct();
        $this->_controller = new PanelController($this->getModulePath().'Panel'.DIRECTORY_SEPARATOR, $this->getMainUrl());
    }

    public function getMainUrl() {
        $mainurl = parent::getMainUrl();
        $mainurl .= '/System/Modules/Panel/';
        return $mainurl;
    }

    public function launch()
    {
        header('Content-Type: text/html');
        $this->_controller->main();
    }
}