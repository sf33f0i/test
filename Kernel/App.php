<?php
namespace App\Kernel;
use App\Kernel\ServicesContainer\ServicesContainer;

class App {

    public static function run():void
    {
        $container = new ServicesContainer();
        $container->rout->dispatch($container->request->getUri(), $container->request->getMethod());
    }

}