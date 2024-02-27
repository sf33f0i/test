<?php
namespace App\Kernel\Session;

interface SessionInterface {

    public function get($key, $default=null);
    public function set($key, $value):void;
    public function has($key):bool;
    public function remove($key):void;
    public function flash($key);
    public function destroy():void;


}