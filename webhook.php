<?php

$API_KEY = 'Token'; # -- Token -- #

$bot_id = 'Bot UserName'; # -- Bot UserName -- #

$channel = 'channel'; # -- Channel iD -- #

$admin1 = 'Admin'; # -- Admin -- #

$admin2 = 'Admin'; # -- Admin -- #

define('API_KEY', $API_KEY);

$admins = array($admin1,$admin2);

function bot($method, $datas = []){

    $url = "https://api.telegram.org/bot" . API_KEY . "/" . $method;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);

    $res = curl_exec($ch);

    if (curl_error($ch)) {

        var_dump(curl_error($ch));

    } else {

        return json_decode($res);

    }
}

function SendMessage($chat_id, $text, $key){

    bot('sendMessage', ['chat_id' => $chat_id,'text' => $text,'parse_mode' => 'Html','disable_web_page_preview' => true,'reply_markup' => $key]);
}

function Forward($chat_id,$from_id,$massege_id){

    bot('ForwardMessage',['chat_id'=>$chat_id,'from_chat_id'=>$from_id,'message_id'=>$massege_id]);
}

$button=json_encode(['keyboard' => [[['text' => 'تست']],[['text' => 'تست2']]],'resize_keyboard' => true]);

$update = json_decode(file_get_contents('php://input'));

$text = $update->message->text;

$chat_id = $update->message->chat->id;

$message_id = $update->message->message_id;

$first_name = $update->message->from->first_name;

$chatid = $update->callback_query->message->chat->id;

$first_name2 = $update->callback_query->from->first_name;

$data = $update->callback_query->data;



if($text == '/start'){

    SendMessage($chat_id,"سلام",$button);

}