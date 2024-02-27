<?php
namespace App\Kernel\Http;
use App\Kernel\Http\RedirectInterface;

class Redirect implements RedirectInterface {

    public function to($url):void
    {
        header("Location:$url");
        exit();
    }

    public function back():void
    {
        header('Location:'.$_SERVER['HTTP_REFERER']);
        exit();
    }
}