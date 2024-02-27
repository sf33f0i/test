<?php
namespace App\Kernel\Routes;

class Router{

    private string $uri;
    private string $method;
    private $action;
    private array $middlewares = [];

    public function __construct($uri, $method, $action, $middlewares = [])
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->action = $action;
        $this->middlewares = $middlewares;
    }

    public static function get($uri, $action, array $middlewares = []):static
    {
        return (new static($uri, 'GET', $action, $middlewares));
    }

    public static function post($uri, $action, array $middlewares = []):static
    {
        return (new static($uri, 'POST', $action, $middlewares));
    }

    public function getUri():string
    {
        return $this->uri;
    }

    public function getMethod():string
    {
        return $this->method;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getMiddlewares():array
    {
        return $this->middlewares;
    }

    public function hasMiddlewares():bool
    {
        return !empty($this->middlewares);
    }
}