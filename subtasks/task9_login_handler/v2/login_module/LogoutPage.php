<?php

include_once("LogoutHandler.php");

class LogoutPage {
		
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