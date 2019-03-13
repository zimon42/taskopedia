<?php

include_once("CookieHandler.php");
include_once("UserHandler.php");

class LoginHandler {
	
	public static function checkLogin($userName, $password) {
		if (!UserHandler::existsUserName($userName)) {
			return "error_username_does_not_exist";
		} elseif (UserHandler::getPassword($userName) != $password) {
			return "error_wrong_password";
		}
		return "ok";
	}

}

?>