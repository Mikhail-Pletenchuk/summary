<?php

/**
 * Функция шаблонизации
 * $tmp - файл представления
 * $data - массив с данными для этого представления
 * return - html с подставленными данными
 */
function render($tmp, $data = array())
{
	$path = "view/";

	if (file_exists($path . $tmp)) {
		ob_start();

		extract($data);

		include($path . $tmp);

		$html = ob_get_clean();
		return $html;
	}
	return "";
}

function debug($data)
{
	foreach ($GLOBALS as $name => $value) {
		if ($value === $data) {
			echo "$name : "; 
		}
	}
	echo '<pre>' . print_r($data, 1) . '</pre>';

	// print "<section>";

	// print '<h3>$_COOKIE</h3>';
	// var_dump($_COOKIE);

	// if (headers_sent()) {
	// 	print '<h3>Вывод headers_list</h3>';
	// 	var_dump(headers_list());
	// }

	// print "</section>";
}

/**
 * Загружает в переменную данные из массива POST 
 * или другого массива при условии совпадения ключей.
 * Значения защищает от спецсимволов.
 */
function load($data, $array = []) : array
{
	if (!$array) $array = $_POST;

	foreach ($array as $key => $value) {
		if (array_key_exists($key, $data)) {
			if (isset($data[$key]['notrim']) && $data[$key]['notrim']) {
				$data[$key]['value'] = $value;
				continue;
			} 
			if (isset($data[$key]['check']) && $data[$key]['check']) {
				$data[$key]['value'] = ($value == "on") ? true : false;
				continue;
			} 
			if (is_array($value)) {
				foreach ($value as $k => $v) {
					$data[$key]['value'][$k] = htmlspecialchars(trim($v));
				}
				$data[$key]['value'] = array_diff($data[$key]['value'], array(''));//удалить пустые элементы
				$data[$key]['value'] = array_unique($data[$key]['value']);//убрать повторяющиеся значения из массива
			} else {
				$data[$key]['value'] = htmlspecialchars(trim($value));
			}
		}
	}
	
	if (isset($data['education'])) {
		$place_of_study = [];
		$specialty = [];
		$end_date = [];

		foreach ($array as $key => $value) {
			$keys = explode("_", $key);//0 - teach; 1 - institution/specialty/end; 2 - номер от 0 до n
			if ($keys[0] == 'teach') {
				$value = htmlspecialchars(trim($value));
				if ($keys[1] == 'institution') $place_of_study[$keys[2]] = $value;
				if ($keys[1] == 'specialty') $specialty[$keys[2]] = $value;
				if ($keys[1] == 'end') $end_date[$keys[2]] = $value;
			}
		}

		$teach = [];
		foreach ($place_of_study as $key => $value) {
			$teach[$key]['place_of_study'] = $value;
			// if (!empty($value)) $teach[$key]['place_of_study'] = $value;
		}
		foreach ($specialty as $key => $value) {
			$teach[$key]['specialty'] = $value;
			// if (!empty($value)) $teach[$key]['specialty'] = $value;
		}
		foreach ($end_date as $key => $value) {
			$teach[$key]['end_date'] = $value;
			// if (!empty($value)) $teach[$key]['end_date'] = $value;
		}
		// debug($teach);

		// $teach = array_diff($teach, array(''));

		$data['education']['value'] = $teach;
	}

	if (isset($data['experiences'])) {
		$place_of_work = [];
		$position = [];
		$start_date = [];
		$end_date = [];
		$achievement = [];

		foreach ($array as $key => $value) {
			$keys = explode("_", $key);//0 - work; 1 - company/position/from/to/achievement; 2 - номер от 0 до n
			if ($keys[0] == 'work') {
				$value = htmlspecialchars(trim($value));
				if ($keys[1] == 'company') $place_of_work[$keys[2]] = $value;
				if ($keys[1] == 'position') $position[$keys[2]] = $value;
				if ($keys[1] == 'from') $start_date[$keys[2]] = $value;
				if ($keys[1] == 'to') $end_date[$keys[2]] = $value;
				if ($keys[1] == 'achievement') $achievement[$keys[2]] = $value;
			}
		}

		$work = [];
		foreach ($place_of_work as $key => $value) {
			$work[$key]['place_of_work'] = $value;
			// if (!empty($value)) $work[$key]['place_of_work'] = $value;
		}
		foreach ($position as $key => $value) {
			$work[$key]['position'] = $value;
			// if (!empty($value)) $work[$key]['position'] = $value;
		}
		foreach ($start_date as $key => $value) {
			$work[$key]['start_date'] = $value;
			// if (!empty($value)) $work[$key]['start_date'] = $value;
		}
		foreach ($end_date as $key => $value) {
			$work[$key]['end_date'] = $value;
			// if (!empty($value)) $work[$key]['end_date'] = $value;
		}
		foreach ($achievement as $key => $value) {
			$work[$key]['achievement'] = $value;
			// if (!empty($value)) $work[$key]['achievement'] = $value;
		}
		// debug($work);

		// $work = array_diff($work, array(''));

		$data['experiences']['value'] = $work;
	}

	return $data;
}

function validate($data) : string
{
	$errors = '';
	foreach ($data as $key => $value) {
		if ((isset($data[$key]['required']) && $data[$key]['required']) && empty($data[$key]['value'])){
			$errors .= "<br>Поле \"{$data[$key]['field_name']}\" не заполнено.";
			continue;
		}
		if (isset($data[$key]['emailable']) && $data[$key]['emailable']) {
			if (!filter_var($data[$key]['value'], FILTER_VALIDATE_EMAIL)) {
				$errors .= "<br>Email должен быть корректным.";
			}
		}
	}

	return $errors;
}

function setIntoDB($sql)
{
	global $db;
	StartDB();

	if (mysqli_query($db, $sql) === FALSE) {
	 	printf("Ошибка: %s\n", mysqli_error($db));
	}
	
	$id = mysqli_insert_id($db);
	EndDB();

	return $id;
}

function setIntoDB2($sql)
{
	global $db;
	StartDB();

	if (mysqli_query($db, $sql) === FALSE) {
	 	printf("Ошибка: %s\n", mysqli_error($db));
	}
	
	EndDB();

	return true;
}

function getFromDB($sql)
{
	global $db;
	StartDB();
	$result = mysqli_query($db, $sql);
	EndDB();

	if (!$result) {
		printf("Ошибка: %s\n", mysqli_error($db));
		// exit(mysqli_error($db));
	}
	if (mysqli_num_rows($result) == 0) {
		return false;
	}

 	$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);//очищаем память

	return $row;
}


/*** Пользователь */
function setUser($email, $hash_pass, $access)
{
	// $sql = "INSERT INTO `Клиенты` (`Логин`,		`Пароль`,			`Доступ`) 
	// 							 VALUES	 ('".$email."','".$hash_pass."', '".$access."')";

	$sql = "INSERT INTO `tUsers` (`email`, `password`, `access`) VALUES (?, ?, ?)";

	global $db;
	StartDB();
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_bind_param($stmt, 'ssi', $email, $hash_pass, $access);

	if (mysqli_stmt_execute($stmt) === false) {/* выполнение подготовленного запроса */

	// }
	// else {
		$_SESSION['errRegister'] = "<br>Ошибка: ".mysqli_error($db);
	}

	mysqli_stmt_close($stmt);//закрываем запрос
	
	EndDB();
}

function getUsers($data = false)
{
	// $sql = "SELECT * FROM tUsers";
	$sql = "SELECT u.ID, lastname, firstname, sirname, birth_date, sex, email, phone, nationality_id, city, register_date, refrech_date, access 
					FROM tUsers u LEFT JOIN tCities c ON u.cities_id = c.ID WHERE u.isactual = 1";
	if (is_string($data)) {
		$sql = "SELECT u.ID, lastname, firstname, sirname, birth_date, sex, email, password, phone, nationality_id, city, register_date, refrech_date, access 
					FROM tUsers u LEFT JOIN tCities c ON u.cities_id = c.ID WHERE u.isactual = 1 AND u.email = '$data' LIMIT 1";
		// $sql .= " WHERE email = '$email' LIMIT 1";
	}
	if (is_int($data)) {
		$sql = "SELECT u.ID, lastname, firstname, sirname, birth_date, sex, email, password, phone, nationality_id, city, register_date, refrech_date, access 
					FROM tUsers u LEFT JOIN tCities c ON u.cities_id = c.ID WHERE u.isactual = 1 AND u.ID = $data";
	}
	return getFromDB($sql);
}

function updateUser($user_value, $user_id)
{
	$update = [];
	foreach ($user_value as $key => $value) {
		$update[] = $key . " = '" . $value . "'";
	}

	$update = implode(", ", $update);
	$sql = "UPDATE tUsers SET ";
	$sql .= $update;
	$sql .= " WHERE ID = " . $user_id;
	
	return setIntoDB($sql);
}

function deleteUser($user_id)
{
	// echo "<br>Вы меня удалили! id=".$user_id;
	$user_value['isactual'] = 0;
	updateUser($user_value, $user_id);
	
	// StartDB();
	
	// $id = $_GET['id'];
	// $SQL = "DELETE FROM `Клиенты` WHERE `Код клиента`='$id'";
	// print $SQL;
	// if (!$result = mysqli_query($db, $SQL)) {
	// 	printf("Ошибка в запросе: %s\n", mysqli_error($db));
	// }
	
	// EndDB();
	
	// header("Location: ".$_SERVER['HTTP_REFERER']);
}
/*** End - Пользователь */


function getNationality($id = false)
{
	$sql = "SELECT * FROM `tNationality`";
	if ($id) {
		$sql .= " WHERE ID = '$id' LIMIT 1";
	}
	return getFromDB($sql);
}

function setCity($city)
{
	$sql = "INSERT INTO tCities SET ";
	$sql .=  "city = '$city'";

	return setIntoDB($sql);
}

function getCity($data = false)
{
	$sql = "SELECT * FROM tCities";
	if (is_string($data)) {
		$sql .= " WHERE city = '$data' LIMIT 1";
	}
	if (is_int($data)) {
		$sql .= " WHERE ID = '$data'";
	}
	return getFromDB($sql);
}


/*** Навыки */
function setSkill($name, $users_id = false)
{
	$sql = "INSERT INTO tSkills SET ";
	if ($users_id) {
		$sql .=  "users_id = $users_id, ";
	}
	$sql .=  "name = '$name'";

	// debug($sql);

	return setIntoDB($sql);
}

function getSkills($field = false, $data = false)
{
	$sql = "SELECT * FROM tSkills";
	if (is_string($field) && $data) {
		$sql .= " WHERE $field = '$data' LIMIT 1";
	}
	// if (is_int($data)) {
	// 	$sql .= " WHERE ID = '$data'";
	// }
	// print "getSkills: $sql <br>";
	return getFromDB($sql);
}

function setSummarySkills($summary_id, $skills_name, $users_id = false)
{
	$summary_skills = [];
	foreach ($skills_name as $name) {
		$skill = getSkills('name', $name);
		// debug($skill);
		if ($skill) {
			$summary_skills[] = "($summary_id, " . $skill[0]['ID'] . ")";
		} else {
			$summary_skills[] = "($summary_id, " . setSkill($name, $users_id) . ")";
		}
	}
	// debug($summary_skills);
	$summary_skills = implode(", ", $summary_skills);
	// debug($summary_skills);

	$sql = "INSERT INTO tSummarySkills (summary_id, skills_id) VALUES ";
	$sql .=  $summary_skills;

	// debug($sql);

	setIntoDB2($sql);

	return true;
}

function getSummarySkills($summary_id)
{
	$sql = "SELECT s.name FROM tSummarySkills ss JOIN tSkills s
	ON ss.skills_id = s.ID WHERE ss.summary_id = $summary_id";
	// $sql = "SELECT s.name FROM tSummarySkills ss JOIN tSkills s
	// WHERE ss.skills_id = s.ID AND ss.summary_id = $summary_id";
	// debug($sql);

	$summary_skills = [];
	$summary_skills = getFromDB($sql);
	// debug($summary_skills);

	$skills = [];
	if ($summary_skills) {
		foreach ($summary_skills as $skill) {
			$skills['skills'][] = $skill['name'];
		}
		
		return $skills;
	}
	return $skills['skills'][0] = "";
}
/*** End - Навыки */


/*** Образование */
function setEducation($education_value, $users_id = false)
{
	$education = [];
	if ($users_id) {
		$education[] = "users_id = " . $users_id;
	}

	foreach ($education_value as $key => $value) {
		$education[] = $key . " = '" . $value . "'";
	}

	$education = implode(", ", $education);
	// debug($education);

	$sql = "INSERT INTO tEducation SET ";
	$sql .= $education;
	// debug($sql);

	return setIntoDB($sql);
}

function getEducation($field = false, $data = false, $users_id = false)
{
	//! не откорректировано
	$sql = "SELECT * FROM tEducation";
	if (is_string($field) && $data) {
		$sql .= " WHERE $field = '$data'";
	}
	//! получить все образование для конкретного пользователя
	// if (is_int($data)) {
	// 	$sql .= " WHERE ID = '$data'";
	// }
	// print "getSkills: $sql <br>";
	return getFromDB($sql);
}

function setSummaryEducation($summary_id, $education_value, $users_id = false)
{
	$summary_education = [];
	foreach ($education_value as $value) {
		// debug($value);

		if (!$users_id) {
			$summary_education[] = "($summary_id, " . setEducation($value) . ")";
		} else {
			//! 
			// $education = getEducation('place_of_study', $value['place_of_study'], $users_id = false);
			// // debug($education);

			// /* пример как сделано для user
			// $user_value = array_diff_assoc($user_value, $user);

			// if ($user_value) {
			// 	updateUser($user_value, $user['ID']);
			// }
			// */

			// if ($education) {
			// 	$summary_education[] = "($summary_id, " . $education[0]['ID'] . ")";
			// } else {
			// 	$summary_education[] = "($summary_id, " . setEducation($value, $users_id) . ")";
			// }
		}
	}
	// debug($summary_education);
	$summary_education = implode(", ", $summary_education);
	// debug($summary_education);

	$sql = "INSERT INTO tSummaryEducation (summary_id, education_id) VALUES ";
	$sql .=  $summary_education;//

	// debug($sql);

	setIntoDB2($sql);

	return true;
}

function getSummaryEducation($summary_id)
{
	$sql = "SELECT e.place_of_study, e.specialty, e.start_date , e.end_date 
				FROM tSummaryEducation se JOIN tEducation e ON se.education_id = e.ID
				WHERE se.summary_id = $summary_id";

	return getFromDB($sql);
}
/*** End - Образование */


/*** Опыт работы */
function setExperiences($experiences_value, $users_id = false)
{
	$experiences = [];
	if ($users_id) {
		$experiences[] = "users_id = " . $users_id;
	}

	foreach ($experiences_value as $key => $value) {
		$experiences[] = $key . " = '" . $value . "'";
	}

	$experiences = implode(", ", $experiences);
	// debug($experiences);

	$sql = "INSERT INTO tExperiences SET ";
	$sql .= $experiences;
	// debug($sql);

	return setIntoDB($sql);
}

function getExperiences($field = false, $data = false)
{
	$sql = "SELECT * FROM tSkills";
	if (is_string($field) && $data) {
		$sql .= " WHERE $field = '$data' LIMIT 1";
	}
	// if (is_int($data)) {
	// 	$sql .= " WHERE ID = '$data'";
	// }
	// print "getSkills: $sql <br>";
	return getFromDB($sql);
}

function setSummaryExperiences($summary_id, $experiences_value, $users_id = false)
{
	$summary_experiences = [];

	foreach ($experiences_value as $value) {
		// debug($value);

		if (!$users_id) {
			$summary_experiences[] = "($summary_id, " . setExperiences($value) . ")";
		} else {
			//! 
			// $education = getEducation('place_of_study', $value['place_of_study'], $users_id = false);
			// // debug($education);

			// /* пример как сделано для user
			// $user_value = array_diff_assoc($user_value, $user);

			// if ($user_value) {
			// 	updateUser($user_value, $user['ID']);
			// }
			// */

			// if ($skill) {
			// 	$summary_experiences[] = "($summary_id, " . $skill[0]['ID'] . ")";
			// } else {
			// 	$summary_experiences[] = "($summary_id, " . setSkill($name, $users_id) . ")";
			// }
		}
	}

	// debug($summary_experiences);
	$summary_experiences = implode(", ", $summary_experiences);
	// debug($summary_experiences);

	$sql = "INSERT INTO tSummaryExperiences (summary_id, experiences_id) VALUES ";
	$sql .=  $summary_experiences;

	// debug($sql);

	setIntoDB2($sql);

	return true;
}

function getSummaryExperiences($summary_id)
{
	$sql = "SELECT e.place_of_work, e.position, e.start_date , e.end_date, e.achievement
				FROM tSummaryExperiences se JOIN tExperiences e ON se.experiences_id = e.ID
				WHERE se.summary_id = $summary_id";

	return getFromDB($sql);
}
/*** End - Опыт работы */


/*** Резюме */
function setSummary($summary_value, $users_id = false)
{
	if ($users_id) $summary = ["users_id = " . $users_id];

	foreach ($summary_value as $key => $value) {
		$summary[] = $key . " = '" . $value . "'";
	}
	$summary = implode(", ", $summary);
	$sql = "INSERT INTO tSummary SET ";
	$sql .= $summary;

	return setIntoDB($sql);
}

function getSummary($data = FALSE)
{
	$sql = "SELECT * FROM `tSummary`";

	if (is_string($data)) {
		$user = getUsers($data);
		// debug($user);
		$users_id = $user[0]['ID'];
		$sql .= " WHERE users_id = '$users_id'";
	}
	if (is_int($data)) {
		$sql .= " WHERE ID = '$data'";
	}
	if (is_null($data)) {
		$sql .= " WHERE users_id IS NULL AND public = 0";
	}
	return getFromDB($sql);
}

function updateSummary($summary_value, $summary_id)
{
	$update = [];
	foreach ($summary_value as $key => $value) {
		$update[] = $key . " = '" . $value . "'";
	}

	$update = implode(", ", $update);
	$sql = "UPDATE tSummary SET ";
	$sql .= $update;
	$sql .= " WHERE ID = " . $summary_id;
	
	return setIntoDB($sql);
}


function saveSummary($data, $summary_id = false)
{
	//! подготовка данных для сохранения в БД
	$user_value = [];
	$summary_value = [];
	$skills_value = [];
	$education_value = [];
	$experiences_value = [];

	foreach ($data as $key => $value) {
		if (isset($value['value'])) {
			if (isset($value['table']) && $value['table'] == 'users') {
				$user_value[$key] = $value['value'];
				continue;
			}
			if (isset($value['table']) && $value['table'] == 'summary') {
				$summary_value[$key] = $value['value'];
				continue;
			}
			if (isset($value['table']) && $value['table'] == 'skills') {
				foreach ($value['value'] as $skill) {
					$skills_value[] = $skill;
				}
				continue;
			}
		}
	}
	if (isset($data['education'])) {
		$education_value = $data['education']['value'];
	}
	if (isset($data['experiences'])) {
		$experiences_value = $data['experiences']['value'];
	}


	$users_id = false;
	$user_update = [];

	if (isset($_SESSION['email']) && $_SESSION['email']) {
		$user = getUsers($_SESSION['email']);
		$user = $user[0];
		$users_id = $user['ID'];
		// debug($user);
		
		$user_update = array_diff_assoc($user_value, $user);
		
		// foreach ($user_value as $key => $value) {
		// 	if ($user_value[$key] == $user[$key]) {
		// 		unset($user_value[$key]);
		// 	}
		// }
		// debug($user_value);
		
		if ($user['city'] != $data['city']['value']) {
			$city = getCity($data['city']['value']);
			$cities_id = $city ? $city[0]['ID'] : setCity($data['city']['value']);
			$user_update['cities_id'] = $cities_id;
		}
	
		// debug($user_value);
		if ($user_update) {
			updateUser($user_update, $users_id);
		}
	}

	// debug($summary_value);
	if (!$summary_id) {
		$summary_id = setSummary($summary_value, $users_id);
			//! вставка фото
	}
	else {
		//обновить резюме по указанному summary_id
		// debug($summary_id);
	}


	// debug($education_value);
	if ($education_value) {
		// setSummaryEducation($summary_id, $education_value, $users_id);
		setSummaryEducation($summary_id, $education_value);
	}

	// debug($experiences_value);
	if ($experiences_value) {
		// setSummaryEducation($summary_id, $experiences_value, $users_id);
		setSummaryExperiences($summary_id, $experiences_value);
	}

	// debug($skills_value);
	if ($skills_value) {
		setSummarySkills($summary_id, $skills_value, $users_id);
	}

	return [
		'summary_id' => $summary_id,
		'user_value' => $user_value,
		'city' => $data['city']['value'],
		'user_update' => $user_update,
		'summary_value' => $summary_value,
		'skills_value' => $skills_value,
		'education_value' => $education_value,
		'experiences_value' => $experiences_value,
	];
}



function loadSummary($data_summary, $summary_id)
{
	$user = false;
	$summary = getSummary($summary_id);
	// debug($summary);

	if ($summary) {
		$summary = $summary[0];
		// загружаем данные из таблицы Резюме
		$data_summary = load($data_summary, $summary);

		if (isset($_SESSION['email'])) {
			$user = getUsers($_SESSION['email']);
		} else {
			if ($summary['users_id']) {
				$user = getUsers((int)$summary['users_id']);//подставляем данные fake_user
			}
		}

		// debug($user);
		if ($user) {
			$user = $user[0];
			//! загружаем данные из таблицы users
			$data_summary = load($data_summary, $user);
		}

		// debug($summary_id);
		// загружаем данные из таблицы Навыки и Навыки-Резюме
		$skills = getSummarySkills($summary_id);
		// debug($skills);
		$data_summary = load($data_summary, $skills);

		// загружаем данные из таблицы Опыт работы и Опыт работы-Резюме
		$experiences = getSummaryExperiences($summary_id);
		// debug($experiences);
		if ($experiences) {
			$data_summary['experiences']['value'] = $experiences;
		}

		// загружаем данные из таблицы Образование и Образование-Резюме
		$education = getSummaryEducation($summary_id);
		if ($education) {
			$data_summary['education']['value'] = $education;
		}

		// debug($data_summary);
	}

	return $data_summary;
}

function getPublicUrl($summary) : string
{
	// debug($summary);
	$str_get = [];
	if (!isset($_SESSION['email'])) {
		$_GET = $summary['user_value'];
		$_GET['city'] = $summary['city'];
		$_GET['email'] = $_SESSION['summary']['email']['value'];
		$_GET['summary_id'] = $summary['summary_id'];

		foreach ($_GET as $key => $value) {
			$str_get[] = $key . "=" . $value;
		}
	} else {
		$str_get[] = "summary_id=" . $summary['ID'];
	}
	
	$str = implode("&", $str_get);
	
	// debug($_SERVER);
	//[HTTP_ORIGIN] => http://localhost
	//[REQUEST_URI] => /summary/public_summary.php
	$url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "?";
	// $url = $_SERVER['HTTP_ORIGIN'] . $_SERVER['REQUEST_URI'] . "?";

	$url = $url . $str;
	// debug($str);
	return $url;
}