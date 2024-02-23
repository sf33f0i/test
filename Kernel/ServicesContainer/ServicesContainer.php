<?php
namespace App\Kernel\ServicesContainer;
use App\Kernel\Routes\RoutApp;
use App\Kernel\Http\Request;
use App\Kernel\Session\Session;
use App\Kernel\View\View;
use App\Kernel\Validator\Validator;
use App\Kernel\Http\Redirect;

class ServicesContainer {
    public readonly Request $request;
    public readonly View $view;
    public readonly RoutApp $rout;
    public readonly Validator $validator;
    public readonly Redirect $redirect;
    public readonly Session $session;

    public function __construct()
    {
        $this->registerServices();
    }

    public function registerServices():void
    {
        $this->request = Request::RequestSet();
        $this->validator = new Validator();
        $this->request->setValidator($this->validator);
        $this->redirect = new Redirect();
        $this->session = new Session();
        $this->view = new View($this->session);
        $this->rout = new RoutApp($this->view, $this->request, $this->redirect, $this->session);
    }

}