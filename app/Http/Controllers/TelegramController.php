<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Components\TelegramComponent;
use App\Http\Lib\TelegramLib;

class TelegramController extends BaseController
{
    public function index(Request $request) {

        if (! empty($request->request->all())) {
            $accessToken = $request->request->get('access_token');
            $TelegramComponent = new TelegramComponent();
            $TelegramComponent->saveSettingToFile('Telegram.access_token', $accessToken);

           /* $TgLib = new TelegramLib($accessToken);
            $res = $TgLib->getMe();
            dd($res);*/
            return view('telegram', ['access_token' => $accessToken]);
        }
        return view('telegram', []);
    }

    public function getMe()
    {

    }
}
