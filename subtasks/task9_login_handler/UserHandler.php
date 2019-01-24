<?php

include_once("JsonFileHandler.php");

class UserHandler {
	
	public static function getUserData($userName) {
		$arr = JsonFileHandler::readPhpArray("users.txt");
		for ($i=0; $i<count($arr); $i++) {
			$userData = $arr[$i];
			if ($userData["user_name"] == $userName) {
				return $userData;
			}
		}
		return null;
	}
	
	public static function existsUserName($userName) {
		return self::getUserData($userName) != null;
	}
	
	public static function getPassword($userName) {
		$userData = self::getUserData($userName);
		if ($userData == null) {
			echo "Error UserHandler::getPassword, user '$userName' does not exist";
		}
		return $userData["password"];
	}
	
}

?>