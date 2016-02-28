<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 26/02/2016
 * Time: 15:28
 */

namespace System\Exceptions;

class DatabaseException extends FMException
{
    const DATABASE_NO_DRIVER_FOUND = 'DE:001';
    const DATABASE_INSTANCE_NOT_EXISTS = 'DE:002';
    const FMDRIVER_TYPE_NOT_FOUND = 'DE:OO2';
    const FMDRIVER_TYPE_NOT_EXISTS = 'DE:003';
    const FMDRIVER_HOST_NOT_FOUND = 'DE:004';
    const FMDRIVER_DATABASENAME_NOT_FOUND = 'DE:005';
    const FMDRIVER_USER_NOT_FOUND = 'DE:006';
    const FMDRIVER_PASSWORD_NOT_FOUND = 'DE:007';
    const FMDRIVER_PDO_EXCPETION = 'DE:008';

    public function __construct($message, $code, Exception $previous=null)
    {
        parent::__construct($message, $code, $previous);
    }
}