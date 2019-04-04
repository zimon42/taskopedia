<?php

include_once("MainPage.php");
include_once("TaskPage.php");

class RequestHandler {
	
	public static function getPage($pageName) {
		
		if ($pageName == "main_page") {
			$page = new MainPage();
			return $page;
		}
		if ($pageName == "main_task_page") {
			$page = new TaskPage();
			$page->taskType = "main_task";
			$page->mainTaskId = $_GET["main_task_id"];
			return $page;
		}				
		if ($pageName == "task_page") {
			$page = new TaskPage();
			$page->taskType = "subtask";
			$page->mainTaskId = $_GET["main_task_id"];
			$page->taskId = $_GET["task_id"];
			return $page;
		}		
		return FALSE;
	}
	
}

?>