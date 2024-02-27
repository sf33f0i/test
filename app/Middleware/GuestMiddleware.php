<?php
namespace App\Middleware;
use App\Kernel\Middleware\AbstractMiddleware;

class GuestMiddleware extends AbstractMiddleware{

    public function handle()
    {
        if ($this->auth->check()){
            $this->redirect->to('/home');
        }
    }

}