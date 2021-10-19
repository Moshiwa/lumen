<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Http\Components\TelegramComponent;
use App\Http\Lib\TelegramLib;

class TelegramController extends BaseController
{
    public function index(Request $request)
    {
        $TelegramComponent = new TelegramComponent();
        $accessToken = $TelegramComponent->getSettingFromFile('Telegram.access_token');

        if (! empty($request->request->all())) {
            $accessToken = $request->request->get('access_token');
            $TelegramLib = new TelegramLib($accessToken);
            $response = $TelegramLib->getMe();
            if(empty($response['ok'])) {
                $error = $TelegramLib->getError();
                if (! empty($error)) {
                    return view('telegram', ['error' => $error]);
                }
                return view('telegram', ['error' => 'Wrong access_token']);
            }
            $TelegramComponent = new TelegramComponent();
            $TelegramComponent->saveSettingToFile('Telegram.access_token', $accessToken);

            return view('telegram', ['access_token' => $accessToken, 'result' => $response['result']]);
        }
        return view('telegram', ['access_token' => $accessToken]);
    }

    public function send($method)
    {
        //send to TelegramComponent -> TelegramLib
    }

    public function getMe()
    {

    }
}
