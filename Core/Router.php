<?php

namespace Core;

/**
 * Clase que permite registrar y gestionar las rutas de la aplicación.
 * Esta clase permite tener una abstacción del manejo de rutas en la aplicación.
 */
class Router
{
    public static $routes = [];



    /**
     * Método para declarar una ruta GET en la aplicación y permite definir el controlador y su método por el cual será manejada
     *
     * @param  string $uri representa la ruta que será vinculada con el controlador
     * @param  string $Controller el controlador que manejará la solicitud a la ruta.
     * @param  string $ControllerMethod el nombre del método que será responsable de tratar la solicitud
     * @return void
     */
    public static function get($uri, $Controller, $ControllerMethod)
    {
        self::$routes[] = [
            'method' => 'GET',
            'uri' => self::parseUri($uri),
            'controller' => $Controller,
            'function' => $ControllerMethod,
        ];
    }

    /**
     * Método para declarar una ruta POST en la aplicación y permite definir el controlador y su método por el cual será manejada
     *
     * @param  string $uri representa la ruta que será vinculada con el controlador
     * @param  string $Controller el controlador que manejará la solicitud a la ruta.
     * @param  string $ControllerMethod el nombre del método que será responsable de tratar la solicitud
     * @return void
     */
    public static function post($uri, $Controller, $ControllerMethod)
    {
        self::$routes[] = [
            'method' => 'POST',
            'uri' => self::parseUri($uri),
            'controller' => $Controller,
            'function' => $ControllerMethod,
        ];
    }

    /**
     * Método auxiliar que lee los patrones de la url y genera un nuevo patrón
     * para posteriormente tratarlos.
     *
     * Las url dinamicas deben tener sus parametros en tre corchetes {}, esto es lo que se reemplaza en esta función.
     *
     * @param  string $uri url a convertir
     * @return void
     */
    private static function parseUri($uri)
    {
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_-]+)', $uri);
        return '/^' . str_replace('/', '\/', $pattern) . '$/';
    }

    /**
     * Método que permite buscar la ruta que coincida con la solicitus,
     * para procesarla en el controlador y método adecuado.
     *
     * @param  mixed $uri url solicitada
     * @param  mixed $requestMethod tipo de método por el cual se está ingresando GET o POST
     * @return void
     */
    public static function dispatch($uri, $requestMethod)
    {

        foreach (self::$routes as $route) {
            if ($route['method'] === $requestMethod && preg_match($route['uri'], $uri, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                require_once 'Controllers/' . $route['controller'] . '.php';
                $controllerpath = "Controllers\\" . $route['controller'];
                $controller = new $controllerpath();
                return $controller->{$route['function']}($params);
            }
        }

        http_response_code(404);
        View::getView('NotFound');
    }

    /**
     * Método auxiliar para manejar una redirección.
     *
     * @param  mixed $url
     * @return void
     */
    public static function redirect($url)
    {
        $newURL = getURL($url);
        header("Location: {$newURL}");
        exit;
    }
}
