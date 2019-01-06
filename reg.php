<!DOCTYPE html>
<html lang="ru">
<?php
$website_title = 'Регистрация на сайте';
require 'bloks/head.php' ?>
<body>
	<?php require 'bloks/header.php'; ?>
				<main class="container mt-5">
					<div class="row">
						<div class="col-md-8 mb-3">
							<h4>Регистрация</h4>
							<form action="reg/reg.php" method="post">
								<label for="username">Ваше имя</label>
								<input type="text" name="username" id="username" class="form-control">

								<label for="email">Email</label>
								<input type="email" name="email" id="email" class="form-control">

								<label for="login">Логин</label>
								<input type="text" name="login" id="login" class="form-control">

								<label for="pass">Пароль</label>
								<input type="password" name="pass" id="pass" class="form-control">

								<button type="submit" class="btn btn-success mt-5">Зарегистрироваться</button>
							</form>
						</div>
						<?php require 'bloks/aside.php'; ?>
					</div>
				</main>
<?php require 'bloks\footer.php'; ?>
</body>
</html>
