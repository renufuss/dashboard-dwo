<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'blank',
        ];
        return view('Login/index', $data);
    }
}
