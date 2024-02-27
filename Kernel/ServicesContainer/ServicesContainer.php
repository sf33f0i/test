<?php
namespace App\Kernel\ServicesContainer;
use App\Kernel\Auth\AuthClass;
use App\Kernel\Auth\AuthInterface;
use App\Kernel\Config\Config;
use App\Kernel\Config\ConfigInterface;
use App\Kernel\Database\Database;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Http\RedirectInterface;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Routes\RoutApp;
use App\Kernel\Http\Request;
use App\Kernel\Session\Session;
use App\Kernel\Session\SessionInterface;
use App\Kernel\Validator\ValidatorInterface;
use App\Kernel\View\View;
use App\Kernel\Validator\Validator;
use App\Kernel\Http\Redirect;
use App\Kernel\View\ViewInterface;

class ServicesContainer {
    public readonly RequestInterface $request;
    public readonly ViewInterface $view;
    public readonly RoutApp $rout;
    public readonly ValidatorInterface $validator;
    public readonly RedirectInterface $redirect;
    public readonly SessionInterface $session;
    public readonly DatabaseInterface $database;
    public readonly ConfigInterface $config;
    public readonly AuthInterface $auth;

    public function __construct()
    {
        $this->registerServices();
    }

    public function registerServices():void
    {
        $this->request = Request::RequestSet();
        $this->redirect = new Redirect();
        $this->session = new Session();
        $this->validator = new Validator($this->session);
        $this->request->setValidator($this->validator);
        $this->config = new Config();
        $this->database = new Database($this->config);
        $this->auth = new AuthClass($this->database, $this->session, $this->config);
        $this->view = new View($this->session, $this->auth);
        $this->rout = new RoutApp($this->view, $this->request, $this->redirect, $this->session, $this->database, $this->auth);
    }

}