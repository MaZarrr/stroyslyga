<?php
  $login = trim(filter_var($_POST['login'], FILTER_SANITIZE_STRING));
  $pass = trim(filter_var($_POST['pass'], FILTER_SANITIZE_STRING));

  $error = '';
  if(strlen($login) <= 3)
      $error = 'Введите логин';
  else if(strlen($pass) <= 3)
      $error = 'Введите пароль';

  if($error != '') { // если error не равна пустоте значит у нас есть ошибка
    echo $error;
    exit();
}

  $hash = "s7fsaw32oais2wohdao";
  $pass = md5($pass . $hash); // функция защиты пароля, зашифровывает данные

  require_once '../mysql_connect.php'; // .. значит выйти на уровень выше в данном случае к из папки ajax
  // что бы авторизовать пользователя нам неоходимо послать запрос в БД с его введенными данными и если будет найден такой пользователь
  // где и логин и пароль будут совпадать с тем что ввел пользователь то мы его авторизовываем cooccie
  $sql = 'SELECT `id` FROM `users` WHERE `login` = :login && `pass` = :pass';
  $query = $pdo->prepare($sql);
  $query->execute(['login' => $login, 'pass' => $pass]);

  $user = $query->fetch(PDO::FETCH_OBJ);
  if($user->id == 0) {
    echo 'Такого пользователя не существует';
  } else {
    // для сохранения данных используем куки, потому что если пользователь зарегестрировался то сохранить его данные о том что
    // он зарегестрировался хотя бы на месяц или неделю сессии не подходят
    setcookie('login', $login, time() + 3600 * 24 * 30, "/"); // назвали куки 'log' 3600 sec 24
    echo 'Готово';
  }
?>
