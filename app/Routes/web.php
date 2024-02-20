<?php
use App\Routes\Router;
use App\controllers\Controller;
return [

    Router::get('/home', [Controller::class, 'index']),
    Router::get('/home2', function (){
        echo 'Это 2';
    })

];