<?php
namespace App\Kernel\Auth;

interface AuthInterface {
    public function attempt(string $email, string $password):array|bool;
    public function logout();
    public function check():bool;
    public function user():User|null;
}