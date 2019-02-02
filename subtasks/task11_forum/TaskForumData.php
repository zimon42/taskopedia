<?php

include_once("JsonFileHandler.php");

class TaskForumData {
	
	public static function getTopics() {
		return JsonFileHandler::readPhpArray("task_forum.txt");
	}
	
}

?>