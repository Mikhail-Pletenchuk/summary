<!-- < ?php if (isset($_SESSION['summary_id'])) : ?>
<form class="text-center" method="post">
	<input name="update" class="btn btn-primary" type="submit" value="Обновить">
</form>
< ?php endif; ?> -->

<?php if (isset($_SESSION['access'])) : ?>
<form class="text-center" method="post" action="index.php">
	<input name="save" class="btn btn-success" type="submit" value="Сохранить">
</form>
<?php endif; ?>

<form class="text-center" method="post" action="public_summary.php">
	<input name="public" class="btn btn-success" type="submit" value="Опубликовать">
</form>

<!-- <form class="" method="post" action="index.php">
	<input name="" class="btn btn-primary" type="submit" value="Загрузить PDF">
</form>

<form class="" method="post" action="index.php">
	<input name="" class="btn btn-primary" type="submit" value="Зарегистрироваться">
</form>
 -->