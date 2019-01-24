<?php

class LoginPageRenderer {
	
	public static $errorMsg = "none";
	
	public static function render() {
		
		if (self::$errorMsg != "none") {
			$html .= "<div style='color:red'>" . self::$errorMsg . "</div>";
		}
		
		$html .= <<<HTML
		<table style='width:100%'>
		<tr>
			<td>User name:</td>
			<td>input type=text size=30 id=login_user_name tabindex=1/></td>
			<td><button onclick='LoginHandler.handleLoginClick()'>Logga in</button></td>
		</tr>
		<tr>
			<td>Lösenord:</td>
			<td><input type=text size=30 id=login_user_name tabindex=2/></td>
			<td>&nbsp;</td>
		</tr>
		</table>
HTML;
		return $html;
	}
	
}

?>