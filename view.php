<?php

session_start();
require_once "system/system.php";


// require('fpdf.php');
// $pdf= new FPDF();
// debug($_REQUEST);
// debug($_FILES);


$message ="";

include_once("system/check_summary.php");

if (!isset($_SESSION['access'])) {
	include_once("system/check_form.php");
}

$list = render("list.php", ['fields_summary' => $fields_summary]);
$list_buttons = render("list_buttons.php");

$content = render("main_view.php", ["list" => $list, "list_buttons" => $list_buttons]);

$layout_content = render("layout.php", [
	"head" => $head["view"],
	"content" => $content,
	"message" => $message,
	]);

print $layout_content;
