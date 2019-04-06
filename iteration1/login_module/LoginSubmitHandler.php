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
			LoginHandler::loginUser(self::$userName, self::$password);
			$page = new LoginSuccessPage();
			return $page;
		} 
		else {
			if ($result == "error_username_does_not_exist") {
				$errorMsg = "An error occurred: the user name '".$userName."' does not exist";
			} elseif ($result == "error_wrong_password") {
				$errorMsg = "An error occurred: the password is wrong";
			} else {
				$errorMsg = "An unknown error occurred";
			}			
			$page = new LoginPage();
			$page->errorMsg = $errorMsg;
			return $page;
		}
	}
	
}

?>