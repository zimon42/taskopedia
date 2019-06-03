<?php

include_once("utils/JsonFileHandler.php");
include_once("TaskopediaData.php");
include_once("login_module/LoginHandler.php");
include_once("utils/GuidCreator.php");

class TaskNewsData {
	
	public static function getEvents($newsFile) {
		return JsonFileHandler::readPhpArray($newsFile);
	}	
	
	public static function addEvent($newsFile, $evArr) {
		$eventsArr = JsonFileHandler::readPhpArray($newsFile);
		array_push($eventsArr, $evArr);
		JsonFileHandler::writePhpArray($newsFile, $eventsArr);
	}
	
	// Create news file path from task info
	public static function addEvent2($taskType, $mainTaskId, $taskId, $evArr) {
		$tId = TaskopediaData::getTaskPageId($taskType, $mainTaskId, $taskId);
		$newsFile = TaskopediaData::getTaskNewsFilePath($mainTaskId, $tId);
		self::addEvent($newsFile, $evArr);
	}
	
	// Add user and date_time fields to event array
	public static function addEvent3($taskType, $mainTaskId, $taskId, $evArr) {
		$user = LoginHandler::userIsLoggedIn() ? LoginHandler::loggedInUserName() : "user_not_logged_in";
		$evArr["event_id"] = GuidCreator::create();
		$evArr["user"] = $user;
		$evArr["date_time"] = DateHandler::getNowDateTimeString();
		self::addEvent2($taskType, $mainTaskId, $taskId, $evArr);
	}
	
}

?>