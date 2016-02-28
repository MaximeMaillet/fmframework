<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 26/02/2016
 * Time: 11:21
 */

namespace System\Exceptions;

class LibraryException extends FMException
{
    const DIRECTORY_NOT_FOUND = 'LE:001';
    const LIBRARY_NOT_FOUND = 'LE:002';

    public function __construct($message, $code, Exception $previous=null)
    {
        parent::__construct($message, $code, $previous);
    }
}