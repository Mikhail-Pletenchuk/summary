<?php

session_start();
if (!$_SESSION['access']) {
	http_response_code(404);
	exit;
}
require_once "system/system.php";


// debug($_GET);
$message ="";
$summary_id = $_GET['slug'];

// debug(getUsers(2));

// $summary_id = hash("md5", $summary_id, true);
// debug($summary_id);
// $fields_summary = loadSummary($fields_summary, 39);
$fields_summary = loadSummary($fields_summary, (int)$summary_id);

$template = $fields_summary['template']['value'];

$list = render("list.php", ['fields_summary' => $fields_summary]);

$layout_content = render(
	"public_layout.php", 
	[
		"head" => $head["view"],
		"template" => $template,
		"message" => $message,
		"content" => $list,
	]
);

print $layout_content;
