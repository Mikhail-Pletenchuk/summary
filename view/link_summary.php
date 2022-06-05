<section class="summary">

	<h2>Мои резюме</h2>
	<?php if ($summary) : ?>
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr class="">
					<th>Наименование</th>
					<th>Публикация</th>
					<th>Ссылка</th>
				</tr>
			</thead>

			<tbody>
			<?php foreach($summary as $resume) : ?>
				<tr>
					<td>
						<a href="view_summary.php?slug=<?=$resume['ID']; ?>"><?=$resume['position']; ?> на оклад <?=$resume['salary']; ?> руб. (<?=date("d.m.Y G:i", strtotime($resume['refrech_date'])); ?>)</a>
					</td>
					<td>
						<?php if ($resume['public']) : ?>
							<a href="?delete_public=<?=$resume['ID']; ?>">Снять публикацию</a>
						<?php else : ?>
							<a href="?set_public=<?=$resume['ID']; ?>">Опубликовать</a>
						<?php endif; ?>
					</td>
					<td>
						<?php if ($resume['public']) : ?>
							<?=getPublicUrl($resume); ?>
						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php else : ?>
		<p>У вас еще нет ни одного резюме.</p>
	<?php endif; ?>

</section>

<!-- hash("md5", $resume['ID']); -->