<?php
namespace App\Kernel\Config;
interface ConfigInterface {

    public function get(string $name , $default);

}