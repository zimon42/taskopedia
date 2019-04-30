<?php

include_once("utils/JsonFileHandler.php");
include_once("SkeletonPage.php");
include_once("TaskopediaData.php");

class SaveResultSubmit extends SkeletonPage {
	
	public function getContent() {

		$taskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);
		$taskArr = TaskopediaData::getTaskPageData($this->mainTaskId, $taskId);
		
		$resState = $_POST["res_state"];

		$taskArr["result"] = $resState;
		
		TaskopediaData::setTaskPageData($this->mainTaskId, $taskId, $taskArr);
	}
	
	public function getAddToHead() {
		return "";
	}
	
}

?>