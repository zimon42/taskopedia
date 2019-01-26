<?php

include_once("LoginHandler.php");

class SkeletonPageRenderer {
	
	public static function render($content) {
		
		$html = "";
		
		$html .= "<html>";
		$html .= "<head>";
		$html .= "<script src=jquery.js></script>";
		$html .= "<script src=LoginHandler.js></script>";
		$html .= "</head>";
		$html .= "<body>";
		
		if (LoginHandler::userIsLoggedIn()) {
			$html .= "Logged in as " . LoginHandler::loggedInUserName() . ", ";
			$html .= "<a href=index.php?page=logout>Logout</a> ";
		} else {
			$html .= "Not logged in, ";
			$html .= "<a href=index.php?page=login>Login</a> ";			
		}
		
		$html .= "<a href=index.php?page=your_page>Your page</a> ";
		
		$html .= "<a href=index.php>Main page</a>";
		
		$html .= "<hr>";
		
		$html .= $content;
		
		$html .= "</body>";
		$html .= "</html>";
		
		return $html;
		
	}
	
}

?>