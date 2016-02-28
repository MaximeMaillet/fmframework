<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 28/02/2016
 * Time: 19:39
 */

namespace System\Modules\Panel;

class PanelView
{
    private $_module_path;
    private $_main_url;

    public function __construct($module_path, $main_url) {
        $this->_module_path = $module_path;
        $this->_main_url = $main_url;
    }

    public function render($datas) {
        $this->renderHeader();
        $this->renderBottomBar($datas);
        $this->renderFooter();
    }

    private function renderBottomBar($datas) {
        $this->includeFile('bottomBar', $datas);
    }

    private function renderHeader() {
        $this->includeFile('header', $this->generateCss());
    }

    private function renderFooter() {
        $this->includeFile('footer');
    }

    private function includeFile($filename, $datas=null) {
        $template_name_file = $this->_module_path.'Resources'.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.$filename.'.php';

        if(!file_exists($template_name_file))
            throw new \Exception('Template not found');

        if(!is_null($datas)) {
            foreach ($datas as $key => $value) {
                $$key = $value;
            }
        }

        include($template_name_file);
    }

    private function generateCss() {
        $template_name_file = $this->_main_url.'Resources'.DIRECTORY_SEPARATOR.'css'.DIRECTORY_SEPARATOR.'main.css';
        return array('maincss' => $template_name_file);
    }
}