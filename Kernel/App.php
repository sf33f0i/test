<?php
namespace App;
use App\Routes\RoutApp;
use App\Http\Request;

class App {

    public static function run()
    {
        $request = Request::RequestSet();
        $rout = new RoutApp();
        $rout->dispatch($request->getUri(), $request->getMethod());
    }

}