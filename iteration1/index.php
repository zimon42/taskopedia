<?php

include_once("RequestHandler.php");
include_once("MainPage.php");
include_once("login_module/LoginRequestHandler.php");
include_once("TaskHandler.php");

$pageName = isset($_GET["page"]) ? $_GET["page"] : "main_page";

$page = FALSE;

if ($page === FALSE) {
	$page = RequestHandler::getPage($pageName);
}

if ($page === FALSE) {
	$page = LoginRequestHandler::getPage($pageName);
}

if ($page === FALSE) {
	$page = new MainPage();
}

if ($page !== FALSE) {
	echo $page->getWhole();
}
else {
	echo "Error: page is false in index.php";
}

?>