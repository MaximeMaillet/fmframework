<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 28/02/2016
 * Time: 11:58
 */

namespace System\Core;


use System\Exceptions\LogException;

class Log
{
    public function __construct() {
    }

    public static function add($text, $filename='logs') {

        try {
            $backtrace = debug_backtrace();
            $fileName = Main::getInstance()->getLogsPath().$filename.'_'.date('d-m-Y', time()).'.log';
            $fp = fopen($fileName, "a+");

            if (!$fp) {
                throw new LogException('File open failed.');
            }

            $completeText = 'Line:'.$backtrace[0]['line'].';File:'.$backtrace[0]['file'].' ['.date('d/m/Y H:i:s', time()).'] :: '.$text;
            fwrite($fp, $completeText);

            fclose($fp);

        }
        catch(\Exception $e) {
            throw new LogException($e->getMessage(), $e->getCode());
        }
        catch(LogException $e) {
            throw $e;
        }
    }
}