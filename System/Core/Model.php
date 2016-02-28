<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 26/02/2016
 * Time: 14:32
 */

namespace System\Core;

use System\Core\Persistence\Database;
use System\Exceptions\ModelException;

class Model
{
    private $_table_name;
    private $_database_connection;

    public function __construct($table_name) {
        if(Main::getInstance()->isModDebug())
            Debug::addInstanciation(__CLASS__, get_class($this));

        if(!isset($table_name) || is_null($table_name) || empty($table_name))
            throw new ModelException('Table name is not defined', ModelException::TABLE_NAME_REQUIRED);

        $this->_table_name = $table_name;
        $this->_database_connection = Database::build(Main::getInstance()->configuration->getFMDriver());
    }

    public function DB() {
        return $this->_database_connection;
    }

    protected function create() {

    }

    protected function read() {

    }

    protected function update() {

    }

    protected function delete() {

    }
}