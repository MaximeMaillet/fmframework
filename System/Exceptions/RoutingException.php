<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 25/02/2016
 * Time: 21:20
 */

namespace System\Exceptions;

class RoutingException extends FMException
{
    const VERSION_INCORRECT = 'RE:001';
    const VERSION_UNAVAILABLE = '';
    const CONTROLLER_NOT_FOUND = 'RE:002';
    const MODEL_NOT_FOUND = 'RE:003';
    const MODEL_NAME_FORBIDDEN = 'RE:004';
    const METHOD_NOT_FOUND = 'RE:005';

    public function __construct($message, $code, Exception $previous=null)
    {
        parent::__construct($message, $code, $previous);
    }
}