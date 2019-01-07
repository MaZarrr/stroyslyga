<?php
  $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING)); //
  $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
  $login = trim(filter_var($_POST['login'], FILTER_SANITIZE_STRING));
  $pass = trim(filter_var($_POST['pass'], FILTER_SANITIZE_STRING));

  $error = '';
  if(strlen($username) <= 3) //strlen если длина этой строки менее чем 3 символа то выходим
    $error = 'Введите имя';
  else if(strlen($email) <= 3)
      $error = 'Введите email';
  else if(strlen($login) <= 3)
      $error = 'Введите логин';
  else if(strlen($pass) <= 3)
      $error = 'Введите пароль';

  if($error != '') { // если error не равна пустоте значит у нас есть ошибка
    echo $error;
    exit();
}

  $hash = "s7fsaw32oais2wohdao";
  $pass = md5($pass . $hash); // функция защиты пароля, зашифровывает данные

  require_once '../mysql_connect.php';

  $sql = 'INSERT INTO `stroydb`.`users` (`name`, `email`, `login`, `pass`) VALUES (:name, :email, :login, :pass)';
  $query = $pdo->prepare($sql);
  $query->execute(['name'=>$username, 'email'=>$email, 'login'=>$login, 'pass'=>$pass]);

  echo 'Готово'; // если ошибок нет то выводим готово
?>
