<?php

include_once("LoginConfig.php");

class LoginSuccessPage {
	
	public function getContent() {
		$html = "You have been logged in! ";
		$url = isset($_SESSION["navigate_to_url_after_login"])
			? $_SESSION["navigate_to_url_after_login"]
			: LoginConfig::$mainPagePath;
		$html .= "<button onclick=\"location='$url'\">Continue</button>";
		return $html;		
	}
	
	public function getAddToHead() {
		
	}
	
}

?>