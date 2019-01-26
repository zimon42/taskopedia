<?php

class LoginSuccessPageContentRenderer {
	
	public static function render() {
		$html = "Du är nu inloggad";
		$url = isset($_SESSION["navigate_to_url_after_login"])
			? $_SESSION["navigate_to_url_after_login"]
			: "index.php";
		$html .= "<button onclick=\"location='$url'\">Fortsätt</button>";
		return $html;
	}
	
}

?>