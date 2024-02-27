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

    public function store()
    {
        $validation = $this->request()->validate([
            'name' => ['required'],
            'price' => ['required'],
        ]);

        if(!$validation){
            $this->redirect()->back();
            return false;
        }
        $insert = $this->db()->insert('products', $validation);
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