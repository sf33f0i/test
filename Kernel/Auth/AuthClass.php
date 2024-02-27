<?php
namespace App\Kernel\Auth;

use App\Kernel\Config\ConfigInterface;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Session\SessionInterface;
use App\Kernel\Auth\User;

class AuthClass implements AuthInterface {

    private DatabaseInterface $database;
    private SessionInterface $session;
    private ConfigInterface $config;
    private UserInterface $user;

    public function __construct(DatabaseInterface $database, SessionInterface $session, ConfigInterface $config)
    {
        $this->database = $database;
        $this->session = $session;
        $this->config = $config;
    }

    public function attempt($email, $password):array|bool
    {
        if(empty($email) && empty($password)) return false;
        $user = $this->database->first($this->table(), [$this->username() => $email]);
        if(!password_verify($password, $user[$this->password()])) return false;
        if(!$user)
        {
            return false;
        }
        $this->session->set('user_id', $user['id']);
        return true;
    }

    public function check(): bool
    {
        return $this->session->has('user_id');
    }

    public function user(): User|null
    {
        if(!$this->check()){
            return null;
        }
        $user = $this->database->first($this->table(), ['id' => $this->session->get('user_id')]);
        if($user)
        {
            return new User($user['id'], $user['email'], $user['password']);
        }
        return null;
    }

    public function logout()
    {
        $this->session->remove('user_id');
    }

    public function table()
    {
        return $this->config->get('auth.table', 'users');
    }

    public function username()
    {
        return $this->config->get('auth.username', 'login');
    }

    public function password()
    {
        return $this->config->get('auth.password', 'password');
    }
}