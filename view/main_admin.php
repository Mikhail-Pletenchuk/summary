<!-- <ul class="nav nav-tabs">
	<li class="active">Пользователи</li>
	<li>Резюме</li>
</ul> -->

<button data-id="#table_users" class="btn btn-primary toggle">Пользователи</button>
<button data-id="#table_summary" class="btn btn-primary toggle">Резюме</button>

<div class="about-content-box-wrapper">
	<div class="about-content__box" id="table_users">
		<?=$table_users; ?>
	</div>

	<div class="about-content__box" id="table_summary">
		<?=$table_summary; ?>
	</div>
</div>
