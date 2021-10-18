<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function index()
    {
        $date = date('d.m.y h:m:s',time());
        return view('index', ['date' => $date]);
    }
}
