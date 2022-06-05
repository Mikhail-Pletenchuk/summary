<?php
	$name = "test@email.ru";
	$error = "";
	$modalShow = "";
	if (isset($_SESSION['email']) && $_SESSION['email']) {
		$name = $_SESSION['email'];
	}
	if (isset($_SESSION['errRegister'])) {
		$error = $_SESSION['errRegister'];
		$modalShow = " modal-show";
		unset($_SESSION['errRegister']);
	}
?>

<section id="register" class="register modal<?=$modalShow; ?>">
	<h2>Зарегистрироваться</h2>

	<form action="index.php" method="post">
		<p>
			<label class="sr-only" for="email-registr">Email</label>
			<input class="login-icon-user" id="email-registr" type="email" name="email" placeholder="email" value="<?=$name; ?>" >
		</p>
		<p>
			<label class="sr-only" for="password">Пароль</label>
			<input class="" id="password" type="password" name="password" placeholder="*****" value="test" >
		</p>
		<p>
			<label class="sr-only" for="password_again">Повторите пароль</label>
			<input class="" id="password_again" type="password" name="password_again" placeholder="*****" value="test" >
		</p>
		<input name="register" type="submit" value="Зарегистрироваться">
		<div class="errors"><?=$error; ?></div>
	</form>
	<button class="modal-close" type="button"><span class="sr-only">Закрыть</span></button>
</section>