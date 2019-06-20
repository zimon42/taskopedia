<?php

include_once("TaskopediaData.php");

class TaskHandler {
	
	public static function getTaskParams($page) {
		$taskType = $page->taskType;
		
		if ($taskType == "main_task") {
			return "task_type=main_task&main_task_id=".$page->mainTaskId;
		}
		if ($taskType == "subtask") {
			return "task_type=subtask&main_task_id=".$page->mainTaskId."&task_id=".$page->taskId;
		}
		
	}
	
	public static function setTaskParams($page) {
		$taskType = $_GET["task_type"];
		
		$page->taskType = $taskType;
		
		if ($taskType == "main_task") {
			$page->mainTaskId = $_GET["main_task_id"];
		}
		if ($taskType == "subtask") {
			$page->mainTaskId = $_GET["main_task_id"];
			$page->taskId = $_GET["task_id"];
		}
	}
	
	public static function getLinkToTaskPage($main_task_id, $task_id) {
		// return "index.php";
		$root_task_id = TaskopediaData::getTaskPageId("main_task", $main_task_id, "");
		if ($task_id == $root_task_id) {
			// This is the main task
			return "index.php?page=main_task_page&main_task_id=$main_task_id";
		}
		else {
			// This is not the main task
			return "index.php?page=task_page&main_task_id=$main_task_id&task_id=$task_id";
		}
	}
	
}

?>