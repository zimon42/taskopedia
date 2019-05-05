<?php

include_once("utils/JsonFileHandler.php");
include_once("SkeletonPage.php");
include_once("TaskopediaData.php");
include_once("utils/ParamsHandler.php");

class SaveTaskinfoSubmit extends SkeletonPage {
	
	public function getContent() {
		
		$taskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);
		$taskArr = TaskopediaData::getTaskPageData($this->mainTaskId, $taskId);
		
		$resState = $_POST["res_state"];

		$taskArr["title"] = ParamsHandler::getParamValue($resState, "title");
		$taskArr["description"] = ParamsHandler::getParamValue($resState, "desc");
		$taskArr["more_info"] = ParamsHandler::getParamValue($resState, "more_info");
		$taskArr["status"] = ParamsHandler::getParamValue($resState, "status");
		
		TaskopediaData::setTaskPageData($this->mainTaskId, $taskId, $taskArr);

		return $resState;

	}
	
	public function getAddToHead() {
		return "";
	}
	
}

?>