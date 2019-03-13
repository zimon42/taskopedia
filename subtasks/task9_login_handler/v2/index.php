<?php

include_once("login_module/LoginRequestHandler.php");

session_start();

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
Top bar
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