<?php

include_once("SkeletonPage.php");
include_once("TaskHandler.php");

class RestoreTaskSubmit extends SkeletonPage {
	
	public $restoredTaskId;
	public $parentTaskId;
	
	public function preHandle() {
		$taskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);
		$taskArr = TaskopediaData::getTaskPageData($this->mainTaskId, $taskId);

		$taskArr["is_deleted"] = false;
		
		TaskopediaData::setTaskPageData($this->mainTaskId, $taskId, $taskArr);		
		
		$this->restoredTaskId = $taskId;
		
		// Get parent id
		$rootTaskId = TaskopediaData::getTaskPageId("main_task", $this->mainTaskId, "");
		$this->parentTaskId = TaskHierarchy::getParentTaskId($this->mainTaskId, $rootTaskId, $taskId);
		
	}
	
	public function getContent() {
		$html = "";
		$html .= <<<HTML
This task has been successfully restored!<br><br>
<button id=go_to_restored_task_button>Go to restored task</button>&nbsp;
<button id=go_to_parent_task_button>Go to parent task</button><br>		
HTML;
		return $html;
	}
	
	public function getAddToHead() {
		$restoredTaskLink = TaskHandler::getLinkToTaskPage($this->mainTaskId, $this->restoredTaskId);
		$parentTaskLink = TaskHandler::getLinkToTaskPage($this->mainTaskId, $this->parentTaskId);		
		$html = "";
		$html .= <<<HTML
<script>		
$(document).ready(function() {
	$("#go_to_restored_task_button").click(function() {
		location = "$restoredTaskLink";
	});
	$("#go_to_parent_task_button").click(function() {
		location = "$parentTaskLink";
	});
});
</script>
HTML;
		return $html;
	}
		
}

?>