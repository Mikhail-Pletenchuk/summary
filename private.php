<?php

session_start();
if (!$_SESSION['access']) {
	http_response_code(404);
	exit;
}
require_once "system/system.php";


include_once("system/change_public_summary.php");

$message ="";

$link_summary = render("link_summary.php", ["summary" => getSummary($_SESSION['email'])]);
// $content = render("main_private.php", ["link_summary" => $link_summary]);

$layout_content = render("layout.php", [
	"head" => $head['privat'],
	"content" => $link_summary,
	"message" => $message,
	]);


print $layout_content;

