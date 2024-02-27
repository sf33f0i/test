<?php

namespace App\Kernel\Routes;

use App\Kernel\Auth\AuthInterface;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Http\Redirect;
use App\Kernel\Http\RedirectInterface;
use App\Kernel\Http\Request;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Middleware\AbstractMiddleware;
use App\Kernel\Session\Session;
use App\Kernel\Session\SessionInterface;
use App\Kernel\View\View;
use App\Kernel\View\ViewInterface;

class RoutApp {
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];
    private ViewInterface $view;
    private RequestInterface $request;
    private RedirectInterface $redirect;
    private SessionInterface $session;
    private DatabaseInterface $database;
    private AuthInterface $auth;

    public function __construct(ViewInterface $view, RequestInterface $request, RedirectInterface $redirect, SessionInterface $session, DatabaseInterface $database, AuthInterface $auth)
    {
        $this->view = $view;
        $this->request = $request;
        $this->redirect = $redirect;
        $this->session = $session;
        $this->database = $database;
        $this->auth = $auth;
        $this->fillRoute();
    }

    public function dispatch($uri, $method)
    {
        $route =$this->findRoute($uri, $method);
        if(!$route){
            die('Страница не найдена');
        }
        if($route->hasMiddlewares())
        {
            foreach ($route->getMiddlewares() as $middleware){
                $instanceMiddleware = new $middleware($this->request, $this->auth, $this->redirect);
                $instanceMiddleware->handle();
            }
        }
        if (!is_array($route->getAction())){
            $route->getAction()();
        }else{
            [$controller, $action] = $route->getAction();
            $controller = new $controller();
            $controller->setView($this->view);
            $controller->setRequest($this->request);
            $controller->setRedirect($this->redirect);
            $controller->setSession($this->session);
            $controller->setDatabase($this->database);
            $controller->setAuth($this->auth);
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