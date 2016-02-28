<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 26/02/2016
 * Time: 14:48
 */

namespace System\Exceptions;

class ModelException extends \Exception
{
    const TABLE_NAME_REQUIRED = 'ME:001';

    public function __construct($message, $code, Exception $previous=null)
    {
        parent::__construct($message, $code, $previous);
    }
}