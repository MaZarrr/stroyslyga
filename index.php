<!DOCTYPE html>
<html lang="ru">
<?php
$website_title = 'СТРОЙ-СЛУГА';
require 'bloks/head.php' ?>
<body>
<?php require 'bloks/header.php'; ?>
			<main class="container mt-5">
				<div class="row">
					<div class="col-md-8 mb-3">
						<?php
						require_once 'mysql_connect.php';
						$sql = 'SELECT * FROM `articles` ORDER BY `data` DESC';
						$query = $pdo->query($sql);
						while ($row = $query->fetch(PDO::FETCH_OBJ)) {
							echo "<h2>$row->title</h2>
							<p>$row->intro</p>
							<p><b>Автор статьи:</b> <mark>$row->avtor</mark></p>
							<button class='btn btn-warning mb-5'>Прочитать больше</button>";
						}
						 ?>
					</div>
					<?php require 'bloks/aside.php'; ?>
				</div>
			</main>
<?php require 'bloks\footer.php'; ?>
</body>
</html>
