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
        dd($this->request()->input('name'));
    }
}