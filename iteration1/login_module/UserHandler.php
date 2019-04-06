<?php

include_once("utils/JsonFileHandler.php");
include_once("LoginConfig.php");

class UserHandler {
	
	public static function getUserData($userName) {
		$usersFilePath = LoginConfig::$usersFilePath;
		$arr = JsonFileHandler::readPhpArray($usersFilePath);
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