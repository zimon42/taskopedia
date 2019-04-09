<?php

include_once("LoginConfig.php");
include_once("SkeletonPage.php");

class LoginSuccessPage extends SkeletonPage {
	
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