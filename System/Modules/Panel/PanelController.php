<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 28/02/2016
 * Time: 19:39
 */

namespace System\Modules\Panel;

class PanelController
{
    private $_model;
    private $_view;

    public function __construct($module_path, $main_url) {
        $this->_model = new PanelModel($module_path);
        $this->_view = new PanelView($module_path, $main_url);
    }

    public function main() {
        $datas = array(
            'instances' => $this->_model->getInstanciations(),
            'logs' => $this->_model->getLogs()
        );
        $this->_view->render($datas);
    }
}