<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 28/02/2016
 * Time: 15:35
 */

namespace System\Exceptions;


class ViewException extends FMException
{
    const VIEW_NOT_FOUND = 'VE:001';

    public function __construct($message, $code, Exception $previous=null)
    {
        parent::__construct($message, $code, $previous);
    }
}