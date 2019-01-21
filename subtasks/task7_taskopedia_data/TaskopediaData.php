<?php
include_once("JsonFileHandler.php");

class TaskopediaData {

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
	
}

?>