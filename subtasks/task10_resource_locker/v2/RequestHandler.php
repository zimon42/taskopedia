<?php

include_once ("TaskPage.php");

class RequestHandler {
	
	public static function getPage($pageName) {
		
		if ($pageName == "task_page") {
			$page = new TaskPage();
			return $page;
		}
		return FALSE;
	}
	
}

?>