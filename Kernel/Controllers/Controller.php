<?php

namespace App\Kernel\Controllers;
use App\Kernel\Auth\AuthInterface;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Http\RedirectInterface;
use App\Kernel\Http\Request;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Session\Session;
use App\Kernel\Session\SessionInterface;
use App\Kernel\View\View;
use App\Kernel\Http\Redirect;
use App\Kernel\View\ViewInterface;

abstract class Controller {

    private ViewInterface $view;
    private RequestInterface $request;
    private RedirectInterface $redirect;
    private SessionInterface $session;
    private DatabaseInterface $database;
    private AuthInterface $auth;

    public function view($page, $template=false):void
    {
        $this->view->page($page , $template);
    }

    public function setView(ViewInterface $view):void
    {
        $this->view = $view;
    }

    public function request():RequestInterface
    {
        return $this->request;
    }

    public function setRequest($request):void
    {
        $this->request = $request;
    }

    public function setRedirect(RedirectInterface $redirect):void
    {
        $this->redirect = $redirect;
    }

    public function session():SessionInterface
    {
        return $this->session;
    }

    public function setSession(SessionInterface $session):void
    {
        $this->session = $session;
    }

    public function redirect($url = null):Redirect
    {
        if(is_null($url)) return $this->redirect;
        $this->redirect->to($url);
    }

    public function db(): DatabaseInterface
    {
        return $this->database;
    }

    public function setDatabase(DatabaseInterface $database):void
    {
        $this->database = $database;
    }

    public function setAuth(AuthInterface $auth):void
    {
        $this->auth = $auth;
    }

    public function auth():AuthInterface
    {
        return $this->auth;
    }
}