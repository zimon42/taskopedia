<?php

include_once ("LoginPage.php");
include_once ("LoginSubmitHandler.php");
include_once ("LogoutPage.php");
include_once ("TaskHandler.php");

class LoginRequestHandler {
	
	public static function getPage($pageName) {
		$page = FALSE;
		if ($pageName == "login_form") {
			$page = new LoginPage();
		}
		if ($pageName == "login_submit") {
			LoginSubmitHandler::$userName = $_GET["user_name"];
			LoginSubmitHandler::$password = $_GET["password"];
			$page = LoginSubmitHandler::getPage();
		}
		if ($pageName == "login_logout") {
			$page = new LogoutPage();
		}
		if ($page !== FALSE) {
			TaskHandler::setTaskParams($page);
			return $page;
		}
		return FALSE;
	}
	
}

?>