<?php

include_once("TaskHandler.php");
include_once("TaskNewsData.php");

class ForumConfig {
	
	public static $mainPagePath = "index.php";
	public static $forumModulePath = "forum_module";

	public static function getExtraParams($page) {
		return TaskHandler::getTaskParams($page);
	}

	public static function setExtraParams($page) {
		return TaskHandler::setTaskParams($page);
	}
	
	public static function newTopicListener($args) {
		$evArr = array(
			"type" => "new_forum_topic",
			"topic_id" => $args["topic_id"],
			"title" => $args["title"]
		);
		TaskNewsData::addEvent3($args["task_type"], $args["main_task_id"], $args["task_id"], $evArr);
	}
	
}

?>