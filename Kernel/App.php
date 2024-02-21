<?php
namespace App\Kernel;
use App\Kernel\Routes\RoutApp;
use App\Kernel\Http\Request;
use App\Kernel\View\View;

class App {

    public static function run()
    {
        $request = Request::RequestSet();
        $view = new View();
        $rout = new RoutApp($view);
        $rout->dispatch($request->getUri(), $request->getMethod());
    }

}