<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 26/02/2016
 * Time: 15:06
 */

namespace System\Core\Persistence;

use System\Core\Persistence\FM_PDO\FM_PDO;
use System\Exceptions\DatabaseException;

class Database
{
    private static $datasConnection;
    private static $db_instance = null;
    /**
     * Create database connection according to FM Driver
     *      - Example : fmdriver:pdo;type:mysql;host:localhost;dbname:test;dbuser:Max;dbpassword:mypassword
     * @param string $FM_driver
     */
    public static function build($FM_driver) {

        $arrayDatasConnection = explode(';', $FM_driver);
        self::$datasConnection = array();
        foreach($arrayDatasConnection as $datas) {
            if(isset($datas) && !empty($datas))
                $array = explode(':', $datas);
            self::$datasConnection[$array[0]] = $array[1];
        }

        if(isset(self::$datasConnection['fmdriver']) && self::$datasConnection['fmdriver'] == 'pdo')
            self::$db_instance = new FM_PDO();

        if(is_null(self::$db_instance))
            throw new DatabaseException('No driver found for '.$FM_driver, DatabaseException::DATABASE_NO_DRIVER_FOUND);

        self::$db_instance->connect(array(
            'type' => self::$datasConnection['type'],
            'host' => self::$datasConnection['host'],
            'dbname' => self::$datasConnection['dbname'],
            'user' => self::$datasConnection['dbuser'],
            'password' => self::$datasConnection['dbpassword']
        ));

        return self::$db_instance;
    }

    public static function getDbInstance() {
        if(is_null(self::$db_instance))
            throw new DatabaseException('Instance does not exists', DatabaseException::DATABASE_INSTANCE_NOT_EXISTS);
        return self::$db_instance;
    }
}