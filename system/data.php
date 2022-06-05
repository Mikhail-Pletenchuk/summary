<?php

$fields_login = [
	'userlogin' => [
		'field_name' => 'Email',
		'required' => true,
		'emailable' => true,
	],
	'userpass' => [
		'field_name' => 'Пароль',
		'required' => true,
		'notrim' => true,
	],
];

$fields_register = [
	'email' => [
		'field_name' => 'Email',
		'required' => true,
		'emailable' => true,
	],
	'password' => [
		'field_name' => 'Пароль',
		'required' => true,
		'notrim' => true,
	],
	'password_again' => [
		'field_name' => 'Повторите пароль',
		'required' => true,
		'notrim' => true,
	],
];

$fields_summary = [
	'lastname' => [
		'field_name' => 'Фамилия',
		'required' => true,
		'table' => 'users',
		'value' => '',
	],
	'firstname' => [
		'field_name' => 'Имя',
		'required' => true,
		'table' => 'users',
		'value' => '',
	],
	'sirname' => [
		'field_name' => 'Отчество',
		'required' => false,
		'table' => 'users',
		'value' => '',
	],
	'birth_date' => [
		'field_name' => 'Дата рождения',
		'required' => false,
		'table' => 'users',
		'value' => '',
	],
	'sex' => [
		'field_name' => 'Пол',
		'required' => false,
		'table' => 'users',
		'value' => '',
	],
	'email' => [
		'field_name' => 'Электронная почта',
		'required' => true,
		'emailable' => true,
		'value' => '',//!
	],
	'phone' => [
		'field_name' => 'Телефон для связи',
		'required' => true,
		'table' => 'users',
		'value' => '',
	],
	'nationality_id' => [
		'field_name' => 'Гражданство',
		'required' => false,
		'table' => 'users',
		'value' => 0,
	],
	'city' => [
		'field_name' => 'Город проживания',
		'required' => false,
		'table' => 'cities',
		'value' => '',
	],

	//!
	'summary_id' => [
		'field_name' => 'ID резюме',
		'required' => false,
		// 'table' => 'summary',
		'value' => '',
	],//!
	'position' => [
		'field_name' => 'Должность',
		'required' => false,
		'table' => 'summary',
		'value' => '',
	],
	'salary' => [
		'field_name' => 'Желаемая зарплата',
		'required' => false,
		'table' => 'summary',
		'value' => '',
	],
	'currency' => [//! Заблокировал это поле. По дефолту в БД записывается 'RUS'
		'field_name' => 'Валюта',
		'required' => false,
		// 'table' => 'summary',
	],
	'employment' => [
		'field_name' => 'Занятость',
		'required' => false,
		'table' => 'summary',
		'value' => 0,
	],
	'schedule' => [
		'field_name' => 'График работы',
		'required' => false,
		'table' => 'summary',
		'value' => 0,
	],
	'trips' => [
		'field_name' => 'Готовность к командировкам',
		'required' => false,
		'check' => true,
		'table' => 'summary',
		'value' => 0,
	],
	'family' => [
		'field_name' => 'Семейное положение',
		'required' => false,
		'table' => 'summary',
		'value' => 0,
	],
	'children' => [
		'field_name' => 'Есть дети',
		'required' => false,
		'check' => true,
		'table' => 'summary',
		'value' => 0,
	],
	'photo' => [
		'field_name' => 'Фото',
		'required' => false,
		'table' => 'summary',
		'value' => '',
	],
	'information' => [
		'field_name' => 'Дополнительная информация',
		'required' => false,
		'table' => 'summary',
		'value' => '',
	],
	'template' => [
		'field_name' => 'Шаблон',
		'required' => false,
		'table' => 'summary',
		'value' => 0,
	],
	'public' => [
		'field_name' => 'Публикация',
		'required' => false,
		'table' => 'summary',
		'value' => 0,
	],

	'education' => [
		'field_name' => 'Образование',
		// 'required' => false,
		'table' => 'education',
		'value' => [],
	],

	'experiences' => [
		'field_name' => 'Опыт работы',
		// 'required' => false,
		'table' => 'experiences',
		'value' => [],
	],

	'skills' => [
		'field_name' => 'Навыки',
		'required' => false,
		'table' => 'skills',
		'value' => [],
	],
];
