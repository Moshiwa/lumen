<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class ToolsController extends BaseController
{
    public function index()
    {
        return view('tools ', ['date' => 'Hi']);
    }
}
