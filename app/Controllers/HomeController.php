<?php
namespace App\Controllers;

use App\Kernel\Controllers\Controller;

class HomeController extends Controller {

    public function index()
    {
        $this->view('home', 'layout');
    }
}