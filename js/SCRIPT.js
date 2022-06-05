// document
// 	.querySelectorAll("form")
// 	.forEach((form) => form.addEventListener("submit", submitHandler));
/*
let login_form = document.querySelector(".login-form");
console.log("login_form = ", login_form);
login_form.addEventListener("submit", submitHandler);
*/

function submitHandler(e) {
	e.preventDefault();
	// e.stopPropagation();
	console.log("e = ", e);
	console.log("this = ", this);
	let form = this;
	console.log("form = ", form);

	const request = new XMLHttpRequest();
	request.onreadystatechange = function () {
		console.log("readyState=", this.readyState, "statis=", this.status);
		if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
			// success, show this.responseText here
			console.log("SUCCESS", this);
			form = this.response;
			console.log("this.response = ", this.response);
		}
	};

	request.open(this.method, this.action, true);
	console.log("this.action = ", this.action);
	console.log("this.method = ", this.method);
	request.setRequestHeader(
		"Content-Type",
		"application/x-www-form-urlencoded"
	);

	const data = new FormData(this);
	for (var key of data.keys()) console.log(key, data.get(key));
	//(login = "Войти")
	request.send(data);
	console.log("data = ", data);
}

// var forms = document.querySelectorAll("form");

// function submit() {
//   var request = new XMLHttpRequest();
//   request.onload = function () {
//     if (request.status == 200) {
//       alert("Thank you!")
//     }
//   };
//   request.open(this.method, this.action, true);
//   request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//   var name = this.querySelector('[name="name"]');
//   var city = this.querySelector('[name="city"]');
//   request.send('name=' + encodeURIComponent(name.value) + '&city='  + encodeURIComponent(city.value));
//   return false;
// }

// for (var i = 0; i < forms.length; i++) {
//   forms[i].onsubmit = submit;
// }

/* <form action="/mail.php" method="POST">
    <input type="text" name="name">
    <input type="text" name="city">
    <button type="submit">отправить</button>
</form> */

//-------------------------

// window.addEventListener('load', function () {
// 	// Fetch all the forms we want to apply custom Bootstrap validation styles to
// 	// Извлеките все формы, к которым мы хотим применить пользовательские стили проверки начальной загрузки
// 	// var forms = document.getElementsByClassName('needs-validation');
// 	var forms = document.querySelector(`#login-form`);
// 	// Обходит их и предотвращает отправку
// 	var validation = Array.prototype.filter.call(forms, function (form) {
// 		form.addEventListener('submit', function (event) {
// 			if (form.checkValidity() === false) {
// 				event.preventDefault();
// 				event.stopPropagation();
// 			} else {
// 				$.ajax({
// 					url: 'index.php',
// 					type: 'POST',
// 					data: $('#form').serialize(),
// 					beforeSend: function () {
// 						$('.loader').fadeIn();
// 					},
// 					success: function (response) {
// 						$('.loader').fadeOut('slow', function () {
// 								let res = JSON.parse(response);
// 								if(res.answer == 'ok'){
// 									$('#form').removeClass('was-validated').trigger('reset');
// 									// $('#label-captcha').text(res.captcha);
// 									$('#answer').html(`<div class="alert alert-success" role="alert">Спасибо за обращение!</div>`);
// 								}else{
// 									$('#answer').html(`<div class="alert alert-danger" role="alert">${res.errors}</div>`);
// 								}
// 						});
// 					},
// 					error: function () {
// 						alert('Error!');
// 					}
// 				});
// 				event.preventDefault();
// 				event.stopPropagation();
// 			}
// 			form.classList.add('was-validated');
// 		}, false);
// 	});
// }, false);

/*
let link = document.querySelector("#login-link");
let popup = document.querySelector("#login-modal");

let login = popup.querySelector("[name=login]");
let password = popup.querySelector("[name=password]");

let isStorageSupport = true;
let storage = "";

try {
	storage = localStorage.getItem("login");
} catch (err) {
	isStorageSupport = false;
}

link.addEventListener("click", function () {
	if (storage) {
		login.value = storage;
		password.focus();
	} else {
		login.focus();
	}
});

*/
