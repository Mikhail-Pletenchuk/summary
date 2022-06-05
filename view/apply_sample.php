<section class="apply_sample">
	<div class="container">
		<form action="" method="POST">
			<div class="row">
				<div class="col-md-4">
					<label class="" for="summary_example">Образцы резюме</label>
					<select class="form-control" id="summary_example" name="summary_example">
						<option value="" selected>- Выберите образец, если нужно -</option>
						<?php foreach ($summary_example as $position) : ?>
						<option value="<?=$position['ID']; ?>"><?=$position['position']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>

				<?php if ($summary_mine) : ?>
				<div class="col-md-4">
					<label class="" for="summary_mine">Мои резюме</label>
					<select class="form-control" id="summary_mine" name="summary_mine">
						<option value="" selected>- Выберите образец, если нужно -</option>
						<?php foreach ($summary_mine as $position) : ?>
						<option value="<?=$position['ID']; ?>"><?=$position['position']; ?> <?=$position['create_date']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<?php endif; ?>


				<div class="col-md-4 text-center">
					<br>
					<input name="sample" type="submit" class="btn btn-primary" value="Применить"></input>
				</div>

			</div>
		</form>
	</div>
</section>