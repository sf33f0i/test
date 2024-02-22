<?php

namespace App\Kernel\Controllers;
use App\Kernel\Http\Request;
use App\Kernel\View\View;

abstract class Controller {

    private View $view;
    private Request $request;

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

}