<?php
namespace App\Kernel\Middleware;

use App\Kernel\Auth\AuthInterface;
use App\Kernel\Http\RedirectInterface;
use App\Kernel\Http\RequestInterface;

abstract class AbstractMiddleware {

    protected RequestInterface $request;
    protected AuthInterface $auth;
    protected RedirectInterface $redirect;

    public function __construct(RequestInterface $request, AuthInterface $auth, RedirectInterface $redirect)
    {
        $this->request = $request;
        $this->auth = $auth;
        $this->redirect = $redirect;
    }

    abstract function handle();
}