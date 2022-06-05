
DROP DATABASE IF EXISTS DesignerSummary;

CREATE DATABASE DesignerSummary
DEFAULT CHARSET=utf8
COLLATE=utf8_general_ci;

USE DesignerSummary;

-- Пользователи
CREATE TABLE `tUsers` 
(
	`ID`						INT(11)			NOT NULL AUTO_INCREMENT,
	`lastname`				VARCHAR(35)		NOT NULL COMMENT 'Фамилия',
	`firstname`				VARCHAR(35)		NOT NULL COMMENT 'Имя',
	`sirname`				VARCHAR(20)					COMMENT 'Отчество',
	`birth_date`			DATETIME						COMMENT 'Дата рождения',
	`sex`						BOOLEAN						COMMENT 'Пол',
	`email`					VARCHAR(255)	NOT NULL COMMENT 'Эл. почта',
	-- `login`					CHAR(52)			NOT NULL COMMENT 'Логин',
	-- `photo`					DATALINK						COMMENT 'Ссылка на фото',
	`password`				CHAR(64)			NOT NULL COMMENT 'Пароль',
	`phone`					INT(16)			NOT NULL COMMENT 'Телефон',
	`nationality_id`		INT(8)			NOT NULL COMMENT 'Код гражданства',
	`cities_id`				INT(8)			NOT NULL COMMENT 'Код города',
	`register_date`		TIMESTAMP		NOT NULL COMMENT 'Дата регистрации',
	`refrech_date`			TIMESTAMP		NOT NULL COMMENT 'Дата обновления данных',
	`access`					INT(2)			NOT NULL COMMENT 'Доступ' DEFAULT '1',
	-- `isactual`				BOOLEAN			NOT NULL COMMENT 'Актуальность записи' DEFAULT '1',
	PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Резюме
CREATE TABLE `tSummary` 
(
	`ID`						INT(11)			NOT NULL AUTO_INCREMENT,
	`users_id`				INT(11)			NOT NULL COMMENT 'ID пользователя',
	-- `name`					CHAR(52)			NOT NULL COMMENT 'Наименование',
	`position`				CHAR(52)			NOT NULL COMMENT 'Должность',
	`salary`					INT(11)						COMMENT 'Желаемая зарплата',
	`currency`				CHAR(3)			NOT NULL COMMENT 'Валюта' DEFAULT 'RUS',
	`employment`			INT(2)			NOT NULL COMMENT 'Занятость',
	`trips`					BOOLEAN						COMMENT 'Командировки',
	`married`				BOOLEAN						COMMENT 'Семейное положение',
	`children`				BOOLEAN						COMMENT 'Дети',
	-- `график работы`		CHAR(52)			NOT NULL COMMENT 'Код графика работы',
	`information`			CHAR(255)		NOT NULL COMMENT 'Доп. информ.',
	`template`				INT(2)			NOT NULL COMMENT 'Шаблон страницы' DEFAULT '0',
	`create_date`			TIMESTAMP		NOT NULL COMMENT 'Дата создания',
	`refrech_date`			TIMESTAMP		NOT NULL COMMENT 'Дата обновления данных',
	PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Резюме - работа
CREATE TABLE `tSummaryExperiences` 
(
	`ID`						INT(11)			NOT NULL AUTO_INCREMENT,
	`summary_id`			INT(11)			NOT NULL COMMENT 'ID резюме',
	`id_exp`					INT(11)			NOT NULL COMMENT 'ID работы',
	PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Резюме - образование
CREATE TABLE `tSummaryEducation` 
(
	`ID`						INT(11)			NOT NULL AUTO_INCREMENT,
	`summary_id`			INT(11)			NOT NULL COMMENT 'ID резюме',
	`id_study`				INT(11)			NOT NULL COMMENT 'ID образования',
	PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Работа
CREATE TABLE `tExperiences` 
(
	`ID`						INT(11)			NOT NULL AUTO_INCREMENT,
	`users_id`				INT(11)			NOT NULL COMMENT 'ID пользователя',
	`place_of_work`		CHAR(52)			NOT NULL COMMENT 'Место работы',
	`position`				CHAR(52)						COMMENT 'Должность',
	`start_date`			DATETIME			NOT NULL COMMENT 'Начало',
	`end_date`				DATETIME						COMMENT 'Конец',
	`duty&achievement`	CHAR(11)			NOT NULL COMMENT 'Должн. обяз-ти и достижения',
	PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Образование
CREATE TABLE `tEducation` 
(
	`ID`						INT(11)			NOT NULL AUTO_INCREMENT,
	`users_id`				INT(11)			NOT NULL COMMENT 'ID пользователя',
	`place_of_study`		VARCHAR(52)		NOT NULL COMMENT 'Место учебы',
	`specialty`				VARCHAR(52)		NOT NULL	COMMENT 'Специальность',
	`number_doc`			VARCHAR(52)		NOT NULL COMMENT 'Номер диплома',
	`start_date`			DATETIME			NOT NULL COMMENT 'Начало',
	`end_date`				DATETIME						COMMENT 'Конец',
	PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Города
CREATE TABLE `tCities` (
	`ID`						INT(8)			NOT NULL AUTO_INCREMENT,
	`city`					VARCHAR(45)		NOT NULL COMMENT 'Название города',
	-- `population`		INT(11)	NOT NULL DEFAULT '0',
	PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Гражданство (Страна)
CREATE TABLE `tNationality` (
	`ID`						INT(8)			NOT NULL AUTO_INCREMENT,
	`citizen`				VARCHAR(32)		NOT NULL COMMENT 'Гражданство',
	PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO tCities	(ID, city) 
VALUES					(1,'Миасс'),
							(2,'Москва'),
							(3,'Париж');

INSERT INTO tNationality (ID, citizen) 
VALUES						(1,'Россия'),
								(2,'Азербайджан'),
								(3,'Армения'),
								(4,'Беларусь'),
								(5,'Грузия'),
								(6,'Казахстан'),
								(7,'Камерун'),
								(8,'Киргизия'),
								(9,'Латвия'),
								(10,'Литва'),
								(11,'Молдавия'),
								(12,'Таджикистан'),
								(13,'Узбекистан'),
								(14,'Украина'),
								(15,'Эстония');