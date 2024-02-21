<?php

namespace App\Kernel\Routes;

use App\Kernel\View\View;

class RoutApp {
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];
    private View $view;
    public function __construct(View $view)
    {
        $this->view = $view;
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
            $route->setView($this->view);
            $route->$action();

        }
    }

    public function findRoute($uri, $method): Router| false
    {
        if (!isset($this->routes[$method][$uri]))
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
        return require_once APP_PATH.'/config/web.php';
    }
}