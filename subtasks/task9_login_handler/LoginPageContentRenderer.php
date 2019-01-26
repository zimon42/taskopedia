<?php

class LoginPageContentRenderer {
	
	public static $errorMsg = "none";
	
	public static function render() {
		
		$html = "";
		
		if (self::$errorMsg != "none") {
			$html .= "<div style='color:red'>" . self::$errorMsg . "</div>";
		}
		
		$html .= <<<HTML
		
User name:<br>
<input type=text size=20 id=login_user_name tabindex=1/><br>
Password:<br>
<input type=text size=20 id=login_password tabindex=2/><br>
<button onclick='LoginHandler.handleLoginClick()'>Logga in</button>
HTML;
		return $html;
	}
	
}

?>