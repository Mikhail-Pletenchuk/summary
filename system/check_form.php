<?php 
if (isset($_POST['login'])) {
	$fields_login = load($fields_login);
	$_SESSION['email'] = $fields_login['userlogin']['value'];

	if (!$errors = validate($fields_login)) {
		$user = getUsers($fields_login['userlogin']['value']);
			
		if (!$user) {
			$errors = "<br>Пара \"Логин - Пароль\" не совпадает. <br>Введите \"Логин\" и \"Пароль\" повторно.";
		}
		else {
			if (password_verify($fields_login['userpass']['value'], $user[0]['password'])) {
				$_SESSION['email'] = $user[0]['email'];
				$_SESSION['access'] = $user[0]['access'];
				
				$message = "Добро пожаловать на сайт!";
			} else {
				$errors = "<br>Пара \"Логин - Пароль\" не совпадает. Введите \"Логин\" и \"Пароль\" повторно.";
			}
		}
	}

	if ($errors) {
		$_SESSION['errCheckLogin'] = $errors;
	}
}

if (isset($_POST['register'])) {
	$fields_register = load($fields_register);
	$_SESSION['email'] = $fields_register['email']['value'];

	if (!$errors = validate($fields_register)) {
		$user = getUsers($fields_register['email']['value']);
			
		if ($user) {
			$errors = "<br>Пользователь с указанным Email уже зарегистрирован.";
		} else {
			if ($fields_register['password']['value'] !== $fields_register['password_again']['value']) {
				$errors = "<br>Введенные пароли не совпадают.";
			} else {
				$email = $fields_register['email']['value'];
				$hash_pass = password_hash($fields_register['password']['value'], PASSWORD_DEFAULT);
				$access = 1;

				setUser($email, $hash_pass, $access);

				$_SESSION['email'] = $email;
				$_SESSION['access'] = $access;

				$message = "Вы успешно зарегестрировались!";
			}
		}
	}

	if ($errors) {
		$_SESSION['errRegister'] = $errors;
	}
}
