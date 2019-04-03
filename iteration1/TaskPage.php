<?php

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