<?php
use App\Kernel\Routes\Router;
use App\Controllers\HomeController;
use App\Controllers\ProductController;
return [
    Router::get('/', function (){
        echo 'Дом';
    }),
    Router::get('/home', [HomeController::class, 'index']),
    Router::get('/admin/products', [ProductController::class, 'index']),
    Router::post('/admin/products', [ProductController::class, 'store'])

];