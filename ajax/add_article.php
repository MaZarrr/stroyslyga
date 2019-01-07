<?php
  $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING)); //
  $intro = trim(filter_var($_POST['intro'], FILTER_SANITIZE_STRING));
  $text = trim(filter_var($_POST['text'], FILTER_SANITIZE_STRING));

  $error = '';
  if(strlen($title) <= 3) //strlen если длина этой строки менее чем 3 символа то выходим
    $error = 'Введите название статьи';
  else if(strlen($intro) <= 15)
      $error = 'Введите интро';
  else if(strlen($text) <= 20)
      $error = 'Введите текст статьи';

  if($error != '') { // если error не равна пустоте значит у нас есть ошибка
    echo $error;
    exit();
}

  require_once '../mysql_connect.php';

  //$sql = 'INSERT INTO `stroydb`.`articles` (`title`, `intro`, `text`, `date`, `avtor`) VALUES (:title, :intro, :text, :date, :avtor)';
  $sql = 'INSERT INTO `stroydb`.`articles`(title, intro, text, data, avtor) VALUES (?, ?, ?, ?, ?)';
  $query = $pdo->prepare($sql);
  $query->execute([$title, $intro, $text, time(), $_COOKIE['login']]);
  //$query->execute(['title'=>$title, 'intro'=>$intro, 'text'=>$text, 'date'=>time(), 'avtor'=>$_COOKIE['log']]);

  echo 'Готово';
?>
