<section class="summary">
	<h2>Резюме</h2>
	<?php if ($summary) : ?>
	<div class="table-responsive">
		<table class="table table-striped table-bordered"> 
			<tr>
				<th>users_id</th>
				<th>Должность</th>
				<th>Зарплата</th>
				<th>Валюта</th>
				<th>Занятость</th>
				<th>График</th>
				<th>Командировки</th>
				<th>Холост/женат</th>
				<th>Дети</th>
				<!-- <th>Доп. информация</th> -->
				<th>Дата регистрации</th>
				<!-- <th>Дата обновления</th> -->
			</tr>
			<?php foreach($summary as $resume) : ?>
			<tr>
				<td><?=$resume['users_id']; ?></td>
				<td><?=$resume['position']; ?></td>
				<td><?=$resume['salary']; ?></td>
				<td><?=$resume['currency']; ?></td>
				<td><?=$resume['employment']; ?></td>
				<td><?=$resume['schedule']; ?></td>
				<td><?=$resume['trips']; ?></td>
				<td><?=$resume['family']; ?></td>
				<td><?=$resume['children']; ?></td>
				<!-- <td><?=$resume['information']; ?></td> -->
				<td><?=$resume['create_date']; ?></td>
				<!-- <td><?=$resume['refrech_date']; ?></td> -->
				<!-- print "<td>"; -->
				<!-- if ($row['Доступ'] < 10) {
					print "<a href='delete.php?id=".$row['Код клиента']."'>Удалить</a>";			} -->
				<!-- </td> -->
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
	<?php else : ?>
		<p>У вас еще нет ни одного резюме</p>
	<?php endif; ?>

</section>