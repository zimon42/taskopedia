<?php

include_once("LoginHandler.php");
include_once("LoginPage.php");
include_once("LoginSuccessPage.php");

class LoginSubmitHandler {
	
	public static $userName;
	public static $password;
	
	public static function getPage() {
		$result = LoginHandler::checkLogin(self::$userName, self::$password);
		if ($result == "ok") {
			$page = new LoginSuccessPage();
			return $page;
		} 
		else {
			$page = new LoginPage();
			return $page;
		}
	}
	
}

?>