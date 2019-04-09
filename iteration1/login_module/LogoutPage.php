<?php

include_once("LogoutHandler.php");
include_once("SkeletonPage.php");

class LogoutPage extends SkeletonPage {
		
	public function getContent() {
				
		$html = "";
		
		$html .= LogoutHandler::logout();		
		
		$html .= "You have been logged out";

		return $html;
	}
	
	public function getAddToHead() {
		
		return "";
		
	}
	
}

?>