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
          </div>

					<?php require 'bloks/aside.php'; ?>
				</div>
			</main>

<?php require 'bloks\footer.php'; ?>
</body>
</html>
