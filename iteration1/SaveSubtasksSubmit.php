<?php

include_once("utils/JsonFileHandler.php");
include_once("SkeletonPage.php");
include_once("TaskopediaData.php");

class SaveSubtasksSubmit extends SkeletonPage {
	
	// Approach: Copy subtasks from res state to new list. Append those missing old
	// subtasks to new list and set their is_deleted index to true
	
	public function getContent() {

		$taskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);
		$taskArr = TaskopediaData::getTaskPageData($this->mainTaskId, $taskId);

		// Old subtasks list
		$oldSubtasksArr = $taskArr["subtasks"];
		
		// Res state subtasks list
		$resState = $_POST["res_state"];
		$resSubtasksArr = explode(",", $resState);
		
		// Determine new subtasks list
		$newSubtasksArr = array();
		
		// Copy subtasks from res state to new subtasks list
		for ($i=0; $i<count($resSubtasksArr); $i++) {
			array_push($newSubtasksArr, $resSubtasksArr[$i]);
		}
		
		// Append old subtasks that are not in the res state list,
		// and set their is_delete index to true
		for ($i=0; $i<count($oldSubtasksArr); $i++) {
			$oldSubtaskId = $oldSubtasksArr[$i];
			if (!in_array($oldSubtaskId, $resSubtasksArr)) {
				
				array_push($newSubtasksArr, $oldSubtaskId);
				
				// Update is_deleted 
				$oldSubtask = TaskopediaData::getTaskPageData($this->mainTaskId, $oldSubtaskId);
				$oldSubtask["is_deleted"] = true;
				TaskopediaData::setTaskPageData($this->mainTaskId, $oldSubtaskId, $oldSubtask);
			}
		}
		
		// Update task with new subtask list
		$taskArr["subtasks"] = $newSubtasksArr;		
		TaskopediaData::setTaskPageData($this->mainTaskId, $taskId, $taskArr);

		
	}
	
	/*
	public function getContent() {

		$taskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);
		$taskArr = TaskopediaData::getTaskPageData($this->mainTaskId, $taskId);
		
		$resState = $_POST["res_state"];
		$subtaskIdArr = explode(",", $resState);

		$taskArr["subtasks"] = $subtaskIdArr;
		
		TaskopediaData::setTaskPageData($this->mainTaskId, $taskId, $taskArr);
	}
	*/
	
	public function getAddToHead() {
		return "";
	}
	
}

?>