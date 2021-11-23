<?php
class MyTmpTelegramBot
{
    const BOT_TOKEN = "2127651559:AAF0AHzSStBMUiefsy54oQkR1GbGhAxGqwc";
    const TELEGRAM_API_URL = "https://api.telegram.org/bot";

    public $url;

    public function __construct()
    {
        $this->url = SELF::TELEGRAM_API_URL . SELF::BOT_TOKEN;
    }

    private function runScript($method)
    {
        return file_get_contents($this->url . '/'. $method);
    }

    public function getUpdates()
    {
        return $this->runScript('getupdates');
    }

    public function sendMessage($chatId, $text)
    {
        $url = "sendmessage?text=$text&chat_id=$chatId";
        return $this->runScript($url);
    }
}

$obj = new MyTmpTelegramBot();
$updatesJson = $obj->getUpdates();
$updatesJson2Array = json_decode($updatesJson, true);
$chatId = $updatesJson2Array['result'][0]['message']['chat']['id'];
$obj->sendMessage($chatId, 'Hi');