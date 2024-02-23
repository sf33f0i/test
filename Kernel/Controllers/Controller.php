<?php

namespace App\Kernel\Controllers;
use App\Kernel\Http\Request;
use App\Kernel\Session\Session;
use App\Kernel\View\View;
use App\Kernel\Http\Redirect;
abstract class Controller {

    private View $view;
    private Request $request;
    private Redirect $redirect;
    private Session $session;

    public function view($page, $template=false):void
    {
        $this->view->page($page , $template);
    }

    public function setView(View $view):void
    {
        $this->view = $view;
    }

    public function request():Request
    {
        return $this->request;
    }

    public function setRequest($request):void
    {
        $this->request = $request;
    }

    public function setRedirect(Redirect $redirect):void
    {
        $this->redirect = $redirect;
    }

    public function session():Session
    {
        return $this->session;
    }

    public function setSession(Session $session):void
    {
        $this->session = $session;
    }

    public function redirect($url = null):Redirect
    {
        if(is_null($url)) return $this->redirect;
        $this->redirect->to($url);
    }

}