<?php

include_once("MainPage.php");
include_once("TaskPage.php");

class RequestHandler {
	
	public static function getPage($pageName) {
		
		if ($pageName == "main_page") {
			$page = new MainPage();
			return $page;
		}
		if ($pageName == "task_page") {
			$page = new TaskPage();
			return $page;
		}		
		return FALSE;
	}
	
}

?>