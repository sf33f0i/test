<?php
namespace App\Routes;

class Router{

    private string $uri;
    private string $method;
    private $action;

    public function __construct($uri, $method, $action)
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->action = $action;
    }

    public static function get($uri, $action):static
    {
        return (new static($uri, 'GET', $action));
    }

    public static function post($uri, $action):static
    {
        return (new static($uri, 'POST', $action));
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
}