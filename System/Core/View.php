<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 25/02/2016
 * Time: 18:51
 */

namespace System\Core;
use System\Exceptions\ViewException;

class View
{
    private $_resources_path;
    protected $template_name;
    protected $datas = array();
    private $_header;

    public function __construct() {
        if(Main::getInstance()->isModDebug())
            Debug::addInstanciation(__CLASS__, get_class($this));

        $this->_resources_path = Main::getInstance()->getAppPath().'Resources'.DIRECTORY_SEPARATOR;
        $this->_header = array(
          'Content-Type' => 'text/html'
        );
    }

    private function detectHeader() {
        foreach($this->_header as $name => $value) {
            header($name.': '.$value);
        }
    }

    protected function render($template=null, $datas=array()) {
        if(!is_null($template))
            $template_name_file = $this->_resources_path.'Templates'.DIRECTORY_SEPARATOR.$template.'_template.php';
        else
            $template_name_file = $this->_resources_path.'Templates'.DIRECTORY_SEPARATOR.$this->template_name.'_template.php';

        $this->detectHeader();

        if(!file_exists($template_name_file))
            throw new ViewException('Template not found', ViewException::VIEW_NOT_FOUND);

        $final_datas = array_merge($this->datas, $datas);
        foreach ($final_datas as $key => $value) {
            $$key = $value;
        }

        include($template_name_file);
    }

    public function setHeader($name, $value) {
        $this->_header[$name] = $value;
    }

    public function setHeaders($arrayHeaders) {
        foreach($arrayHeaders as $headerName => $headerValue) {
            $this->setHeader($headerName, $headerValue);
        }
    }
}