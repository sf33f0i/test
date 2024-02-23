<?php
namespace App\Kernel\Http;

class Redirect {

    public function to($url)
    {
        header("Location:$url");
        exit();
    }
}