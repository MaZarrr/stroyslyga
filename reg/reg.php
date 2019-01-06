<?php
  $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING)); //
  $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
  $login = trim(filter_var($_POST['login'], FILTER_SANITIZE_STRING));
  $pass = trim(filter_var($_POST['pass'], FILTER_SANITIZE_STRING));

  if(strlen($username) <= 3) //strlen если длина этой строки менее чем 3 символа то выходим
    exit();
  else if(strlen($email) <= 3)
    exit();
  else if(strlen($login) <= 3)
    exit();
  else if(strlen($pass) <= 3)
    exit();

  $hash = "s7fsaw32oais2wohdao";
  $pass = md5($pass . $hash); // функция защиты пароля, зашифровывает данные

  $user = 'root';
  $password = '';
  $db = 'stroydb';
  $host = 'localhost';


  $dsn = 'mysql:host='.$host.';dbname='.$db;
  $pdo= new PDO($dsn, $user, $password);
  $sql = 'INSERT INTO `stroydb`.`users` (`name`, `email`, `login`, `pass`) VALUES (:name, :email, :login, :pass)';
  //$sql = 'INSERT INTO users(name, email, login, pass) VALUES(:name, :email, :login, :pass)';
  $query = $pdo->prepare($sql);
  $query->execute(['name'=>$username, 'email'=>$email, 'login'=>$login, 'pass'=>$pass]);

?>
