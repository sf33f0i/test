<?php
namespace App\Controllers;

use App\Kernel\Controllers\Controller;

class LoginController extends Controller{

    public function index()
    {
        $this->view('login', 'layout');
    }

    public function login()
    {
        $validation = $this->request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if(!$validation)
        {
            $this->redirect()->back();
            return false;
        }
        $this->auth()->attempt($validation['email'], $validation['password']);

    }

    public function logout()
    {
        $this->auth()->logout();
        $this->redirect()->back();
    }
}