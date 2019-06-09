<?php

include_once("utils/JsonFileHandler.php");
include_once("SkeletonPage.php");
include_once("TaskopediaData.php");
include_once("utils/ParamsHandler.php");
include_once("TaskNewsData.php");

class SaveTaskinfoSubmit extends SkeletonPage {
	
	public function getContent() {
		
		$taskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);
		$taskArr = TaskopediaData::getTaskPageData($this->mainTaskId, $taskId);
		
		$resState = $_POST["res_state"];

		// So we can check if title has changed for news data event, see below
		$oldTitle = $taskArr["title"];
		$newTitle = ParamsHandler::getParamValue($resState, "title");

		// So we can check if status has changed, like for the reason above
		$oldStatus = $taskArr["status"];
		$newStatus = ParamsHandler::getParamValue($resState, "status");
		
		$taskArr["title"] = ParamsHandler::getParamValue($resState, "title");
		$taskArr["description"] = ParamsHandler::getParamValue($resState, "desc");
		$taskArr["more_info"] = ParamsHandler::getParamValue($resState, "more_info");
		$taskArr["status"] = ParamsHandler::getParamValue($resState, "status");
		
		TaskopediaData::setTaskPageData($this->mainTaskId, $taskId, $taskArr);

		// Possible title changed title news data event
		$evArr = array(
			"type" => "changed_title",
			"old_title" => $oldTitle,
			"new_title" => $newTitle
		);
		if ($oldTitle != $newTitle) {
			TaskNewsData::addEvent3($this->taskType, $this->mainTaskId, $this->taskId, $evArr);			
		}

		// and the same for task status
		$evArr = array(
			"type" => "changed_status",
			"old_status" => $oldStatus,
			"new_status" => $newStatus
		);		
		if ($oldStatus != $newStatus) {
			TaskNewsData::addEvent3($this->taskType, $this->mainTaskId, $this->taskId, $evArr);			
		}
		
		return $resState;

	}
	
	public function getAddToHead() {
		return "";
	}
	
}

?>