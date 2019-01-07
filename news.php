<!DOCTYPE html>
<html lang="ru">
<head>
  <?php
    require_once 'mysql_connect.php';

    $sql = 'SELECT * FROM `articles` WHERE `id` = :id';
// $id = $_GET['id'];
    $query = $pdo->prepare($sql);
    $query->execute(['id' => $_GET['id']]);
// $query = execute(['id' =>$id]);

$article = $query->fetch(PDO::FETCH_OBJ);

$website_title = $article->title;
require 'bloks/head.php';
?>
</head>
<body>
<?php require 'bloks/header.php'; ?>

    	<main class="container mt-5">
				<div class="row">
					<div class="col-md-8 mb-3">
            <div class="jumbotron">
              <h1><?=$article->title?></h1>
              <p><b>Автор статьи:</b> <mark><?=$article->avtor?></mark></p>
              <!--></!-->
              <?php
              //  echo date("H:i:s", $article->data); // для примера
              $date = date('d ', $article->data);
              $array = ["Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа",
              "Сентября", "Октября", "Ноября", "Деккабря"];
              $date .= $array[date('n', $article->data) -1];  // = означает что мы хотим перезаписать значение переменной, .= добавляем значение в конец переменной
              // date('n')-1 n-означает что без ведущего нуля те 1,2,3  тд до 12
              $date .= date(' H:i', $article->data);
               ?>
               <p><b>Время публикации:</b> <u><?=$date?></u></p>
              <p>
              <?=$article->intro?>
              <br><br>
              <?=$article->text?>
              </p>
            </div>
            <h4 class="mt-5">Комментарии</h4>
            <form action="/news.php?id=<?=$_GET['id']?>" method="post">
              <label for="username">Ваше имя</label>
              <input type="text" name="username" value="<?=$_COOKIE['login']?>" id="username" class="form-control">

              <label for="mess">Сообщение</label>
              <textarea name="mess" id="mess" class="form-control"></textarea>

              <button type="submit" id="mess_send" class="btn btn-success mt-3 mb-5">Добавить комментарий</button>
            </form>
            <?php
            if($_POST['username'] !='' && $_POST['mess'] != '') {
              $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING)); //
              $mess = trim(filter_var($_POST['mess'], FILTER_SANITIZE_STRING));
              // тут должно быть подключение к БД, но не прописывает так как подключение мы выполнили в начале

              $sql = 'INSERT INTO `stroydb`.`comments` (`name`, `mess`, `article_id`) VALUES (:name, :mess, :article_id)';
              $query = $pdo->prepare($sql);
              $query->execute(['name'=>$username, 'mess'=>$mess, 'article_id'=>$_GET['id']]);
            }
            // выводим комментарии для этого формируем новый sql -запрос
            $sql = 'SELECT * FROM `comments` WHERE `article_id` = :id ORDER BY `id` DESC';
            $query = $pdo->prepare($sql);
            $query->execute(['id' => $_GET['id']]); // выполняем sql запрос
            $comments = $query->fetchAll(PDO::FETCH_OBJ);

            foreach ($comments as $comment) {
              echo "<div class='alert alert-info mb-2'>
                <h4>$comment->name</h4>
                <p>$comment->mess</p>
              </div>";
            }
             ?>
          </div>

					<?php require 'bloks/aside.php'; ?>
				</div>
			</main>

<?php require 'bloks\footer.php'; ?>
</body>
</html>
