<?php 
if (isset($_POST['summary'])) {
	$fields_summary = load($fields_summary);
	$errors = validate($fields_summary);

	if (!empty($_FILES['photo']['error'])) {
		// $errors .= "<br>Произошла ошибка загрузки файла.";
	} else {
		// $file_name = $_FILES['photo']['name'];
		$file_name = hash("md5", time()).$_FILES['photo']['name'];
		$file_path = "img/users/";
		$file_url = $file_path . $file_name;
		$file_tmp = $_FILES['photo']['tmp_name'];
		// debug($file_tmp);
	
		move_uploaded_file($file_tmp, $file_url);
		// move_uploaded_file($file_tmp, "img/temp/".$file_name);
		// $fields_summary['photo']['tmp'] = $file_tmp;
		$fields_summary['photo']['value'] = $file_name;
		// $fields_summary['photo']['value'] = "img/temp/".$file_name;
		// setPhoto($file_name);
	}
	
	if ($errors) {
		$_SESSION['errSummary'] = $message = $errors;
	} else {
		$_SESSION['summary'] = $fields_summary;
		// $_SESSION['photo_tmp'] = $file_tmp;
		// $_SESSION['photo_url'] = $file_url;
		//$_SESSION['summary_id'] = 
	}
}


//! Для update надо все-таки отдельную ветку обработки делать, т.к. данные могут прийти как с index так и с view
// isset($_POST['update'])
if (isset($_POST['save']) || isset($_POST['update'])) {
	if (!isset($_SESSION['access'])) {
		$message = "Для сохранения резюме вы должны быть зарегистрированы.";
	} else {
		if (isset($_SESSION['summary'])) {
			if (isset($_POST['update'])) {
				saveSummary($_SESSION['summary'], $_SESSION['summary_id']);
				unset($_SESSION['summary_id']);
			} else {
				$summary = saveSummary($_SESSION['summary']);//!
				// debug($summary);
				// move_uploaded_file($_SESSION['photo_tmp'], $_SESSION['photo_url']);
			}

			$message = "Ваше резюме сохранено! Просмотреть все резюме вы можете в вашем личном кабинете.";
			unset($_SESSION['summary']);
			// unset($_SESSION['photo_tmp']);
			// unset($_SESSION['photo_url']);
		} else {
			$message = "Во время сохранения произошли ошибки!";
		}
	}
}

if (isset($_POST['sample'])) {
	$summary = false;
	$summary_id = false;

	if (isset($_POST['summary_mine']) && $_POST['summary_mine']) {
		$summary_id = (int)$_POST['summary_mine'];
		// $summary = getSummary($summary_id);
		// $_SESSION['summary_id'] = $summary_id;//для $_POST['update']
	} elseif (isset($_POST['summary_example']) && $_POST['summary_example']) {
		$summary_id = (int)$_POST['summary_example'];
	}

	if ($summary_id) {
		$fields_summary = loadSummary($fields_summary, $summary_id);
		$_SESSION['summary'] = $fields_summary;
	}
}
