<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 25/02/2016
 * Time: 18:42
 */

namespace System\Core;


class Constantes
{
    const HTTP_RESPONSE_STATUS_200 = 200;
    const HTTP_RESPONSE_STATUS_404 = 404;
    const HTTP_RESPONSE_STATUS_500 = 500;

    public static $HTTP_RESPONSE_STATUS = array(
        self::HTTP_RESPONSE_STATUS_200 => 200,
        '404' => 404,
        '500' => 500,
    );
}