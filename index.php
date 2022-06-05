<?php

session_start();
require_once "system/system.php";


// debug($_REQUEST);
// debug($_POST);
// debug(getUsers());
// debug($_SESSION);

$message ="";

include_once("system/check_summary.php");

if (!isset($_SESSION['access'])) {
	include_once("system/check_form.php");
}


$summary_mine = [];
if (isset($_SESSION['email'])) {
	$summary_mine = getSummary($_SESSION['email']);
}

$apply_sample = render("apply_sample.php", ["summary_example" => getSummary(NULL), "summary_mine" => $summary_mine]);
$create_summary = render(
	"create_summary.php",
	[
		"fields_summary" => $fields_summary,
		"citizen" => getNationality(),
		"skills" => getSkills(),
	]
);

$content = render("main_index.php", ["apply_sample" => $apply_sample, "create_summary" => $create_summary]);

$layout_content = render(
	"layout.php", 
	[
		"head" => $head["index"],
		"content" => $content,
		"message" => $message,
	]
);


print $layout_content;
