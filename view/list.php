<!-- < ?=debug($fields_summary['photo']); ?> -->
<!-- < ?=debug($fields_summary['experiences']); ?> -->
<!-- < ?=debug($fields_summary['education']); ?> -->
<!-- < ?=debug($fields_summary['skills']); ?> -->
<!-- < ?=debug($_POST); ?> -->
<!-- < ?=debug($_FILES); ?> -->


<div class="list">
	<div class="fio">
		<div class="photo"><img src="<?=$fields_summary['photo']['value'] ? 'img/users/'.$fields_summary['photo']['value'] : 'img/photo.jpg'; ?>" alt="Фотография"></div>
		<div class="">
			<b>
			<?=$fields_summary['lastname']['value']; ?><br>
			<?=$fields_summary['firstname']['value']; ?> <?=$fields_summary['sirname']['value']; ?><br>
			</b><br>

			<?=$fields_summary['position']['value']; ?><br><br>

			<div class="phone">
				<img src="img/icons/phone.svg" alt="" width="20" height="20"><?=$fields_summary['phone']['value']; ?><br>
			</div>
			<img src="img/icons/email.svg" alt="" width="20" height="20"> <?=$fields_summary['email']['value']; ?><br>
			Город проживания - <?=$fields_summary['city']['value']; ?><br>
		</div>
		<div class="work">
			<br>
			Желаемая зарплата: <?=$fields_summary['salary']['value']; ?> рублей. </*?=$_POST['currency']; ?><br>
			<!-- !//! -->
			Готовность к командировкам: <?=$fields_summary['trips']['value'] ? "да" : "нет"; ?><br>
			<?php
				$employment = ['Полная', 'Частичная', 'Проектная', 'Стажировка', 'Волонтёрство'];
			?>
			Занятость: <?=$employment[$fields_summary['employment']['value']]; ?><br>
			<?php
				$schedule = [
					'Полный день',
					'Сменный график',
					'Гибкий график',
					'Удаленная работа',
					'Вахтовый метод',
				];
			?>
			График работы: <?=$schedule[$fields_summary['schedule']['value']]; ?><br>
		</div>
	</div>

	<div class="personal">
		<b>Личная информация</b>
		<!-- Переезд - возможен/невозможен<br> -->
		<?php $citizen = getNationality($fields_summary['nationality_id']['value']); ?>
		Гражданство: <?=$citizen[0]['citizen']; ?><br>
		Дата рождения: <?=date("d.m.Y", strtotime($fields_summary['birth_date']['value'])); ?><br>
		Пол: <?=$fields_summary['sex']['value'] ? "женский" : "мужской"; ?><br>
		Семейное положение: <?=$fields_summary['family']['value'] ? "женат / замужем" : "холост / не замужем"; ?><br>
		Есть дети: <?=$fields_summary['children']['value'] ? "да" : "нет"; ?><br><br>
	</div>

	
	<!-- !//! нужна корректная проверка на пустоту массива ? -->
	<?php if ($fields_summary['education']['value']) : ?>
	<div class="education">
		<h3>Образование</h3>
		<?php foreach ($fields_summary['education']['value'] as $key => $teach) : ?>
			<p>
				Учебное заведение: <?=$teach['place_of_study']; ?><br>
				Специальность: <?=$teach['specialty']; ?><br>
				Дата окончания: <?=date("d.m.Y", strtotime($teach['end_date'])); ?><br>
			</p>
		<?php endforeach; ?>	
	</div>
	<?php endif; ?>	



	<?php if ($fields_summary['experiences']['value']) : ?>
	<div class="experiences">
		<h3>Опыт работы</h3>
		<?php foreach ($fields_summary['experiences']['value'] as $key => $work) : ?>
			<p>
				Организация: <?=$work['place_of_work']; ?><br>
				Должность: <?=$work['position']; ?><br>
				Период работы: с <?=date("d.m.Y", strtotime($work['start_date'])); ?> по <?=$work['end_date'] ? date("d.m.Y", strtotime($work['end_date'])) : "настоящее время"; ?><br>
				<?php if (isset($work['achievement']) && $work['achievement']) : ?>Должностные обязанности и достижения: <?=$work['achievement']; ?><?php endif; ?>
			</p>
		<?php endforeach; ?>	
	</div>
	<?php endif; ?>	


	<?php if ($fields_summary['skills']['value']) : ?>
	<div class="skills">
		<h3>Навыки</h3>
		<p>
		<?php foreach ($fields_summary['skills']['value'] as $key => $skill) : ?>
		- <?=$skill; ?><br>
		<?php endforeach; ?>	
		</p>
	</div>
	<?php endif; ?>



	<?php if ($fields_summary['information']['value']) : ?>
	<div class="information">
		<h3>Дополнительная информация</h3>
		<p><?=$fields_summary['information']['value']; ?></p>
	</div>
	<?php endif; ?>	

</div>
