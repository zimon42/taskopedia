<?php

include_once("utils/JsonFileHandler.php");
include_once("SkeletonPage.php");
include_once("TaskopediaData.php");
include_once("TaskNewsData.php");

class SaveResultSubmit extends SkeletonPage {
	
	public function getContent() {

		$taskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);
		$taskArr = TaskopediaData::getTaskPageData($this->mainTaskId, $taskId);
		
		$resState = $_POST["res_state"];

		$taskArr["result"] = $resState;
		
		TaskopediaData::setTaskPageData($this->mainTaskId, $taskId, $taskArr);
		
		// Register task news event
		TaskNewsData::addEvent3($this->taskType, $this->mainTaskId, $this->taskId, array("type" => "updated_result"));
	}
	
	public function getAddToHead() {
		return "";
	}
	
}

?>