<?php
require_once('whatsapp.php');//Подключение класса отправки сообщений в Whatsapp

 $message = "текст сообщения";

//Отправка $message в Whatsapp
$m = new SendMsgToWhatsapp;
$m->sendMsg('79999999999', $message);// Телефон получателя в формате 79999999999
