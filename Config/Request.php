<?php

/**
 * Clase que nos permite mapear información del request y tenerla en un objeto.
 * Esta clase implementa el patrón singleton para solo tener una instancia por solicitud.
 */
class Request {
    private static $instance = null;
    private $post;
    private $get;
    public $uri = '';
    public $url = '';
    public $requestMethod = 'GET';
    
    /**
     * Constructor de la clase que permite cargar la información del request
     *
     * @return void
     */
    private function __construct()
    {  
        $this->post = $_POST;
        $this->get = $_GET;
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->url = parse_url($this->uri)['path'];
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
    }
    
    /**
     * Método auxiliar para poder generar la instancia de la clase o obtener la instancia ya crada.
     *
     * @return void
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
    
    /**
     * Método que nos permite extraer una propiedad del body de la solicitud.
     *
     * @param  mixed $key
     * @return void
     */
    public function post($key) {
        $value = $this->post[$key] ?? null;

        if (is_string($value)) {
            return htmlspecialchars($value);
        }

        return $value;
    }
    
    /**
     * Método que nos permite extraer una propiedad de los query params pasados en la solicitud.
     *
     * @param  mixed $key
     * @return void
     */
    public function get($key) {
        $value = $this->get[$key] ?? null;

        if (is_string($value)) {
            return htmlspecialchars($value);
        }

        return $value;
    }
}