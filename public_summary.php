<?php

session_start();//!
require_once "system/system.php";


$message ="";

// debug($_SESSION);


include_once("system/check_public.php");

// debug($_GET);
// debug($_SESSION);

// $summary_id = $_GET['slug'];

// $summary = getSummary($summary_id);
//!
// debug(getUsers(2));

// $summary_id = hash("md5", $summary_id, true);
// debug($summary_id);
// $fields_summary = loadSummary($fields_summary, 39);
// $fields_summary = loadSummary($fields_summary, (int)$summary_id);
// $fields_summary = [];


$template = $fields_summary['template']['value'];

$list = render("list.php", ['fields_summary' => $fields_summary]);

$layout_content = render(
	"public_layout.php", 
	[
		"head" => $head["view"],
		"template" => $template,
		"content" => $list,
		"message" => $message,
	]
);

print $layout_content;