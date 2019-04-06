<?php

class LoginPage {
	
	public $errorMsg;
	
	public function getContent() {
		$html = "";
		
		if (isset($this->errorMsg)) {
			$html .= "<div style='color:red'>" . $this->errorMsg . "</div>";
		}		
		
		$html .= <<<HTML
User name:<br>
<input type=text size=20 id=login_user_name tabindex=1/><br>
Password:<br>
<input type=text size=20 id=login_password tabindex=2/><br>
<button id=login_done_button>Logga in</button>
HTML;
		return $html;
	
	}
	
	public function getAddToHead() {
		$html = "";
		$html = <<<HTML
<script>
$(document).ready(function() {
	$("#login_done_button").click(function() {
		var login_user_name = $("#login_user_name").val();
		var login_password = $("#login_password").val();
		location = "index.php?page=login_submit&user_name="+ 
			login_user_name + "&password=" + login_password;
	});
});
</script>		
HTML;
		return $html;
	}
	
}

?>