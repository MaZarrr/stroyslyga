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
							<form action="" method="post">
								<label for="username">Ваше имя</label>
								<input type="text" name="username" id="username" class="form-control">

								<label for="email">Email</label>
								<input type="email" name="email" id="email" class="form-control">

								<label for="login">Логин</label>
								<input type="text" name="login" id="login" class="form-control">

								<label for="pass">Пароль</label>
								<input type="password" name="pass" id="pass" class="form-control">

								<div class="alert alert-danger mt-2" id="errorBlock"></div>

								<button type="submit" id="reg_user" class="btn btn-success mt-3">Зарегистрироваться</button>
							</form>
						</div>
						<?php require 'bloks/aside.php'; ?>
					</div>
				</main>

<?php require 'bloks\footer.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
//<!--> скрипт ajax запрос на сервер который будет получать от туда данные для этого в button submit добавим id
//и в форм action можно убрать reg.php тк обработка будет происходить на этой странице
 //</!-->

	//получаем кнопку $('#reg_user') и если на нее нажали $('#reg_user').click(function() то обрабатываем функцию
	$('#reg_user').click(function() {
		//alert("asd"); // при нажатии на кнопку выскакивыет алерт
		var name = $('#username').val(); // по их id находим определенное поле и берем val() их значение
		var email = $('#email').val();
		var login = $('#login').val();
		var pass = $('#pass').val(); // получили данные

		// и теперь можем отправить ajax запрос
		$.ajax({
			//url: ''// это тот файл по которому будет выполняться данный скрипт
			url: 'reg/reg.php',
			type: 'POST', // далее указываем тип передачи данных
			cache: false, // дальше, будет ли кеширование данных
			data: { 	// тут указываем какую информацию передаем тут это обьект data а если это обьект то указываем фигургые скобки {}
				'username' : name,
				'email' : email,
				'login' : login,
				'pass' : pass
			},
			dataType: 'html', // тут указываем способ получения данных
			// beforeSend: function () {}.  информация которая будет обработана до того как мы получим ответ от сервера
			success: function (data) { // success - функция обработается когда мы получим ответ от сервера
				if(data == 'Готово') { // если эти данные которые будут переданы и это слово готово то мы будем знать что у нас данные отправлены, пользователь зареган
					$('#reg_user').text('Все готово'); // если из файла reg.php отправим данные готово то изменим тогда на все готово
					$('#errorBlock').hide();
				} else {
				// если мы получим что другое то мы будем знать что это ошибка и будем выводить в каком нибудь блоке
				$('#errorBlock').show(); // выводим блок если ошибка
				$('#errorBlock').text(data); // передаем что выводить в параметре data
				//выводим ошибки в файле reg/reg.php
				}
			}
		});
	});
</script>
</body>
</html>
