<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 28/02/2016
 * Time: 12:10
 */

namespace System\Exceptions;


class LogException extends FMException
{
    const LOGFILE_NOT_FOUND = 'LG:001';
    const LOG_OPEN_FAILDED = 'LG:002';

    public function __construct($message, $code, Exception $previous=null)
    {
        parent::__construct($message, $code, $previous);
    }
}