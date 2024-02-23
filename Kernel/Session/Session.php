<?php
namespace App\Kernel\Session;

class Session {

    public function __construct()
    {
        session_start();
    }

    public function get($key, $default=null)
    {
        return $_SESSION[$key]??$default;
    }

    public function set($key, $value):void
    {
        $_SESSION[$key] = $value;
    }

    public function has($key):bool
    {
        return isset($_SESSION[$key]);
    }

    public function remove($key):void
    {
        unset($_SESSION[$key]);
    }

    public function flash($key)
    {
        $value = $this->get($key);
        $this->remove($key);
        return $value;
    }

    public function destroy():void
    {
        session_destroy();
    }
}