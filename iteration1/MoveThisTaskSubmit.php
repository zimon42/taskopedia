<?php

include_once("SkeletonPage.php");

class MoveThisTaskSubmit extends SkeletonPage {
	
	public function getContent() {
		$taskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);		
		$_SESSION["task_clipboard"] = true;
		// $_SESSION["task_clipboard_task_type"] = $this->taskType;
		$_SESSION["task_clipboard_main_task_id"] = $this->mainTaskId;
		$_SESSION["task_clipboard_task_id"] = $taskId;
	}
	
	public function getAddToHead() {
		return "";
	}
	
}

?>