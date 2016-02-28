<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 28/02/2016
 * Time: 19:39
 */

namespace System\Modules\Panel;

class PanelModel
{
    public function __construct($module_path) {
    }

    public function getDatas() {
        return array('ok' => 1);
    }
}