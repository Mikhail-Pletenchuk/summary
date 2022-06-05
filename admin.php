<?php

session_start();
if ($_SESSION['access'] < 2) {
	http_response_code(404);
	exit;
}
require_once "system/system.php";


include_once("system/delete.php");

$table_users = render("table_users.php", ["users" => getUsers()]);
$table_summary = render("table_summary.php", ["summary" => getSummary()]);

$content = render("main_admin.php", ["table_users" => $table_users, "table_summary" => $table_summary]);

$layout_content = render("layout.php", [
	"head" => $head["admin"],
	"content" => $content,
	"message" => "",
	]);

print $layout_content;
