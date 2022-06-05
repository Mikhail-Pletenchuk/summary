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
	<link rel="stylesheet" href="css/templ<?=(int)$template; ?>.css">
</head>

<body>
	<div class="container"><br>
	<?php if ($_SESSION['access']) : ?>
		<a class="btn btn-success" href="private.php">В личный кабинет</a>
	<?php endif; ?>
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