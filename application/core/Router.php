<?php

namespace application\core;

class Router {

    static function start() {

        // дефолтные значения
        $controllerName = 'MainController';
        $actionName = 'indexAction';

        $explodedCurrentPath = explode('/', $_SERVER['REQUEST_URI']);

        // имя контроллера
        if ( !empty($explodedCurrentPath[1]) ) {
            $controllerName = $explodedCurrentPath[1].'Controller';
        }

        // имя экшена
        if ( !empty($explodedCurrentPath[2]) ) {
            $actionName = $explodedCurrentPath[2].'Action';
        }

//        echo $controllerName;
//        echo $actionName;

        $controllerName = "\application\controllers\\".$controllerName;
        $controller = new $controllerName;
        $controller -> $actionName();

    }
}