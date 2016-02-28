<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 26/02/2016
 * Time: 01:31
 */

namespace System\Exceptions;

class ConfigurationException extends FMException
{
    const CONFIGURATION_ITEM_NOT_FOUND = 'CE:001';

    public function __construct($message, $code, Exception $previous=null)
    {
        parent::__construct($message, $code, $previous);
    }
}