<?php

namespace App\Routes;

class RoutApp {
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function __construct()
    {
        $this->fillRoute();
    }

    public function dispatch($uri, $method)
    {
        $route =$this->findRoute($uri, $method);
        if(!$route){
            die('Страница не найдена');
        }

        if (!is_array($route->getAction())){
            $route->getAction()();
        }else{
            [$controller, $action] = $route->getAction();
            $route = new $controller();
            $route->$action();

        }
    }

    public function findRoute($uri, $method): Router| false
    {
        if (!$this->routes[$method][$uri])
            return false;
        return $this->routes[$method][$uri];
    }

    public function fillRoute():void
    {
        $routes = $this->getRoutes();
        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }

    public function getRoutes()
    {
        return require_once APP_PATH.'/app/Routes/web.php';
    }
}