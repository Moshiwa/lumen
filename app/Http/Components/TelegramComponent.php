<?php

namespace App\Http\Components;
use Illuminate\Support\Facades\App;

class TelegramComponent
{
    protected $file = '';
    protected $settings = [];

    public function __construct()
    {
        $this->file = App::basePath().'\resources\files\config\helper.json';
        if (empty(file_exists($this->file))) {
            file_put_contents($this->file, '');
        }
        $json = file_get_contents($this->file);
        $this->settings = json_decode($json, true);
    }

    /**
     * @param string $key
     * @param array $value
     * @return bool
     */
    public function saveSettingToFile($key = '', $value = [])
    {
        if (empty($key)) {
            return false;
        }

        $this->settings[$key] = $value;

        $data = json_encode($this->settings);
        $file = fopen($this->file, 'w+');
        if ($file === false) {
            return false;
        }

        if (fwrite($file, $data) === false) {
            fclose($file);
            return false;
        }

        fclose($file);

        return true;
    }

    /**
     * @param $key
     * @return array|mixed
     */
    public function getSettingFromFile($key)
    {
        if (empty($key)) {
            return [];
        }

        if (! empty($this->settings[$key])) {
            return $this->settings[$key];
        }

        return [];
    }
}
