<?php
namespace App\Controllers;

use App\Kernel\Controllers\Controller;
use App\Kernel\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $all = Product::all();
        $this->view('layout.products', compact('all'));
    }

    public function store():bool
    {
        $file = $this->request()->files('image');
        $file->move('avatars', 'test.jpg');
        $validation = $this->request()->validate([
            'name' => ['required'],
            'price' => ['required'],
        ]);

        if(!$validation){
            $this->redirect()->back();
            return false;
        }
        $insert = Product::create($validation);
        if(!$insert){
            $this->session()->setError('Товар не был добавлен');
            $this->redirect()->back();
            return false;
        }
        $this->session()->setSuccess('Товар добавлен успешно');
        $this->redirect()->back();
        return true;
    }
}