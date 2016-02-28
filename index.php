<?php

define('INDEX_DIRECTORY', __DIR__);
define('ENVIRONMENT', \System\Core\Main::ENVIRONMENT_DEV);

function __autoload($class_name) {
    $directory_array  = explode('\\', $class_name);
    $class_path = __DIR__;
    foreach($directory_array as $directory) {
        $class_path .= DIRECTORY_SEPARATOR.$directory;
    }

    require_once $class_path . '.php';
}

try {
    $_instance = \System\Core\Main::getInstance();

    if($_instance->isModDebug())
        \System\Core\Debug::show();
}
catch(Exception $e) {
    echo $e;
}