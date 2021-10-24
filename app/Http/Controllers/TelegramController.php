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
        $auth = false;
        if (! empty($_COOKIE['access_token_telegram'])) {
            $token = $_COOKIE['access_token_telegram'];
            $auth = true;
            if (! empty($_COOKIE['telegram_bot_username'])) {
                $username = $_COOKIE['telegram_bot_username'];
                return view('telegram', [
                    'is_auth_telegram' => $auth,
                    'access_token' => $token,
                    'telegram_bot_username' => $username
                ]);
            }

            return view('telegram', [
                'is_auth_telegram' => $auth,
                'access_token' => $token,
            ]);
        }

        return view('telegram', [
            'is_auth_telegram' => $auth,
        ]);
    }

    public function send($method)
    {   }

    public function auth(Request $request)
    {
        setcookie('telegram_bot_username', '');
        setcookie('access_token_telegram', '');

        if (! empty($request->json('token'))) {
            $token = $request->json('token');
            $TelegramLib = new TelegramLib($token);
            $response = $TelegramLib->getMe();
            if (! empty($response)) {
                if (! empty($response['result']['username'])) {
                    setcookie('telegram_bot_username', $response['result']['username']);
                }
                setcookie('access_token_telegram', $token);
                return $response;
            }
        }

        return ['ok' => false];
    }

    public function getMe()
    {
        if (! empty($_COOKIE['access_token_telegram'])) {
            $accessToken = $_COOKIE['access_token_telegram'];
            $TelegramLib = new TelegramLib($accessToken);
            $response = $TelegramLib->getMe();

            return json_encode($response);
        }

        return [];
    }
}
