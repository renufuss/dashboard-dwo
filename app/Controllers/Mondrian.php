<?php

namespace App\Controllers;

class Mondrian extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Mondrian',
        ];
        return view('Mondrian/index', $data);
    }
}
