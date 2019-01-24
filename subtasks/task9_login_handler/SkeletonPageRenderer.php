<?php

include_once("LoginHandler.php");

class SkeletonPageRenderer {
	
	public static function render($content) {
		
		$html = "";
		
		if (LoginHandler::userIsLoggedIn()) {
			$html .= "Logged in as " . LoginHandler::loggedInUserName() . ", ";
			$html .= "<a href=index.php?page=logout>Logout</a><br>";
		} else {
			$html .= "Not logged in, ";
			$html .= "<a href=index.php?page=login>Login</a><br>";			
		}
		
		$html .= $content;
		
		return $html;
		
	}
	
}

?>