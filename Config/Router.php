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
        self::$routes[] = [
            'method' => 'GET',
            'uri' => self::parseUri($uri),
            'controller' => $Controller,
            'function' => $ControllerMethod,
        ];
    }

    public static function post($uri, $Controller, $ControllerMethod) {
        self::$routes[$uri] = [
            'method' => 'POST',
            'uri' => self::parseUri($uri),
            'controller' => $Controller,
            'function' => $ControllerMethod,
        ];
    }

    private static function parseUri($uri) {
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_-]+)', $uri);
        return '/^' . str_replace('/', '\/', $pattern) . '$/';
    }

    public static function dispatch($uri, $requestMethod) {

        foreach (self::$routes as $route) {
            if ($route['method'] === $requestMethod && preg_match($route['uri'], $uri, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                require_once __DIR__.'/../Controllers/'.$route['controller'].'.php';
                $controller = new $route['controller'];
                return $controller->{$route['function']}($params);
            }
        }

        http_response_code(404);
        echo 'No se encontró la página';
    }

    public static function redirect($url) {
        header("Location: {$url}");
        exit;
    }
}