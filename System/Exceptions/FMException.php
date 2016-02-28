<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 25/02/2016
 * Time: 22:50
 */

namespace System\Exceptions;


class FMException extends \Exception
{
    protected $_error_code;

    public function __construct($message, $code, Exception $previous=null)
    {
        parent::__construct($message, null, $previous);
        $this->_error_code = $code;

    }

    public function getErrorCode() {
        return $this->_error_code;
    }

    public function __toString()
    {
        return get_class($this).' (ERR::'.$this->getErrorCode().') --> '.$this->getMessage();
    }
}