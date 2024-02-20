<?php
namespace App;
use App\Routes\RoutApp;

class App {

    public static function run()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        $rout = new RoutApp();
        $rout->dispatch($uri, $method);
    }

}