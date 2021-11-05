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
            $error = $TelegramLib->error();

            if( empty($error)) {
                return json_encode(['error' => $error]);
            }

            return json_encode($response);
        }

        return [];
    }

    public function sendMessage($message)
    {
        if (! empty($_COOKIE['access_token_telegram'])) {
            $accessToken = $_COOKIE['access_token_telegram'];
            $TelegramLib = new TelegramLib($accessToken);
            $response = $TelegramLib->sendMessage();
            $error = $TelegramLib->error();

            if(! empty($error)) {
                return json_encode(['error' => $error]);
            }

            return json_encode($response);
        }

        return [];
    }

    public function setWebhook()
    {
        if (empty($_COOKIE['access_token_telegram'])) {
            return [];
        }

        $accessToken = $_COOKIE['access_token_telegram'];
        $callbackUrl = 'https://7e91-94-181-145-212.ngrok.io/telegram/get_webhook';

        $TelegramLib = new TelegramLib($accessToken);
        $response = $TelegramLib->setWebhook($callbackUrl);
        $error = $TelegramLib->error();

        if(! empty($error)) {
            return json_encode(['error' => $error]);
        }

        return json_encode($response);
    }

    public function getWebhook(Request $request)
    {
        $fd = fopen("helper.json", 'w') or die("не удалось создать файл");
        $str = json_encode($request);
        fwrite($fd, $str);
        fclose($fd);
    }
}
