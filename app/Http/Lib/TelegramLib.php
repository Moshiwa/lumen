<?php

namespace App\Http\Lib;

class TelegramLib
{
    protected $accessToken = '';
    protected $url = 'https://api.telegram.org/';
    protected $error = '';

    public function __construct($accessToken)
    {
        if (! empty($accessToken)) {
            $this->accessToken = $accessToken;
        }
    }

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    public function getMe()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "{$this->url}bot{$this->accessToken}/getMe");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        if (empty($response)) {
            $this->error = 'TelegramBotLib->getMe: Empty response';
            return [];
        }

        $response = json_decode($response, true);

        if (empty($response['ok'])) {
            $errorMessage = empty($response['description']) ? '' : "description: {$response['description']} ";
            $errorMessage .= empty($response['error_code']) ? '' : "error_code: {$response['error_code']} ";
            $this->error = $errorMessage;
            error_log('TelegramBotLib->getMe: Wrong query');
            return []; // ToDo return error message
        }

        return $response;
    }


}
