// import * as setting from "./setting.js";
import { modal, addBlock, initButtonsDelete } from "./site.js";

initButtonsDelete();

modal("login", "login-link");
modal("register", "register-link");
modal("message");
modal("task", "task-link");

const teach_inputs = `
<fieldset>
	<div class="row">
		<div class="col-md-4 mt-3">
			<label class="" for="teach_institution_{num}">Учебное заведение</label>
			<input class="form-control" id="teach_institution_{num}" name="teach_institution_{num}" value="" required>
		</div>
		
		<div class="col-md-4 mt-3">
			<label class="" for="teach_specialty_{num}">Специальность</label>
			<input class="form-control" id="teach_specialty_{num}" name="teach_specialty_{num}" value="" required>
		</div>

		<div class="col-md-3 mt-3">
			<label class="" for="teach_end_{num}">Дата окончания</label>
			<input class="form-control" type="date" id="teach_end_{num}" name="teach_end_{num}" placeholder="по настоящее время" value="">
		</div>

		<div class="col-md-1 mt-3">
			<br><button data-delete="fieldset" class="btn btn-danger">-</button>
		</div>
	</div>
</fieldset>`;

const work_inputs = `
<fieldset>
	<div class="row">
		<div class="col-md-4 mt-3">
			<label class="" for="work_company_{num}">Организация</label>
			<input class="form-control" id="work_company_{num}" name="work_company_{num}" value="" required>
		</div>
		
		<div class="col-md-4 mt-3">
			<label class="" for="work_position_{num}">Должность</label>
			<input class="form-control" id="work_position_{num}" name="work_position_{num}" value="" required>
		</div>

		<div class="col-md-2 mt-3">
			<label class="" for="work_from_{num}">Период работы: с</label>
			<input class="form-control" type="date" id="work_from_{num}" name="work_from_{num}" placeholder="с __.____" value="" required>
		</div>
		<div class="col-md-2 mt-3">
			<label class="" for="work_to_{num}">по</label>
			<input class="form-control" type="date" id="work_to_{num}" name="work_to_{num}" placeholder="по настоящее время" value="">
		</div>
	</div>

	<div class="row">
		<div class="col-md-8 mt-3">
			<label class="" for="work_achievement_{num}">Должностные обязанности и достижения</label>
			<textarea class="form-control" id="work_achievement_{num}" name="work_achievement_{num}"></textarea>
		</div>

		<div class="col-md-4 mt-3">
			<br><br><button data-delete="fieldset" class="btn btn-danger">Удалить</button>
		</div>
	</div>
</fieldset>`;

const skill_input = `<div class="col-md-4 mt-3"><input class="form-control" name="skills[]" list="skills_list" value=""></div>`;

addBlock("teach", "add_teach", teach_inputs, true);
addBlock("works", "add_work", work_inputs, true);
addBlock("skills", "add_skill", skill_input);

let toggle = document.querySelectorAll(".toggle");
toggle.forEach((btn) => {
	btn.addEventListener("click", (evt) => {
		evt.preventDefault();
		document
			.querySelectorAll(".about-content__box")
			.forEach((el) => (el.style.display = "none"));
		// .forEach((el) => el.setAttribute("hidden", ""));

		let id = btn.dataset.id;
		console.log("id = ", id);

		fadeIn(id);
	});
});

function fadeIn(el) {
	var opacity = 0.01;
	document.querySelector(el).style.display = "block";
	var timer = setInterval(function () {
		if (opacity >= 1) {
			clearInterval(timer);
		}
		document.querySelector(el).style.opacity = opacity;
		opacity += opacity * 0.1;
	}, 10);
}
