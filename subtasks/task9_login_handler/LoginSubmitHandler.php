<?php

include_once("LoginHandler.php");
include_once("LoginSuccessPageContentRenderer.php");
include_once("LoginPageContentRenderer.php");

class LoginSubmitHandler {
	
	public static function handleAndRender($userName, $password) {
		$result = LoginHandler::checkLogin($userName, $password);
		if ($result == "ok") {
			LoginHandler::loginUser($userName, $password);
			return LoginSuccessPageContentRenderer::render();
		} else {
			if ($result == "error_username_does_not_exist") {
				$errorMsg = "An error occurred: the user name '".$userName."' does not exist";
			} elseif ($result == "error_wrong_password") {
				$errorMsg = "An error occurred: the password is wrong";
			} else {
				$errorMsg = "An unknown error occurred";
			}
			LoginPageContentRenderer::$errorMsg = $errorMsg;
			return LoginPageContentRenderer::render();
		}
	}
	
}

?>