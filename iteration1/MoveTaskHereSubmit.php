<?php

include_once("SkeletonPage.php");
include_once("TaskopediaData.php");
include_once("TaskHierarchy.php");
include_once("utils/ArrayHandler.php");

class MoveTaskHereSubmit extends SkeletonPage {
	
	public function getContent() {
		if (isset($_SESSION["task_clipboard"])) {
			$move_this_task_main_task_id = $_SESSION["task_clipboard_main_task_id"];
			$move_this_task_task_id = $_SESSION["task_clipboard_task_id"];
			$move_to_task_main_task_id = $this->mainTaskId;
			$move_to_task_task_id = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);
			$result = MoveTaskHandler::checkMove($move_this_task_main_task_id, $move_this_task_task_id, $move_to_task_main_task_id, $move_to_task_task_id);
			if ($result["status"] == "ok") {
				return self::doMove($move_this_task_main_task_id, $move_this_task_task_id, $move_to_task_main_task_id, $move_to_task_task_id);
				return "Task was successfully moved";
			}
			else {
				return "An unexpected error occurred: " . $result["message"];
			}
		}
		return "An unexpected error occurred: Cannot perform task move because task clipboard is empty";		
	}
	
	public static function doMove($main_task_id, $task_id, $to_main_task_id, $to_task_id) {
		$html = "";
		$html .= "main_task_id: " . $main_task_id . "<br>";
		$html .= "task_id: " . $task_id . "<br>";
		$html .= "to_main_task_id: " . $to_main_task_id . "<br>";
		$html .= "to_task_id: " . $to_task_id . "<br>";
		
		// Remove subtask entry from parent task
		$rootTaskId = TaskopediaData::getTaskPageId("main_task", $main_task_id, "");
		$parentTaskId = TaskHierarchy::getParentTaskId($main_task_id, $rootTaskId, $task_id);
		$html .= "root task id: " . $rootTaskId . "<br>";
		$html .= "parent task id: ". $parentTaskId . "<br>";
		$parentTaskArr = TaskopediaData::getTaskPageData($main_task_id, $parentTaskId);
		$parentTaskArr["subtasks"] = ArrayHandler::removeElement($parentTaskArr["subtasks"], $task_id);
		TaskopediaData::setTaskPageData($main_task_id, $parentTaskId, $parentTaskArr);
		
		// Add subtask entry to target task
		$targetTaskArr = TaskopediaData::getTaskPageData($to_main_task_id, $to_task_id);
		array_push($targetTaskArr["subtasks"], $task_id);
		TaskopediaData::setTaskPageData($to_main_task_id, $to_task_id, $targetTaskArr);
		
		return $html;
	}
	
}

?>