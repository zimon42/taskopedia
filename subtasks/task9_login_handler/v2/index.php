<?php

include_once("login_module/LoginRequestHandler.php");
include_once("login_module/LoginHandler.php");

session_start();

LoginHandler::checkLoginCookie();

$pageName = $_GET["page"];

$page = FALSE;

if ($page === FALSE) {
	$page = LoginRequestHandler::getPage($pageName);
}

if ($page !== FALSE) {
	$content = $page->getContent();
	$addToHead = $page->getAddToHead();
	echo <<<HTML
<html>
<head>
<script src=jquery.js></script>
$addToHead
</head>
<body>
HTML;
	if (LoginHandler::userIsLoggedIn()) {
		echo "Logged in as " . LoginHandler::loggedInUserName() . ", ";
		echo "<a href=index.php?page=login_logout>Logout</a> ";
	} else {
		echo "Not logged in, ";
		echo "<a href=index.php?page=login_form>Login</a> ";			
	}
	echo <<<HTML
<hr>
$content
<hr>
Bottom bar
</body>
</html>		

HTML;
}

else {
	echo MainPage::render();
}

?>