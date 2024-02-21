<?php

namespace App\Kernel\Controllers;
use App\Kernel\View\View;

abstract class Controller {

    private View $view;

    public function view($page):void
    {
        $this->view->page($page);
    }

    public function setView(View $view):void
    {
        $this->view = $view;
    }

}