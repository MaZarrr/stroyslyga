<?php
$username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
$mess = trim(filter_var($_POST['mess'], FILTER_SANITIZE_STRING));

$error = '';
if(strlen($username) <= 3) //strlen если длина этой строки менее чем 3 символа то выходим
  $error = 'Введите имя';
else if(strlen($email) <= 3)
    $error = 'Введите email';
else if(strlen($mess) <= 3)
  $error = 'Введите сообщение';

if($error != '') { // если error не равна пустоте значит у нас есть ошибка
  echo $error;
  exit();
}

$my_email = "vitalistarkiii@gmail.com"; // кому отправляем
$subject = "=?utf-8?B?".base64_encode("Новое сообщение")."?="; // тема письма, и эту переменную нужно еще кодировать// base64_encode() позволяет конвертировать кирилицу в правильную кодировку
$headers = "From: $email\r\nReply-to: $email\r\nContent-type: text/html; charset=utf-8\r\n";  // заголовки text/plain
mail($my_email, $subject, $mess, $headers); // для того что бы отправить сообщение нужна функция mail() и она принимает 4 параметра

echo 'Готово';
 ?>
