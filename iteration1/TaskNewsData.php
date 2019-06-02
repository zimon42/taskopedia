<?php

include_once("utils/JsonFileHandler.php");

class TaskNewsData {
	
	public static function getEvents($newsFile) {
		return JsonFileHandler::readPhpArray($newsFile);
	}	
	
}

?>