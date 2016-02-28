<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 26/02/2016
 * Time: 01:35
 */

namespace System\Core;

class Debug
{
    private static $_instanciations = array();
    private static $_log = array();

    public static function addInstanciation($controllerNameParent, $controllerNameChild=null) {
        if(!is_null($controllerNameChild) && $controllerNameParent != $controllerNameChild)
            self::$_instanciations[] = array('parent' => $controllerNameParent, 'child' => $controllerNameChild);
        else
            self::$_instanciations[] = $controllerNameParent;
    }

    public static function printr($var) {
        echo'<pre>';
        if(is_null($var))
            echo '(NULL)';
        else if(is_bool($var))
            echo ($var ? 'TRUE' : 'FALSE');
        else
            print_r($var);
        echo'</pre>';
    }

    public static function addLog($text) {

        $backtrace = debug_backtrace();
        $datetime = '['.date("d/m/Y H:i:s").']';

        self::$_log[] = $datetime.' (File:'.$backtrace[0]['file'].') ; (Line:'.$backtrace[0]['line'].') :: '.$text;
    }

    public static function show() {
        echo'<p>';
        foreach(self::$_instanciations as $Instance) {
            if(is_array($Instance))
                echo 'Parent('.$Instance['parent'].') => Child('.$Instance['child'].')<br>';
            else
                echo $Instance.'<br>';

        }
        echo'</p>';

        if(isset(self::$_log) && !empty(self::$_log)) {
            echo '<h1>Logs</h1>';
            foreach (self::$_log as $line) {
                echo $line.'<br>';
            }
        }
    }
}