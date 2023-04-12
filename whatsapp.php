<?php
class SendMsgToWhatsapp {

    private $token;
    public $log_path;

    public function __construct() {
        $this->token = 'xUIEF8zRpS4OV66e10083a368b5ce189559d3a4e07024';//ваш токен полученный на api-messenger.com
        $this->log_path = '/logs/';//ваш путь сохранения логов
    }

    public function sendMsg($to_phone, $message) {
        $array = array(
            array(
                'chatId' => $to_phone.'@c.us', // Телефон получателя в формате 79999999999
                'message' => $message, // Сообщение
            )
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://app.api-messenger.com/sendmessage?token=' . $this->token);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($array));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json; charset=utf-8'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $this->result(curl_exec($ch)); // Отправим запрос
        curl_close($ch);

    }

    public function result($result) {
        $data = json_decode($result, true); // Разберем полученный JSON в массив
        if($data['status'] == 'ERROR')
            file_put_contents($this->log_path.'whatsapp.log', $data['status']. ': ' . $data['message']."\n",FILE_APPEND);
    }
}