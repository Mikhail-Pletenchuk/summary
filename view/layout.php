<?php
	if (!isset($_SESSION['access'])) {
		$login = render("login.php");
		$registr = render("register.php");
		$nav = render("nav.php", ["login" => $login, "registr" => $registr]);
	} else {
		$nav = render("nav.php");
	}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
	<title><?=$head["title"]; ?></title>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?=$head["description"]; ?>">
	<meta name="keywords" content="<?=$head["keywords"]; ?>">

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/main.css">
	<!-- Стили отображения резюме -->
	<?php if (isset($_POST['template'])) : ?>
			<link rel="stylesheet" href="css/templ<?=(int)$_POST['template']; ?>.css">
	<?php endif; ?>
</head>

<body>
	<?=$nav; ?>

	<div id="task" class="container modal">
		<b>Задание:</b><br>
		<label><input type="checkbox" checked disabled> Конструктор резюме (с красивым skillset, используя бесплатные иконки сервисов)</label><br>
		<label><input type="checkbox" checked disabled> Основные поля резюме, добавление навыков из списка (но можно добавить свои)</label>
		<label><input type="checkbox" checked disabled> Возможность создания резюме по шаблону дизайна (данные одни и те же, оформление разное)</label>
		<label><input type="checkbox" checked disabled> Генерация резюме: создать html (для продвинутых - создать pdf), ссылка для работодателя (доступ “только для чтения”).</label>
		<label><input type="checkbox" checked disabled> Возможность сохранить готовое резюме в своём аккаунте (для этого нужна регистрация в сервисе).</label>
		<label><input type="checkbox" checked disabled> Затем при входе можно создать другое резюме на базе предыдущего</label>
	</div>

	<main class="container">
		<?=$content; ?>
	</main>

	<div id="message" class="modal<?=$message ? ' modal-show' : ''; ?>">
		<p><?=$message; ?></p>
		<button class="modal-close" type="button"><span class="sr-only">Закрыть</span></button>
	</div>

	<footer class="container">
		<p>© Сервис Конструктор-резюме</p>
	</footer>

	<script type="module" src="js/main.js"></script>

	<!-- Yandex.Metrika counter -->
	<!-- <script type="text/javascript" src="./js/yandex.js"></script>
	<noscript>
		<div><img src="https://mc.yandex.ru/watch/66967825" style="position:absolute; left:-9999px;" alt="" /></div>
	</noscript> -->
	<!-- /Yandex.Metrika counter -->
</body>

</html>