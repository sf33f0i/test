<?php
namespace App\Kernel\Auth;
use App\Kernel\Auth\UserInterface;

class User implements UserInterface {

    private int $id;
    private string $email;
    private string $password;

    public function __construct(int $id, string $email, string $password)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function id(): int
    {
        return $this->id;
    }

}