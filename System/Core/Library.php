<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 25/02/2016
 * Time: 14:53
 */

namespace System\Core;


use System\Exceptions\LibraryException;

class Library
{
    const LIBRARY_DEFAULT_NAMESPACE = '\Libraries\\';

    private $_instances;

    public function __construct()
    {
        if(Main::getInstance()->isModDebug())
            Debug::addInstanciation(__CLASS__);

        $this->_instances = array();
    }

    public function load($name, $label=null) {
        $filename = Main::getInstance()->getLibrariesPath().$name.'.php';
        if(!is_dir(dirname($filename)))
            throw new LibraryException($name.' : directory not found', LibraryException::DIRECTORY_NOT_FOUND);

        if(!is_file($filename))
            throw new LibraryException($name.' : library not found', LibraryException::LIBRARY_NOT_FOUND);

        $file_class = str_replace('/', '\\', str_replace(Main::getInstance()->getLibrariesPath(), '', $filename));
        $name_class = substr(self::LIBRARY_DEFAULT_NAMESPACE.$file_class, 0, -4);

        if(!is_null($label))
            $key = $label;
        else
            $key = substr($name_class, strrpos($name_class, '\\')+1);

        $this->_instances[strtolower($key)] = new $name_class();
    }

    public function __get($name) {
        if(array_key_exists(strtolower($name), $this->_instances))
            return $this->_instances[strtolower($name)];
    }
}