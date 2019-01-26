function LoginHandler() {};

LoginHandler.handleLoginClick = function() {
	
	var login_user_name = $("#login_user_name").val();
	var login_password = $("#login_password").val();
	
	location = "index.php?page=login_submit&user_name=" + 
		login_user_name + "&password=" + login_password;
	
}