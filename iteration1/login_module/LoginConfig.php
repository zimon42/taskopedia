<?php

include_once("TaskHandler.php");

class LoginConfig {
	
	public static $mainPagePath = "index.php";
	public static $usersFilePath = "taskopedia_data/users.txt";
	
	public static function getExtraParams($page) {
		return TaskHandler::getTaskParams($page);
	}
	
}

?>