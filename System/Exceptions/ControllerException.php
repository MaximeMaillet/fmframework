<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 25/02/2016
 * Time: 21:07
 */

namespace System\Exceptions;


class ControllerException extends FMException
{
    public function __construct($message, $code, Exception $previous=null)
    {
        parent::__construct($message, $code, $previous);
    }
}