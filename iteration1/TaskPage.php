<?php

// http://localhost/taskopedia/iteration1/index.php?page=main_task_page&main_task_id=00000001
// http://localhost/taskopedia/iteration1/index.php?page=task_page&main_task_id=00000001&task_id=10000002


include_once("SkeletonPage.php");

class TaskPage extends SkeletonPage {
	
	public function getContent() {
		return "<h1 id=task_title>Task page</h1>";
	}
	
	public function getAddToHead() {
		return "<link rel=\"stylesheet\" type=\"text/css\" href=\"task_page.css\">";
	}
	
}

?>