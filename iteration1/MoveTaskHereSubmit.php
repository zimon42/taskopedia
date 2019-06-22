<?php

include_once("SkeletonPage.php");
include_once("TaskopediaData.php");
include_once("TaskHierarchy.php");
include_once("utils/ArrayHandler.php");
include_once("TaskNewsData.php");

class MoveTaskHereSubmit extends SkeletonPage {

	public $moved_task_main_id;
	public $moved_task_id;
	public $old_parent_main_id;
	public $old_parent_id;
	public $new_parent_main_id;
	public $new_parent_id;
	
	public function getContent() {
		if (isset($_SESSION["task_clipboard"])) {
			$move_this_task_main_task_id = $_SESSION["task_clipboard_main_task_id"];
			$move_this_task_task_id = $_SESSION["task_clipboard_task_id"];
			$move_to_task_main_task_id = $this->mainTaskId;
			$move_to_task_task_id = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);
			$result = MoveTaskHandler::checkMove($move_this_task_main_task_id, $move_this_task_task_id, $move_to_task_main_task_id, $move_to_task_task_id);
			if ($result["status"] == "ok") {
				$this->doMove($move_this_task_main_task_id, $move_this_task_task_id, $move_to_task_main_task_id, $move_to_task_task_id);
				return $this->getContentSuccess();
			}
			else {
				return "An unexpected error occurred: " . $result["message"];
			}
		}
		return "An unexpected error occurred: Cannot perform task move because task clipboard is empty";		
	}
	
	public function getContentSuccess() {
		$html = "";
		$html .= "moved_task_main_id: " . $this->moved_task_main_id . "<br>";
		$html .= "moved_task_id: " . $this->moved_task_id . "<br>";
		$html .= "old_parent_main_id: " . $this->old_parent_main_id . "<br>";
		$html .= "old_parent_id: " . $this->old_parent_id . "<br>";		
		$html .= "new_parent_main_id: " . $this->new_parent_main_id . "<br>";
		$html .= "new_parent_id: " . $this->new_parent_id . "<br>";		
		
		// Reset $html, discard previous debug messages
		$html = "";
		$html .= "Task was successfully moved!<br><br>";
		$html .= <<<HTML
<button id=go_to_moved_task_button>Go to moved task</button>&nbsp;
<button id=go_to_old_parent_button>Go to old parent</button>&nbsp;
<button id=go_to_new_parent_button>Go to new parent</button>		
HTML;
		return $html;
	}
	
	public function getAddToHead() {
		$movedTaskLink = TaskHandler::getLinkToTaskPage($this->moved_task_main_id, $this->moved_task_id);
		$oldParentLink = TaskHandler::getLinkToTaskPage($this->old_parent_main_id, $this->old_parent_id);		
		$newParentLink = TaskHandler::getLinkToTaskPage($this->new_parent_main_id, $this->new_parent_id);				
		$html = "";
		$html .= <<<HTML
<script>		
$(document).ready(function() {
	$("#go_to_moved_task_button").click(function() {
		location = "$movedTaskLink";
	});
	$("#go_to_old_parent_button").click(function() {
		location = "$oldParentLink";
	});
	$("#go_to_new_parent_button").click(function() {
		location = "$newParentLink";
	});	
});
</script>
HTML;
		return $html;
	}	
	
	public function doMove($main_task_id, $task_id, $to_main_task_id, $to_task_id) {
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
		
		// Add news events here:
		
		// News event 1: moved the current task
		$movedTaskParams = TaskopediaData::getTaskPageParams($main_task_id, $task_id);
		$html .= "moved task type: " . $movedTaskParams["task_type"] . "<br>";
		$html .= "moved task main id: " . $movedTaskParams["main_task_id"] . "<br>";
		$html .= "moved task id: " . $movedTaskParams["task_id"] . "<br>";
		$evArr = array(
			"type" => "moved_this_task",
			"old_parent_title" => $parentTaskArr["title"],
			"new_parent_title" => $targetTaskArr["title"]
		);
		TaskNewsData::addEvent3($movedTaskParams["task_type"], $movedTaskParams["main_task_id"], $movedTaskParams["task_id"], $evArr);
		
		// News event 2: moved a subtask away 
		$oldParentTaskParams = TaskopediaData::getTaskPageParams($main_task_id, $parentTaskId);
		$movedTaskArr = TaskopediaData::getTaskPageData($main_task_id, $task_id);
		$html .= "old parent task type: " . $oldParentTaskParams["task_type"] . "<br>";
		$html .= "old parent task main id: " . $oldParentTaskParams["main_task_id"] . "<br>";
		$html .= "old parent task id: " . $oldParentTaskParams["task_id"] . "<br>";
		$evArr = array(
			"type" => "moved_subtask_away",
			"subtask_title" => $movedTaskArr["title"],
			"new_parent_title" => $targetTaskArr["title"]
		);
		TaskNewsData::addEvent3($oldParentTaskParams["task_type"], $oldParentTaskParams["main_task_id"], $oldParentTaskParams["task_id"], $evArr);

		// News event 3: moved a subtask here
		$newParentTaskParams = TaskopediaData::getTaskPageParams($to_main_task_id, $to_task_id);
		$html .= "new parent task type: " . $newParentTaskParams["task_type"] . "<br>";
		$html .= "new parent task main id: " . $newParentTaskParams["main_task_id"] . "<br>";
		$html .= "new parent task id: " . $newParentTaskParams["task_id"] . "<br>";
		$evArr = array(
			"type" => "moved_subtask_here",
			"subtask_title" => $movedTaskArr["title"],
			"old_parent_title" => $parentTaskArr["title"]
		);
		TaskNewsData::addEvent3($newParentTaskParams["task_type"], $newParentTaskParams["main_task_id"], $newParentTaskParams["task_id"], $evArr);
		
		/*
		$moveTaskType =
		$moveTaskMainId = 
		$moveTaskId =
		
		$oldParentType =
		$oldParentMainId =
		$oldParentId =
		
		$newParentType =
		$newParentMainId =
		$newParentId =
		
		
		*/

		// Set these so they can accessed in getContentSuccess()
		$this->moved_task_main_id = $main_task_id;
		$this->moved_task_id = $task_id;
		$this->old_parent_main_id = $main_task_id;
		$this->old_parent_id = $parentTaskId;
		$this->new_parent_main_id = $to_main_task_id;
		$this->new_parent_id = $to_task_id;
		
		return $html;
	}
	
}

?>