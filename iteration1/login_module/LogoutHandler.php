<?php

include_once("utils/CookieHandler.php");

class LogoutHandler {
	
	public static function logout() {
		unset($_SESSION["user_logged_in"]);
		CookieHandler::destroyCookie("user_name");
		CookieHandler::destroyCookie("password");
	}
	
}

?>