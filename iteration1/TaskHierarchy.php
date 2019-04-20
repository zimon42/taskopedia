<?php

include_once("TaskopediaData.php");

class TaskHierarchy {
	
	public static function render($task_type, $main_task_id, $task_id) {
		$html = "";
		
		//$html .= "Task type: " . $task_type . "<br>";
		//$html .= "Main task id: " . $main_task_id . "<br>";
		//$html .= "Task id: " . $task_id . "<br>";
		
		$rootTaskId = TaskopediaData::getTaskPageId("main_task", $main_task_id, "");
		
		$fromTaskId = $rootTaskId;
		$toTaskId = TaskopediaData::getTaskPageId($task_type, $main_task_id, $task_id);
		
		//$html .= "From task id: " . $fromTaskId . "<br>";
		//$html .= "To task id: " . $toTaskId . "<br>";
		
		/*
		// Print all tasks
		$allTaskIds = self::getAllTaskIds($main_task_id, $rootTaskId);
		$html .= "All task ids:<br>";
		for ($i=0; $i<count($allTaskIds); $i++) {
			$html .= "<a href='index.php?page=task_page&task_type=subtask&main_task_id=".$main_task_id."&task_id=".$allTaskIds[$i]."'>".$allTaskIds[$i]."</a><br>";
		}
		
		// Print parent
		$parentId = self::getParentTaskId($main_task_id, $rootTaskId, $toTaskId);
		$html .= "Parent: " . ($parentId!==FALSE ? $parentId : "no parent") . "<br>";
		
		// Print sequence
		$html .= "Sequence: <br>";
		$seqArr = self::getTaskSequence($main_task_id, $rootTaskId, $fromTaskId, $toTaskId);
		for ($i=0; $i<count($seqArr); $i++) {
			$taskId = $seqArr[$i];
			$html .= $taskId . "<br>";
		}
		*/
		
		// If this is the main task, print link and return
		if ($toTaskId == $rootTaskId) {
			$subtaskPageData = TaskopediaData::getTaskPageData($main_task_id, $toTaskId);
			$subtaskTitle = $subtaskPageData["title"];
			$html .= "&gt; <a href='index.php?page=task_page&task_type=subtask&main_task_id=".$main_task_id."&task_id=".$toTaskId."'>Main task: " . $subtaskTitle . "</a><br>";
			return $html;
		}
		
		// Print task sequence, except last element:
		$indent = "";
		$seqArr = self::getTaskSequence($main_task_id, $rootTaskId, $fromTaskId, $toTaskId);
		for ($i=0; $i<count($seqArr)-1; $i++) {
			$subtaskPageId = $seqArr[$i];
			$subtaskPageData = TaskopediaData::getTaskPageData($main_task_id, $subtaskPageId);
			$subtaskTitle = $subtaskPageData["title"];
			//$label = "Label: ";
			$label = $i==0 ? "Main task: " : ($i==count($seqArr)-2 ? "Parent task: " : "Ancestor task: ");
			if ($i==0) {
				$href="index.php?page=main_task_page&task_type=main_task&main_task_id=".$main_task_id;
			} else {
				$href="index.php?page=task_page&task_type=subtask&main_task_id=".$main_task_id."&task_id=".$subtaskPageId;
			}
			$html .= $indent . "&gt; <a href='$href'>" . $label . $subtaskTitle . "</a><br>";
			$indent .= "&nbsp;&nbsp;&nbsp;&nbsp;";
		}
			
		// Print task siblings:
		$parentId = self::getParentTaskId($main_task_id, $rootTaskId, $toTaskId);
		$parentTaskArr = TaskopediaData::getTaskPageData($main_task_id, $parentId);
		$subtasks = $parentTaskArr["subtasks"];
		for ($i=0; $i<count($subtasks); $i++) {
			$subtaskPageId = $subtasks[$i];
			$subtaskPageData = TaskopediaData::getTaskPageData($main_task_id, $subtaskPageId);
			$subtaskTitle = $subtaskPageData["title"];
			$class = $subtaskPageId == $toTaskId ? "current_link" : "";
			$label = $subtaskPageId == $toTaskId ? "This task: " : "Sibling task: ";
			$html .= $indent . "&gt; <a class='$class' href='index.php?page=task_page&task_type=subtask&main_task_id=".$main_task_id."&task_id=".$subtaskPageId."'>" . $label . $subtaskTitle . "</a><br>";
		}		
			
		return $html;
	}
	
	public static function getAllTaskIds($main_task_id, $root_task_id) {
		$taskIds = array();
		array_push($taskIds, $root_task_id);
		$rootTaskArr = TaskopediaData::getTaskPageData($main_task_id, $root_task_id);
		$subtaskArr = $rootTaskArr["subtasks"];
		for ($i=0; $i<count($subtaskArr); $i++) {
			$subtaskId = $subtaskArr[$i];
			$subtaskIds = self::getAllTaskIds($main_task_id, $subtaskId);
			$taskIds = array_merge($taskIds, $subtaskIds);
		}
		return $taskIds;
	}
	
	public static function getParentTaskId($main_task_id, $root_task_id, $taskId) {
		$allTaskIds = self::getAllTaskIds($main_task_id, $root_task_id);
		for ($i=0; $i<count($allTaskIds); $i++) {
			$tId = $allTaskIds[$i];
			$tArr = TaskopediaData::getTaskPageData($main_task_id, $tId);
			if (in_array($taskId, $tArr["subtasks"])) {
				return $tId;
			}
		}
		return FALSE;
	}
	
	public static function getTaskSequence($main_task_id, $root_task_id, $from_task_id, $to_task_id) {
		if ($from_task_id == $to_task_id) {
			return array($from_task_id);
		}
		$parentId = self::getParentTaskId($main_task_id, $root_task_id, $to_task_id);
		$seqArr = self::getTaskSequence($main_task_id, $root_task_id, $from_task_id, $parentId);
		return array_merge($seqArr, array($to_task_id));
	}
	
	// http://localhost/taskopedia/iteration1/index.php?page=main_task_page&main_task_id=00000001
	public static function renderAll($main_task_id) {
		// return "Render all";
		$rootTaskId = TaskopediaData::getTaskPageId("main_task", $main_task_id, "");
		return self::renderAllHelper($main_task_id, $rootTaskId, 0);
	}
	
	public static function renderAllHelper($main_task_id, $task_id, $level) {
		$html = "";
		$indent = "";
		for ($i=0; $i<$level; $i++) {
			$indent .= "&nbsp;&nbsp;&nbsp;&nbsp;";
		}		
		$taskArr = TaskopediaData::getTaskPageData($main_task_id, $task_id);
		$class = $level==0 ? "class=current_link " : "";
		if ($level==0) {
			$href="index.php?page=main_task_page&task_type=main_task&main_task_id=".$main_task_id;
		} else {
			$href="index.php?page=task_page&task_type=subtask&main_task_id=".$main_task_id."&task_id=". $task_id;
		}
		$html .= $indent . "&gt;<a {$class}href='$href'>".$taskArr["title"]."</a><br>";
		for ($i=0; $i<count($taskArr["subtasks"]); $i++) {
			$html .= self::renderAllHelper($main_task_id, $taskArr["subtasks"][$i], $level+1);
		}
		return $html;
	}
	
}

?>