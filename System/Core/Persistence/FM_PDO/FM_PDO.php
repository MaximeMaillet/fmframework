<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 26/02/2016
 * Time: 15:07
 */

namespace System\Core\Persistence\FM_PDO;
use System\Core\Persistence\AbstractDbDriver;
use System\Exceptions\DatabaseException;
use PDO;

class FM_PDO extends AbstractDbDriver
{
    private $_drivers_list;
    private $_pdo_statment;

    public function __construct() {
        parent::__construct();
        $this->_drivers_list = array(
            'mysql'
        );
    }

    public function connect($datas) {
        try {

            if($this->checkConnectionDatas($datas)) {
                try {
                    $this->_connection = new \PDO($datas['type'].':host='.$datas['host'].';dbname='.$datas['dbname'], $datas['user'], $datas['password']);
                }
                catch(\PDOException $e) {
                    throw new DatabaseException('PDOException : ('.$e->getCode().')'.$e->getMessage(), DatabaseException::FMDRIVER_PDO_EXCPETION);
                }
            }
        }
        catch(DatabaseException $e) {
            throw $e;
        }
    }

    protected function checkConnectionDatas($datas)
    {
        if(!isset($datas['type']) || empty($datas['type']))
            throw new DatabaseException('No driver found', DatabaseException::DATABASE_NO_DRIVER_FOUND);

        if(!in_array($datas['type'], $this->_drivers_list))
            throw new DatabaseException('Driver ('.$datas['type'].') does not exists', DatabaseException::DRIVER_NOT_EXISTS);

        if(!isset($datas['host']) || empty($datas['host']) || is_null($datas['host']))
            throw new DatabaseException('Host not found', DatabaseException::FMDRIVER_HOST_NOT_FOUND);

        if(!isset($datas['dbname']) || empty($datas['dbname']) || is_null($datas['dbname']))
            throw new DatabaseException('Databse name not found', DatabaseException::FMDRIVER_DATABASENAME_NOT_FOUND);

        if(!isset($datas['user']) || empty($datas['user']) || is_null($datas['user']))
            throw new DatabaseException('User not found', DatabaseException::FMDRIVER_USER_NOT_FOUND);

        if(!isset($datas['password']) || empty($datas['password']) || is_null($datas['password']))
            throw new DatabaseException('Password not found', DatabaseException::FMDRIVER_PASSWORD_NOT_FOUND);

        return true;
    }

    public function query($sql, $parameters=null) {
        try {
            $this->_pdo_statment = $this->_connection->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $this->_pdo_statment->execute($parameters);
            return $this->_pdo_statment;
        }
        catch(\PDOException $e) {
            throw new DatabaseException('PDOException : ('.$e->getCode().')'.$e->getMessage(), DatabaseException::FMDRIVER_PDO_EXCPETION);
        }
    }

    public function result($args=array())
    {
        try {
            return $this->_pdo_statment->fetchAll();
        }
        catch(\PDOException $e) {
            throw new DatabaseException('PDOException : ('.$e->getCode().')'.$e->getMessage(), DatabaseException::FMDRIVER_PDO_EXCPETION);
        }
    }
}