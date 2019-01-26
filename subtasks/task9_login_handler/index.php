<?php

// http://localhost/taskopedia/subtasks/task9_login_handler/index.php

session_start();

include_once("SkeletonPageRenderer.php");
include_once("MainPageContentRenderer.php");
include_once("LoginHandler.php");
include_once("LoginPageContentRenderer.php");
include_once("LoginSubmitHandler.php");
include_once("LogoutHandler.php");
include_once("LogoutPageContentRenderer.php");
include_once("YourPageContentRenderer.php");

// Check cookie login
if (!LoginHandler::userIsLoggedIn()) {
	LoginHandler::checkLoginCookie();
}

if (!isset($_GET["page"])) {
	$content = MainPageContentRenderer::render();
	echo SkeletonPageRenderer::render($content);
	die;
}

$page = $_GET["page"];

if ($page == "login") {
	$content = LoginPageContentRenderer::render();
	echo SkeletonPageRenderer::render($content);
} 

elseif ($page == "login_submit") {
	$content = LoginSubmitHandler::handleAndRender(
		$_GET["user_name"], $_GET["password"]
	);
	echo SkeletonPageRenderer::render($content);
} 

elseif ($page == "logout") {
	LogoutHandler::logout();
	$content = LogoutPageContentRenderer::render();
	echo SkeletonPageRenderer::render($content);
} 

elseif ($page == "your_page") {
	if (LoginHandler::userIsLoggedIn()) {
		$content = YourPageContentRenderer::render();
		echo SkeletonPageRenderer::render($content);
	} else {
		$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$_SESSION["navigate_to_url_after_login"] = $actual_link;
		$content = LoginPageContentRenderer::render();
		echo SkeletonPageRenderer::render($content);		
	}
} 

else {
	echo "Unknown page";
}

?>