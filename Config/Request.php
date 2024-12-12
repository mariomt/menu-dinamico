<?php
class Request {
    private static $instance = null;
    private $post;
    private $get;
    public $uri = '';
    public $url = '';
    public $requestMethod = 'GET';

    private function __construct()
    {  
        $this->post = $_POST;
        $this->get = $_GET;
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->url = parse_url($this->uri)['path'];
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function post($key) {
        $value = $this->post[$key] ?? null;

        if (is_string($value)) {
            return htmlspecialchars($value);
        }

        return $value;
    }

    public function get($key) {
        $value = $this->get[$key] ?? null;

        if (is_string($value)) {
            return htmlspecialchars($value);
        }

        return $value;
    }
}