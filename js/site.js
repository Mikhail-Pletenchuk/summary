/**
 *
 * @param {*} modal - id секции с модальным окном
 * @param {*} link - id кнопки вызова модального окна
 */
export function modal(modal, link = false, animate = false) {
	//todo - проверка на правильность подстановленных данных
	if (document.getElementById(`${modal}`)) {
		modal = document.getElementById(`${modal}`);
	} else {
		return;
	}

	if (link) {
		if (document.getElementById(`${link}`)) {
			link = document.getElementById(`${link}`);

			link.addEventListener("click", function (evt) {
				evt.preventDefault();
				modal.classList.add("modal-show");
			});
		}
	}

	let close;
	if (!modal.querySelector(".modal-close")) {
		close = `<button class="modal-close" type="button"><span class="sr-only">Закрыть</span></button>`;
		modal.innerHTML += close;
	}
	close = modal.querySelector(".modal-close");

	//modal.classList.add("modal-show"); //временно сразу активна
	close.addEventListener("click", function (evt) {
		evt.preventDefault();
		modal.classList.remove("modal-show");
		modal.classList.remove("modal-error");
	});

	window.addEventListener("keydown", function (evt) {
		if (evt.keyCode === 27) {
			if (modal.classList.contains("modal-show")) {
				evt.preventDefault();
				modal.classList.remove("modal-show");
				modal.classList.remove("modal-error");
			}
		}
	});
}

export function addBlock(block, button, html, number = null) {
	if (document.getElementById(`${block}`)) {
		block = document.getElementById(`${block}`);
	} else {
		return;
	}

	button = document.getElementById(`${button}`);
	button.addEventListener("click", addHtml);

	function addHtml() {
		if (number != null) {
			number = block.children.length;
		}

		let inputs = block.querySelectorAll("input");
		inputs.forEach((input) => input.setAttribute("value", input.value));

		block.innerHTML += html.replace(/{num}/g, `${number}`);
	}
}

export function initButtonsDelete() {
	let body = document.querySelector("body");

	body.addEventListener("click", function (evt) {
		if (evt.target.hasAttribute("data-delete")) {
			evt.preventDefault();
			evt.target.closest(`${evt.target.dataset.delete}`).remove();
		}
	});
}
