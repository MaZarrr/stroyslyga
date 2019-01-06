<?php
  $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING)); //
  $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
  $login = trim(filter_var($_POST['login'], FILTER_SANITIZE_STRING));
  $pass = trim(filter_var($_POST['pass'], FILTER_SANITIZE_STRING));

  $error = '';
  if(strlen($username) <= 3) //strlen если длина этой строки менее чем 3 символа то выходим
    $error = 'Введите имя';
    //exit();
  else if(strlen($email) <= 3)
      $error = 'Введите email';
    //exit();
  else if(strlen($login) <= 3)
      $error = 'Введите логин';
    //exit();
  else if(strlen($pass) <= 3)
      $error = 'Введите пароль';
    //exit();

  if($error != '') { // если error не равна пустоте значит у нас есть ошибка
    echo $error;
    exit();
}

  $hash = "s7fsaw32oais2wohdao";
  $pass = md5($pass . $hash); // функция защиты пароля, зашифровывает данные

  $user = 'root';
  $password = '';
  $db = 'stroydb';
  $host = 'localhost';


  $dsn = 'mysql:host='.$host.';dbname='.$db;
  $pdo= new PDO($dsn, $user, $password);
  $sql = 'INSERT INTO `stroydb`.`users` (`name`, `email`, `login`, `pass`) VALUES (:name, :email, :login, :pass)';
  $query = $pdo->prepare($sql);
  $query->execute(['name'=>$username, 'email'=>$email, 'login'=>$login, 'pass'=>$pass]);

  echo 'Готово'; // если ошибок нет то выводим готово
?>
