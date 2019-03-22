<?php

include_once("RequestHandler.php");

$pageName = $_GET["page"];

$page = FALSE;

if ($page === FALSE) {
	$page = RequestHandler::getPage($pageName);
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