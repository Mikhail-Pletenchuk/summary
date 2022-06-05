<section class="adminPanel">
	<h2>Пользователи сайта</h2>
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<thead>
				<tr class="">
					<th>ID</th>
					<th>Email</th>
					<th>ФИО</th>
					<th>Дата рождения</th>
					<th>Пол</th>
					<th>Телефон</th>
					<th>Гражданство</th>
					<th>Город</th>
					<th>Дата регистрации</th>
					<th>Доступ</th>
					<th></th>
				</tr>
			</thead>

			<tbody>
				<?php foreach($users as $user) : ?>
				<tr> 
					<td><?=$user['ID']; ?></td>
					<td><?=$user['email']; ?></td>
					<td><?=$user['lastname']; ?> <?=$user['firstname']; ?> <?=$user['sirname']; ?></td>
					<td><?=$user['birth_date'] ? date("d.m.Y", strtotime($user['birth_date'])) : ''; ?></td>
					<td><?=$user['sex'] ? "ж" : "м"; ?></td>
					<td><?=$user['phone']; ?></td>
					<?php $citizen = getNationality($user['nationality_id']); ?>
					<td><?=$citizen[0]['citizen']; ?></td>
					<td><?=$user['city']; ?></td>
					<td><?=$user['register_date']; ?></td>
					<td><?php if ($user['access'] == 3) echo "admin"; if ($user['access'] == 2) echo "view";?></td>
					
					<td>
					<?php if ($user['access'] < $_SESSION['access']) : ?>
						<a href="?delete_user=<?=$user['ID']; ?>">Удалить</a>
					<?php endif; ?>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</section>