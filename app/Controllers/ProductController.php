<?php
namespace App\Controllers;

use App\Kernel\Controllers\Controller;
use App\Kernel\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $this->view('products', 'layout');
    }

    public function store(){
        $validation = $this->request()->validate([
            'name' => ['required', 'max:20', 'min:3', 'email'],
            'name3' => ['required'],
        ]);
        $this->session()->set('sosa', 123);

    }
}