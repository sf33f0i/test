<?php
use App\Kernel\Routes\Router;
use App\controllers\HomeController;
return [
    Router::get('/', function (){
        echo 'Дом';
    }),
    Router::get('/home', [HomeController::class, 'index']),

    Router::get('/home2', function (){
        echo 'Это 2';
    }),

];