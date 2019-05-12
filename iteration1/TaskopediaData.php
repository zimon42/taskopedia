<?php
include_once("utils/JsonFileHandler.php");

class TaskopediaData {

	public static function getMainTaskPagePath($main_task_id) {
		return "taskopedia_data/main_tasks/main_task_{$main_task_id}/main_task_info.txt";
	}
	
	public static function getMainTaskPageData($main_task_id) {
		$path = self::getMainTaskPagePath($main_task_id);
		$arr = JsonFileHandler::readPhpArray($path);
		return $arr;
	}
	
	public static function setMainTaskPageData($main_task_id, $arr) {
		$path = self::getMainTaskPagePath($main_task_id);
		$arr = JsonFileHandler::writePhpArray($path, $arr);		
	}

	public static function getTaskPagePath($main_task_id, $task_page_id) {
		return "taskopedia_data/main_tasks/main_task_{$main_task_id}/task_pages/task_page_{$task_page_id}/task_page.txt";
	}
	
	public static function getTaskPageData($main_task_id, $task_page_id) {
		$path = self::getTaskPagePath($main_task_id, $task_page_id);
		$arr = JsonFileHandler::readPhpArray($path);
		return $arr;
	}
	
	public static function setTaskPageData($main_task_id, $task_page_id, $arr) {
		$path = self::getTaskPagePath($main_task_id, $task_page_id);
		$arr = JsonFileHandler::writePhpArray($path, $arr);		
	}
	
	// Gets the task that is pointed out as root task in the main_task_info file
	public static function getRootTaskPageData($main_task_id) {
		$mainTaskArr = self::getMainTaskPageData($main_task_id);
		$rootTaskId = $mainTaskArr["root_task_id"];
		$rootTaskArr = self::getTaskPageData($main_task_id, $rootTaskId);
		return $rootTaskArr;
	}
	
	public static function makeTaskPageDir($main_task_id, $task_page_id) {
		$path = "taskopedia_data/main_tasks/main_task_{$main_task_id}/task_pages/task_page_{$task_page_id}";
		mkdir($path);
	}
	
	// Handles different task types
	public static function getTaskPageId($task_type, $main_task_id, $task_id) {
		if ($task_type == "main_task") {
			$mainTaskArr = self::getMainTaskPageData($main_task_id);
			return $mainTaskArr["root_task_id"];			
		}
		if ($task_type == "subtask") {
			return $task_id;
		}
	}
	
	public static function getTaskForumFilePath($main_task_id, $task_page_id) {
		return "taskopedia_data/main_tasks/main_task_{$main_task_id}/task_pages/task_page_{$task_page_id}/task_forum.txt";
	}	
	
}

?>