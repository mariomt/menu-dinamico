<?php

class Router {
    public static $routes = [];


        
    /**
     * Esta función sirve para declarar una ruta en la aplicación y permite definir el controlador y su método por el cual será manejada
     *
     * @param  string $uri
     * @param  string $Controller
     * @param  string $ControllerMethod
     * @return void
     */
    public static function get($uri, $Controller, $ControllerMethod) {
        self::$routes[$uri] = [
            'method' => 'GET',
            'controller' => $Controller,
            'function' => $ControllerMethod,
        ];
    }

    public static function post($uri, $Controller, $ControllerMethod) {
        self::$routes[$uri] = [
            'method' => 'POST',
            'controller' => $Controller,
            'function' => $ControllerMethod,
        ];
    }

    public static function put($uri, $Controller, $ControllerMethod) {
        self::$routes[$uri] = [
            'method' => 'PUT',
            'controller' => $Controller,
            'function' => $ControllerMethod,
        ];
    }

    public static function dispatch($uri, $requestMethod) {
        if(isset(self::$routes[$uri]) && self::$routes[$uri]['method'] === $requestMethod) {
            $uri = self::$routes[$uri];
            require_once __DIR__.'/../Controllers/'.$uri['controller'].'.php';
            $controller = new $uri['controller'];
            return $controller->{$uri['function']}();
        }

        http_response_code(404);
        echo 'No se encontró la página';
    }
}