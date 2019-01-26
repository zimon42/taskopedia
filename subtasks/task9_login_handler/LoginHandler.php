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
	
	public static function loginUser($userName, $password) {
		$_SESSION["user_name"] = $userName;
		$_SESSION["user_logged_in"] = true;
		CookieHandler::setCookie("user_name", $userName);
		CookieHandler::setCookie("password", $password);
	}

	public static function userIsLoggedIn() {
		return isset($_SESSION["user_logged_in"]) && $_SESSION["user_logged_in"] == true;
	}
	
	public static function loggedInUserName() {
		return $_SESSION["user_name"];
	}
	
	// Check if user is logged in via cookie
	public static function checkLoginCookie() {
		if (CookieHandler::isSetCookie("user_name") && CookieHandler::isSetCookie("password")) {
			$cookieUserName = CookieHandler::getCookie("user_name");
			$cookiePassword = CookieHandler::getCookie("password");			
			if (LoginHandler::checkLogin($cookieUserName, $cookiePassword) == "ok") {
				LoginHandler::loginUser($cookieUserName, $cookiePassword);
			}
		}
	}
	
}

?>