<?php

include_once("RequestHandler.php");
include_once("MainPage.php");
include_once("login_module/LoginRequestHandler.php");
include_once("login_module/LoginHandler.php");
include_once("TaskHandler.php");
include_once("forum_module/ForumRequestHandler.php");
include_once("mysql_lock_module/LockHandler.php");

session_start();

LockHandler::lock();

LoginHandler::checkLoginCookie();

$pageName = isset($_GET["page"]) ? $_GET["page"] : "main_page";

$page = FALSE;

if ($page === FALSE) {
	$page = RequestHandler::getPage($pageName);
}

if ($page === FALSE) {
	$page = LoginRequestHandler::getPage($pageName);
}

if ($page === FALSE) {
	$page = ForumRequestHandler::getPage($pageName);
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

LockHandler::unlock();

?>