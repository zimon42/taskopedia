<?php

include_once("TaskopediaData.php");
include_once("TaskHierarchy.php");

class MoveTaskHandler {
	
	
	// Returns an array with the "status" key set to "ok" if moving task 1 (argments 1 and 2) 
	// to task 2 (arguments 3 and 4) subtasks. If not ok, sets the "status" key to "error" and
	// also sets the "message" key to the error message
	
	public static function checkMove($move_this_task_main_task_id, $move_this_task_task_id, $move_to_task_main_task_id, $move_to_task_task_id) {
		
		// Case 1: At the moment moving tasks between different main tasks, not allowed
		if ($move_this_task_main_task_id != $move_to_task_main_task_id) {
			return array("status" => "error", "message" => "At the moment moving tasks between different main tasks, not allowed");
		}
		
		// Case 2: Move a task to its subtasks, not allowed
		if ($move_this_task_main_task_id == $move_to_task_main_task_id &&
			$move_this_task_task_id == $move_to_task_task_id) {
			return array("status" => "error", "message" => "Moving a task to its subtasks, not allowed");
		}
		
		// Case 3: Move a task to a decendant task, not allowed
		$rootTaskId = TaskopediaData::getTaskPageId("main_task", $move_to_task_main_task_id, "");
		if (TaskHierarchy::isAncestor($move_to_task_main_task_id, $rootTaskId, $move_this_task_task_id, $move_to_task_task_id)) {
			return array("status" => "error", "message" => "Moving a task to a decendant task, not allowed");
		}
		
		return array("status" => "ok");
		
	}
	
}

?>