<!DOCTYPE html>
<html lang="ru">
<?php
$website_title = 'Авторизация на сайте';
require 'bloks/head.php' ?>
<body>
	<?php require 'bloks/header.php'; ?>
				<main class="container mt-5">
					<div class="row">
						<div class="col-md-8 mb-3">
              <?php
                if($_COOKIE['log'] == ''): // если куки пустое те еще не используется то будет видна форма в остальных случ форму не видно
              ?>
              <h4>Авторизация</h4>
							<form action="" method="post">
								<label for="login">Логин</label>
								<input type="text" name="login" id="login" class="form-control">

								<label for="pass">Пароль</label>
								<input type="password" name="pass" id="pass" class="form-control">

								<div class="alert alert-danger mt-2" id="errorBlock"></div>

								<button type="button" id="auth_user" class="btn btn-success mt-3">Войти</button>
							</form>
              <?php
              else:
              ?>
                <h2><?=$_COOKIE['log'] ?></h2>
                <button class="btn btn-danger" id ="exit_btn">Выйти</div>
              <?php
              endif;
              ?>
              <?php require 'bloks/aside.php'; ?>
            </div>
					</div>
				</main>

<?php require 'bloks\footer.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
	$('#exit_btn').click(function() {
		$.ajax({
			url: 'ajax/exit.php',
			type: 'POST', // далее указываем тип передачи данных
			cache: false, // дальше, будет ли кеширование данных
			data: {},	// тут указываем какую информацию передаем тут это обьект data а если это обьект то указываем фигургые скобки {}
			dataType: 'html', // тут указываем способ получения данных
			success: function (data) { // success - функция обработается когда мы получим ответ от сервера
      document.location.reload(true);
			}
		});
	});

//<!--> скрипт ajax запрос на сервер который будет получать от туда данные для этого в button submit добавим id
//и в форм action можно убрать ajax.php тк обработка будет происходить на этой странице
 //</!-->

	//получаем кнопку $('#reg_user') и если на нее нажали $('#reg_user').click(function() то обрабатываем функцию
	$('#auth_user').click(function() {
		//alert("asd"); // при нажатии на кнопку выскакивыет алерт
		var login = $('#login').val();
		var pass = $('#pass').val(); // получили данные

		// и теперь можем отправить ajax запрос
		$.ajax({
			//url: ''// это тот файл по которому будет выполняться данный скрипт
			url: 'ajax/auth.php',
			type: 'POST', // далее указываем тип передачи данных
			cache: false, // дальше, будет ли кеширование данных
			data: { 	// тут указываем какую информацию передаем тут это обьект data а если это обьект то указываем фигургые скобки {}
				'login' : login,
				'pass' : pass
			},
			dataType: 'html', // тут указываем способ получения данных
			// beforeSend: function () {}.  информация которая будет обработана до того как мы получим ответ от сервера
			success: function (data) { // success - функция обработается когда мы получим ответ от сервера
				if(data == 'Готово') { // если эти данные которые будут переданы и это слово готово то мы будем знать что у нас данные отправлены, пользователь зареган
					$('#auth_user').text('Готово'); // если из файла reg.php отправим данные готово то изменим тогда на все готово
					$('#errorBlock').hide();
          document.location.reload(true);
				} else {
				// если мы получим что другое то мы будем знать что это ошибка и будем выводить в каком нибудь блоке
				$('#errorBlock').show(); // выводим блок если ошибка
				$('#errorBlock').text(data); // передаем что выводить в параметре data
				//выводим ошибки в файле ajax/reg.php
				}
			}
		});
	});
</script>
</body>
</html>
