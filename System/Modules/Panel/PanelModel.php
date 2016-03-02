<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 28/02/2016
 * Time: 19:39
 */

namespace System\Modules\Panel;

use System\Core\Debug;

class PanelModel
{
    public function __construct($module_path) {
    }

    public function getInstanciations() {
        return Debug::getInstanciations();
    }

    public function getLogs() {
        return Debug::getLogs();
    }
}