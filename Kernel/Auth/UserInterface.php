<?php
namespace App\Kernel\Auth;

interface UserInterface {

    public function email():string;
    public function id():int;
}