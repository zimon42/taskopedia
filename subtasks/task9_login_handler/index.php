<?php

session_start();

include_once("SkeletonPageRenderor.php");

if (!isset($_GET["page"])) {
	echo MainPageRenderer::render();
	die;
}

$page = $_GET["page"];

if ($page == "login") {
	$content = LoginPageContentRenderer::render();
	echo SkeletonPageRenderor::render($content);
} elseif ($page == "logout") {
	LogoutHandler::logout();
	$content = LogoutPageContentRenderer::render();
	echo SkeletonPageRenderor::render($content);
}

?>