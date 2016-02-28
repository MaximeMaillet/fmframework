<?php
/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 25/02/2016
 * Time: 21:09
 */

namespace System\Core;


use System\Exceptions\RoutingException;

class Routing
{
    private static $CONTROLLERS_DEFAULT_NAMESPACE = '\Application\Controllers\\';

    private $_version = null;

    public function __construct()
    {
        $mainInstance = Main::getInstance();
        if($mainInstance->isModDebug())
            Debug::addInstanciation(__CLASS__);

        $arrayURL = explode('/', substr($_SERVER['REQUEST_URI'], 11));

        if($mainInstance->configuration->main['useVersion'])
            $this->checkVersion($arrayURL);
        else {
            unset($arrayURL[0]);
            $arrayURL = array_values($arrayURL);
        }
        $this->checkRoute($arrayURL);
        $this->checkClass($arrayURL);
        $this->checkMethod($arrayURL);
        $this->callRoute();
    }

    private function checkVersion(&$arrayURI) {

        if(isset($arrayURI[0]) && preg_match('/^(\d+\.)?(\d+\.)?(\*|\d+)$/', $arrayURI[0]) == 1) {
            $this->_version = $arrayURI[0];
            unset($arrayURI[0]);
            $arrayURI = array_values($arrayURI);
        }
        else
            throw new RoutingException('Version format not allowed', RoutingException::VERSION_INCORRECT);
    }

    private function explodeURI($URI) {
        if(substr($URI, 0, 1) == '/')
            return explode('/', substr($URI, 1));

        return explode('/', $URI);
    }

    private function checkRoute(&$arrayURI) {

        if(Main::getInstance()->configuration->main['useRouting']) {
            foreach(Main::getInstance()->configuration->routes as $oldroute => $newRoute) {
                $arrayOldRoute = $this->explodeURI($oldroute);

                if($arrayOldRoute[0] == $arrayURI[0]) {
                    $arrayNewRoute = $this->explodeURI($newRoute);

                    $arrayURI[0] = $arrayNewRoute[0];
                    if($arrayOldRoute[1] == $arrayURI[1]) {
                        $arrayURI[1] = $arrayNewRoute[1];
                    }
                }
            }
        }
    }

    private function checkClass(&$arrayURI) {

        if(!isset($arrayURI[0]))
            throw new RoutingException('This call has no controller', RoutingException::CONTROLLER_NOT_FOUND);

        if(!is_file(MAIN::getInstance()->getOwnControllersPath().ucfirst($arrayURI[0].'.php')))
            throw new RoutingException($arrayURI[0].' :: Controller does not exists', RoutingException::CONTROLLER_NOT_FOUND);

        $nameclass = self::$CONTROLLERS_DEFAULT_NAMESPACE.$arrayURI[0];
        Main::getInstance()->controller = new $nameclass();
    }

    private function checkMethod(&$arrayURI) {
        $currentMethods = get_class_methods(Main::getInstance()->controller);

        if(substr($arrayURI[1], 0, 2) == '__')
            throw new RoutingException('The double-underscore is not allowed in method name', RoutingException::MODEL_NAME_FORBIDDEN);

        if(!isset($arrayURI[1]) || empty($arrayURI[1]))
            $arrayURI[1] = 'main';

        if(!in_array($arrayURI[1], $currentMethods)) {
            if(!is_null($this->_version)) {
                $arrayURI[1] = '_'.str_replace('.', '_', $this->_version).'_'.$arrayURI[1];
                if(!in_array($arrayURI[1], $currentMethods))
                    throw new RoutingException($arrayURI[0].'::'.$arrayURI[1].'() :: Method does not exists', RoutingException::METHOD_NOT_FOUND);
            }
            else
                throw new RoutingException($arrayURI[0].'::'.$arrayURI[1].'() :: Method does not exists', RoutingException::METHOD_NOT_FOUND);
        }

        $controller = Main::getInstance()->controller;
        $controller->setCallMethod(new Method($controller, $arrayURI[1]));
    }

    private function callRoute() {
        $controller = Main::getInstance()->controller;
        call_user_func_array(array($controller, $controller->getCallMethod()->getName()), array());
    }
}