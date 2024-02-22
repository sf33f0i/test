<?php

namespace App\Kernel\Routes;

use App\Kernel\Http\Request;
use App\Kernel\View\View;

class RoutApp {
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];
    private View $view;
    private Request $request;
    public function __construct(View $view, Request $request)
    {
        $this->view = $view;
        $this->request = $request;
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
            $controller = new $controller();
            $controller->setView($this->view);
            $controller->setRequest($this->request);
            $controller->$action();

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