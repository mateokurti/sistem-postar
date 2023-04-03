<?php

namespace App\Controllers;

class HelloWorldController extends _BaseController
{
    public function index()
    {
        $this->view('hello-world/index');
    }
}
