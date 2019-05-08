<?php

include_once("SkeletonPage.php");
include_once("TaskopediaData.php");

class SaveWorklogSubmit extends SkeletonPage {
	
	public $userName;
	
	public function getContent() {

		$taskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);
		$arr = TaskopediaData::getTaskPageData($this->mainTaskId, $taskId);
		
		$newContent = $_POST["res_state"];

		// Find user's worklog and update content
		for ($i=0; $i<count($arr["worklogs"]); $i++) {
			$workLog = &$arr["worklogs"][$i];
			if ($workLog["name"] == $this->userName) {
				$workLog["content"] = $newContent;
			}
		}
		
		TaskopediaData::setTaskPageData($this->mainTaskId, $taskId, $arr);
	}
	
}

?>