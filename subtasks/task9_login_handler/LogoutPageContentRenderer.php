<?php

class LogoutPageContentRenderer {
	
	public static $errorMsg = "none";
	
	public static function render() {
		
		$html = "";
		
		$html .= "You have been logged out";

		return $html;
	}
	
}

?>