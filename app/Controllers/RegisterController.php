<?php
namespace App\Controllers;

use App\Kernel\Controllers\Controller;

class RegisterController extends Controller{

    public function index()
    {
        $this->view('register', 'layout');
    }

    public function registration()
    {
        $validation = $this->request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if(!$validation){
            $this->redirect()->back();
        }
        $validation['password'] = password_hash($validation['password'], PASSWORD_DEFAULT);
        $insert = $this->db()->insert('users', $validation);
        if(!$insert){
            $this->session()->setError('Не удалось зарегистрироваться');
            return false;
        }
        return true;
    }

}