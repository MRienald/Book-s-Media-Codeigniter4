<?php

namespace App\Controllers;
define('TITLE', 'Beranda');

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'title' => TITLE
        ];
        return view('beranda', $data);
    }
}
