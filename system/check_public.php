<?php 

if (!empty($_GET)) {
	// debug("isset(GET)");
	// debug($_GET);

	if (isset($_GET['summary_id'])) {
		$summary = getSummary((int)$_GET['summary_id']);
		// debug($summary);
	}

	if ($summary && $summary[0]['public']) {
		$fields_summary = loadSummary($fields_summary, (int)$_GET['summary_id']);
		$fields_summary = load($fields_summary, $_GET);
		// debug($fields_summary);
	}
	else {
		http_response_code(404);
		exit();
	}
}

if (isset($_POST['public'])) {
	if (isset($_SESSION['summary'])) {
		$_SESSION['summary']['public']['value'] = 1;

		$summary = saveSummary($_SESSION['summary']);
		debug($_SESSION['summary']);

		$fields_summary = $_SESSION['summary'];
		$url = getPublicUrl($summary);


		$message = "Ваше резюме опубликовано! Ссылка для просмотра: <br>";
		$message .= "<textarea style=\"width: 300px; height: 165px;\">" . $url . "</textarea>";

		unset($_SESSION['summary']);
	} else {
		$message = "Во время публикации резюме произошли ошибки!";
	}
}
