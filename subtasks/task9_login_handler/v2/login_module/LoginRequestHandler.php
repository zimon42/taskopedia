<?php

include_once ("LoginPage.php");
include_once ("LoginSubmitHandler.php");

class LoginRequestHandler {
	
	public static function getPage($pageName) {
		
		if ($pageName == "login_form") {
			$page = new LoginPage();
			return $page;
		}
		if ($pageName == "login_submit") {
			LoginSubmitHandler::$userName = $_GET["user_name"];
			LoginSubmitHandler::$password = $_GET["password"];
			$page = LoginSubmitHandler::getPage();
			return $page;
		}
		
		return FALSE;
	}
	
}

?>