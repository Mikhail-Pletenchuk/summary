<div class="container">
	<hr>

	<form action="view.php" method="POST" enctype="multipart/form-data">
		<div class="row">
			<div class="col-md-4 mt-3">
				<label class="" for="lastname">
					Фамилия<?php if ($fields_summary['lastname']['required']) : ?> <small class="text-danger">(обязательно)</small><?php endif; ?>
				</label>
				<input class="form-control" id="lastname" name="lastname" value="<?=$fields_summary['lastname']['value']; ?>"<?php if ($fields_summary['lastname']['required']) : ?> required<?php endif; ?>>
			</div>

			<div class="col-md-4 mt-3">
				<label class="" for="firstname">
					Имя<?php if ($fields_summary['firstname']['required']) : ?> <small class="text-danger">(обязательно)</small><?php endif; ?>
				</label>
				<input class="form-control" id="firstname" name="firstname" value="<?=$fields_summary['firstname']['value']; ?>"<?php if ($fields_summary['firstname']['required']) : ?>  required<?php endif; ?>>
			</div>

			<div class="col-md-4 mt-3">
				<label class="" for="sirname">
					Отчество<?php if ($fields_summary['sirname']['required']) : ?> <small class="text-danger">(обязательно)</small><?php endif; ?>
				</label>
				<input class="form-control" id="sirname" name="sirname" value="<?=$fields_summary['sirname']['value']; ?>"<?php if ($fields_summary['sirname']['required']) : ?> required<?php endif; ?>>
			</div>

			<div class="col-md-4 mt-3">
				<label class="" for="position">
					Должность<?php if ($fields_summary['position']['required']) : ?> <small class="text-danger">(обязательно)</small><?php endif; ?>
				</label>
				<input class="form-control" id="position" name="position" value="<?=$fields_summary['position']['value']; ?>"<?php if ($fields_summary['position']['required']) : ?> required<?php endif; ?>>
			</div>

			<div class="col-md-4 mt-3">
			<!-- ! --><br>
				<label><input type="checkbox" id="trips" name="trips" <?php if ($fields_summary['trips']['value']) : ?> checked<?php endif; ?>>
					Готовность к командировкам</label>
			</div>

			<div class="col-md-4 mt-3">
				<label class="" for="salary">
					Желаемая зарплата<?php if ($fields_summary['salary']['required']) : ?> <small class="text-danger">(обязательно)</small><?php endif; ?>
				</label>
				<div class="input-group">
					<input class="form-control" type="number" id="salary" name="salary" placeholder="100 000" value="<?=$fields_summary['salary']['value']; ?>"<?php if ($fields_summary['salary']['required']) : ?> required<?php endif; ?>>
					<!-- ! -->
					<div class="input-group-btn">
						<select class="form-control" name="currency" disabled>
							<option value="1">рублей</option>
							<option value="2">долларов</option>
							<option value="3">евро</option>
							<option value="4">тенге</option>
							<option value="5">гривен</option>
							<option value="6">манат</option>
							<option value="7">лари</option>
							<option value="8">сом</option>
							<option value="9">сум</option>
						</select>
					</div>
				</div>
			</div>

			<div class="col-md-4 mt-3">
				<label class="" for="summary-email">
					Электронная почта
				</label>
				<?php if (isset($_SESSION['email'])) : ?>
					<input class="form-control" type="email" id="summary-email" name="" value="<?=$_SESSION['email']; ?>"<?php if ($fields_summary['email']['required']) : ?> required<?php endif; ?> disabled>
					<input type="hidden" name="email" value="<?=$_SESSION['email'] ?? ''; ?>"<?php if ($fields_summary['email']['required']) : ?> required<?php endif; ?>>
				<?php else : ?>
					<input class="form-control" type="email" id="summary-email" name="email" value=""<?php if ($fields_summary['email']['required']) : ?> required<?php endif; ?>>
				<?php endif; ?>
				<!-- <small class="form-text text-danger">
					на этот е-мейл будут высланы ссылки для просмотра и редактирования резюме
				</small> -->
			</div>

			<div class="col-md-4 mt-3">
				<label class="" for="phone">
					Телефон для связи<?php if ($fields_summary['phone']['required']) : ?> <small class="text-danger">(обязательно)</small><?php endif; ?>
				</label>
				<input class="form-control" type="tel" id="phone" name="phone" value="<?=$fields_summary['phone']['value']; ?>"<?php if ($fields_summary['phone']['required']) : ?> required<?php endif; ?>>
			</div>

			<?php
				$employment = ['Полная', 'Частичная', 'Проектная', 'Стажировка', 'Волонтёрство'];
			?>
			<div class="col-md-4 mt-3">
				<label class="" for="employment">Занятость</label>
				<select class="form-control" id="employment" name="employment">
					<?php foreach ($employment as $key => $value) : ?>
					<option value="<?=$key; ?>"<?php if ($fields_summary['employment']['value'] == $key) : ?> selected<?php endif; ?>><?=$value; ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<?php
				$schedule = [
					'Полный день',
					'Сменный график',
					'Гибкий график',
					'Удаленная работа',
					'Вахтовый метод',
				];
			?>
			<div class="col-md-4 mt-3">
				<label class="" for="schedule">График работы</label>
				<select class="form-control" id="schedule" name="schedule">
					<?php foreach ($schedule as $key => $value) : ?>
					<option value="<?=$key; ?>"<?php if ($fields_summary['schedule']['value'] == $key) : ?> selected<?php endif; ?>><?=$value; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>

		<hr>
		<h2>Личная информация</h2>
		<div class="row">
			<div class="col-md-4 mt-3">
				<label class="" for="city">Город проживания</label>
				<input class="form-control" id="city" name="city" value="<?=$fields_summary['city']['value']; ?>"<?php if ($fields_summary['city']['required']) : ?> required<?php endif; ?>>
			</div>

			<div class="col-md-4 mt-3">
				<!--//! синхронизировать с бд городов -->
				<label class="" for="citizen">Гражданство</label>
				<select class="form-control" id="citizen" name="nationality_id">
					<?php foreach ($citizen as $country) : ?>
					<option value="<?=$country['ID']; ?>"<?php if ($fields_summary['nationality_id']['value'] == $country['ID']) : ?> selected<?php endif; ?>><?=$country['citizen']; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="col-md-4 mt-3">
				<!-- ! всплывает календарь -->
				<label class="" for="birth_date">
					Дата рождения<?php if ($fields_summary['birth_date']['required']) : ?> <small class="text-danger">(обязательно)</small><?php endif; ?>
				</label>
				<input type="date" class="form-control hasDatepicker" id="birth_date" name="birth_date" value="<?=$fields_summary['birth_date']['value']; ?>"<?php if ($fields_summary['birth_date']['required']) : ?> required<?php endif; ?>>
			</div>


			<!-- <label class="">Переезд</label>
			<select class="form-control" name="select" data-bind="value: crossing">
				<option value="0">Невозможен</option>
				<option value="1">Возможен</option>
				<option value="2">Нежелателен</option>
				<option value="3">Желателен</option>
			</select> -->

			<div class="col-md-4 mt-3">
				<!-- ! --><br>
				<label class="">Пол</label>
				<label><input type="radio" value="0" name="sex"<?php if ($fields_summary['sex']['value'] == 0) : ?> checked<?php endif; ?>>Мужской</label>
				<label><input type="radio" value="1" name="sex"<?php if ($fields_summary['sex']['value'] == 1) : ?> checked<?php endif; ?>>Женский</label>
			</div>


			<div class="col-md-4 mt-3">
				<label class="" for="family">Семейное положение</label>
				<select class="form-control" id="family" name="family">
					<option value="0"<?php if ($fields_summary['family']['value'] == 0) : ?> selected<?php endif; ?>>Холост / Не замужем</option>
					<option value="1"<?php if ($fields_summary['family']['value'] == 1) : ?> selected<?php endif; ?>>Женат / Замужем</option>
				</select>
			</div>

			<div class="col-md-4 mt-3">
				<!-- ! --><br>
				<label><input type="checkbox" id="children" name="children"<?php if ($fields_summary['children']['value']) : ?> checked<?php endif; ?>>Есть дети</label>
			</div>

			<div class="col-md-4 mt-3">
				<label for="photo" class="">Фото</label>
				<input class="btn" type="file" id="photo" name="photo">
			</div>
		</div>


		<hr><h2>Образование</h2>
		<div class="form-horizontal" id="teach">
			<?php foreach ($fields_summary['education']['value'] as $key => $education) : ?>
			<fieldset>
				<div class="row">
					<div class="col-md-4 mt-3">
						<label class="" for="teach_institution_<?=$key; ?>">Учебное заведение</label>
						<input class="form-control" id="teach_institution_<?=$key; ?>" name="teach_institution_<?=$key; ?>" value="<?=$education['place_of_study']; ?>" >
					</div>
					
					<div class="col-md-4 mt-3">
						<label class="" for="teach_specialty_<?=$key; ?>">Специальность</label>
						<input class="form-control" id="teach_specialty_<?=$key; ?>" name="teach_specialty_<?=$key; ?>" value="<?=$education['specialty']; ?>" >
					</div>

					<div class="col-md-3 mt-3">
						<label class="" for="teach_end_<?=$key; ?>">Дата окончания</label>
						<input class="form-control" type="date" id="teach_end_<?=$key; ?>" name="teach_end_<?=$key; ?>" placeholder="по настоящее время" value="<?=$education['end_date']; ?>" >
					</div>

					<div class="col-md-1 mt-3">
						<br><button data-delete="fieldset" class="btn btn-danger">-</button>
					</div>
				</div>
			</fieldset>
			<?php endforeach; ?>	
		</div>
		
		<div class="text-center">
			<br>
			<input id="add_teach" type="button" class="btn btn-success" value="+ Добавить">
		</div>

<!-- //! -->
		<hr><h2>Опыт работы</h2>
		<div class="form-horizontal" id="works">
			<?php foreach ($fields_summary['experiences']['value'] as $key => $experiences) : ?>
			<fieldset>
				<div class="row">
					<div class="col-md-4 mt-3">
						<label class="" for="work_company_<?=$key; ?>">Организация</label>
						<input class="form-control" id="work_company_<?=$key; ?>" name="work_company_<?=$key; ?>" value="<?=$experiences['place_of_work']; ?>" >
					</div>
					
					<div class="col-md-4 mt-3">
						<label class="" for="work_position_<?=$key; ?>">Должность</label>
						<input class="form-control" id="work_position_<?=$key; ?>" name="work_position_<?=$key; ?>" value="<?=$experiences['position']; ?>" >
					</div>

					<div class="col-md-2 mt-3">
						<label class="" for="work_from_<?=$key; ?>">Период работы: с</label>
						<input class="form-control" type="date" id="work_from_<?=$key; ?>" name="work_from_<?=$key; ?>" placeholder="с __.____" value="<?=$experiences['start_date']; ?>" >
					</div>
					<div class="col-md-2 mt-3">
						<label class="" for="work_to_<?=$key; ?>">по</label>
						<input class="form-control" type="date" id="work_to_<?=$key; ?>" name="work_to_<?=$key; ?>" placeholder="по настоящее время" value="<?=$experiences['end_date']; ?>">
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-8 mt-3">
						<label class="" for="work_achievement_<?=$key; ?>">Должностные обязанности и достижения</label>
						<textarea class="form-control" id="work_achievement_<?=$key; ?>" name="work_achievement_<?=$key; ?>"><?=$experiences['achievement']; ?></textarea>
					</div>

					<div class="col-md-4 mt-3">
						<br><br><button data-delete="fieldset" class="btn btn-danger">Удалить</button>
					</div>
				</div>
			</fieldset>
			<?php endforeach; ?>	
		</div>

		<div class="text-center">
			<br>
			<input id="add_work" type="button" class="btn btn-success" value="+ Добавить">
		</div> 
<!-- //! -->

		<hr><h2>Навыки</h2>
		<div class="row form-horizontal" id="skills">
			<?php foreach ($fields_summary['skills']['value'] as $key => $skill) : ?>
			<div class="col-md-4 mt-3"><input class="form-control" name="skills[]" list="skills_list" value="<?=$skill; ?>"></div>
			<?php endforeach; ?>			
		</div>
		<datalist id="skills_list">
			<?php foreach ($skills as $skill) : ?>
			<option value="<?=$skill['name']; ?>">
			<?php endforeach; ?>
		</datalist>

		<div class="text-center">
			<br>
			<input id="add_skill" type="button" class="btn btn-success" value="+ Добавить">
		</div>


		<hr>
		<div class="row">
			<div class="col-md-8 mt-3">
				<label class="" for="information">Дополнительная информация</label>
				<textarea class="form-control" name="information" id="information" ><?=$fields_summary['information']['value']; ?></textarea>
			</div>
		</div>

		<hr>
		<div class="mt-3">
			<label class="">Выберите шаблон</label>
			<!-- ! --><br>
			<label><input type="radio" value="0" name="template"<?php if ($fields_summary['template']['value'] == 0) : ?> checked<?php endif; ?>> Первый </label>
			<label><input type="radio" value="1" name="template"<?php if ($fields_summary['template']['value'] == 1) : ?> checked<?php endif; ?>> Второй</label>
		</div>
		<!-- <div class="form-group">
			<label class="">Выберите шаблон</label>
			<div class="col-sm-9 col-md-10">
				<div class="edit-templates">

					<div class="template-tale col-xs-6 col-sm-6 col-md-4 col-lg-3 selected"
						data-bind="click: template.bind($data, 1), css: { &#39;selected&#39;: template() == 1 }">
						<div class="template-tale-image">
							<div class="template-tale-image-overlay"></div>
							<img class="img-responsive" src="./Создать резюме_files/classic_preview.jpg">
						</div>
						<div>Классический</div>
					</div>

					<div class="template-tale col-xs-6 col-sm-6 col-md-4 col-lg-3"
						data-bind="click: template.bind($data, 2), css: { &#39;selected&#39;: template() == 2 }">
						<div class="template-tale-image">
							<div class="template-tale-image-overlay"></div>
							<img class="img-responsive" src="./Создать резюме_files/modern_preview.jpg">
						</div>
						<div>Современный</div>
					</div>

					<div class="template-tale col-xs-6 col-sm-6 col-md-4 col-lg-3"
						data-bind="click: template.bind($data, 3), css: { &#39;selected&#39;: template() == 3 }">
						<div class="template-tale-image">
							<div class="template-tale-image-overlay"></div>
							<img class="img-responsive" src="./Создать резюме_files/pro_preview.jpg">
						</div>
						<div>Профессиональный</div>
					</div>
				</div>
			</div>
		</div> -->

		<div class="text-center">
			<p>
				<input name="summary" type="submit" class="btn btn-primary" value="Предпросмотр"></input>
			</p>
		</div>
		<!-- <div class="text-center">
			<p>Ваше резюме заполнено на <span class="text-danger">30</span>% (рекомендуем не менее
				80%)</p>
		</div> -->
	</form>

	<!-- //! не подхватываются данные из формы -->
	<!-- <?php if (isset($_SESSION['summary_id'])) : ?>
	<form class="text-center" method="post">
		<input name="update" class="btn btn-primary" type="submit" value="Обновить">
	</form>
	<?php endif; ?> -->
</div>