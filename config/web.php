<?php
use App\Kernel\Routes\Router;
use App\Controllers\HomeController;
use App\Controllers\ProductController;
use App\Controllers\RegisterController;
use App\Controllers\LoginController;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;
return [
    Router::get('/', function (){
        echo 'Дом';
    }),
    Router::get('/home', [HomeController::class, 'index']),
    Router::get('/admin/products', [ProductController::class, 'index'], [AuthMiddleware::class]),
    Router::post('/admin/products', [ProductController::class, 'store'], [AuthMiddleware::class]),
    Router::get('/register' , [RegisterController::class, 'index'], [GuestMiddleware::class]),
    Router::post('/register', [RegisterController::class, 'registration'], [GuestMiddleware::class]),
    Router::get('/login', [LoginController::class, 'index'], [GuestMiddleware::class]),
    Router::post('/login', [LoginController::class, 'login'], [GuestMiddleware::class]),
    Router::get('/logout', [LoginController::class, 'logout'], [AuthMiddleware::class])

];