<?php

include_once("LoginHandler.php");

class LoginSubmitHandler {
	
	public static function handle($userName, $password) {
		$result = LoginHandler::checkLogin($userName, $password);
		if ($result == ok) {
			LoginHandler::loginUser($userName, $password);
			return LoginSuccessPageRenderer::render();
		} else {
			if ($result == "error_username_does_not_exist") {
				$errorMsg = "An error occurred: the user name '".$userName."' does not exist";
			} elseif ($result == "error_wrong_password") {
				$errorMsg = "An error occurred: the password is wrong";
			} else {
				$errorMsg = "An unknown error occurred";
			}
			LoginPageRenderer::$errorMsg = $errorMsg;
			return LoginPageRenderer::render();
		}
	}
	
}

?>