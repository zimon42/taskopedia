<?php

include_once ("TaskPage.php");
include_once ("EditResultPage.php");
include_once ("SaveResultPage.php");

class RequestHandler {
	
	public static function getPage($pageName) {
		
		if ($pageName == "task_page") {
			$page = new TaskPage();
			$page->taskId = $_GET["task_id"];
			return $page;
		}
		if ($pageName == "task_edit_result") {
			$page = new EditResultPage();
			$page->taskId = $_GET["task_id"];
			return $page;
		}
		if ($pageName == "task_save_result") {
			$page = new SaveResultPage();
			return $page;
		}		
		return FALSE;
	}
	
}

?>