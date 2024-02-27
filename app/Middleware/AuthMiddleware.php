<?php
namespace App\Middleware;
use App\Kernel\Middleware\AbstractMiddleware;
class AuthMiddleware extends AbstractMiddleware {

    public function handle()
    {
        if(!$this->auth->check()){
            $this->redirect->to('/login');
        }
    }
}