<?php

require_once "system/start_mysql.php";
require_once "system/config.php";
require_once "system/data.php";
require_once "system/functions.php";

if (!$config["enable"]) {
	$error_msg = "Сайт на техническом обслуживании";
	$layout_content = $error_msg;
	print $layout_content;
	exit;
}