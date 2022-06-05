<nav class="navbar navbar-expand-lg navbar-dark bg-primary container">
	<a class="navbar-brand" href="index.php">Твоё резюме</a>

	<div class="collapse navbar-collapse" id="navbarColor01">
		<ul class="navbar-nav mr-auto">
			<!-- <li class="nav-item active">
				<a class="nav-link" href="index.php">Главная</a>
			</li> -->
			<li class="nav-item">
				<a id="task-link" class="nav-link" href="#" style="color: lemonchiffon;">Задание на диплом</a>
			</li>
			<!-- <li class="nav-item">
				<a class="nav-link" href="#">Примеры резюме</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Помощь</a>
			</li> -->
		</ul>

		<ul class="navbar-nav mx-2">
		<?php if (isset($_SESSION['access'])) : ?>
			<?php if ($_SESSION['access'] == 3) : ?>
				<li class="nav-item active">
					<a class="nav-link admin" href="admin.php">Админка</a>
				</li>
			<?php endif ?>
			<li class="nav-item active">
				<a class="nav-link" href="private.php">
					<img src="img/icons/user.svg" alt=""> <span><?=$_SESSION['email']; ?></span>
				</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="exit.php">Выход</a>
			</li>

		<?php else: ?>
			<li class="nav-item active">
				<a id="login-link" class="nav-link" href="#">Войти</a>
			</li>
			<li class="nav-item active">
				<a id="register-link" class="nav-link" href="#">Регистрация</a>
			</li>
		<?php endif ?>
		</ul>

		<?php if (isset($_SESSION['access'])) : ?>
		<!-- <form class="form-inline my-2 my-lg-0" action="search.php" method="post">
			<input class="form-control mr-sm-2" type="text" name="search" placeholder="Поиск">
			<button class="btn btn-secondary my-2 my-sm-0" type="submit">Найти</button>
		</form> -->
		<?php endif ?>
	</div>
</nav>

<?php if (!isset($_SESSION['access'])) : ?>
	<?=$login; ?>
	<?=$registr; ?>
<?php endif; ?>