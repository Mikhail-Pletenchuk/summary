<?php
	$name = "admin@email.ru";
	$error = "";
	$modalShow = "";
	if (isset($_SESSION['email']) && $_SESSION['email']) {
		$name = $_SESSION['email'];
	}
	if (isset($_SESSION['errCheckLogin'])) {
		$error = $_SESSION['errCheckLogin'];
		$modalShow = " modal-show";
		unset($_SESSION['errCheckLogin']);
	}
?>

<section id="login" class="login modal<?=$modalShow; ?>">
	<h2>Вход на сайт</h2>
	<p class="modal-description">Введите свой логин и пароль.</p>
	<!-- action="index.php" action="check_login.php"-->
	<form class="login-form" method="post">
		<p>
			<label class="sr-only" for="user-login">Логин</label>
			<input class="login-icon-user" id="user-login" type="text" name="userlogin" placeholder="Email" value="<?=$name; ?>" >
		</p>
		<p>
			<label class="sr-only" for="user-password">Пароль</label>
			<input class="login-icon-password" id="user-password" type="password" name="userpass" placeholder="*****" value="admin" >
		</p>
		<input name="login" type="submit" value="Войти">
		<div class="errors"><?=$error; ?></div>
	</form>
	<button class="modal-close" type="button"><span class="sr-only">Закрыть</span></button>
</section>