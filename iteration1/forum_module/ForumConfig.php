<?php

include_once("TaskHandler.php");

class ForumConfig {
	
	public static $mainPagePath = "index.php";
	public static $forumModulePath = "forum_module";

	public static function getExtraParams($page) {
		return TaskHandler::getTaskParams($page);
	}

	public static function setExtraParams($page) {
		return TaskHandler::setTaskParams($page);
	}
	
}

?>