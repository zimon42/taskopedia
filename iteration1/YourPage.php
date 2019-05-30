<?php

include_once("SkeletonPage.php");
include_once("TaskopediaData.php");
include_once("TaskHierarchy.php");
include_once("login_module/LoginHandler.php");

class YourPage extends SkeletonPage {
	
	public function getContent() {
		$html = "";
		$html .= "You are a member of the following tasks:<br><br>";
		
		$rootTaskId = TaskopediaData::getTaskPageId("main_task", $this->mainTaskId, "");
		$taskIdsArr = TaskHierarchy::getAllTaskIds($this->mainTaskId, $rootTaskId);
		
		for ($i=0; $i<count($taskIdsArr); $i++) {
			$taskId = $taskIdsArr[$i];
			$taskArr = TaskopediaData::getTaskPageData($this->mainTaskId, $taskId);
			if (LoginHandler::userIsLoggedIn() && in_array(LoginHandler::loggedInUserName(), $taskArr["team_members"])) {
				$html .= self::displayTaskLink($this->mainTaskId, $rootTaskId, $taskId) . "<br>";
			}
		}
		
		return $html;
	}
	
	public static function displayTaskLink($mainTaskId, $rootTaskId, $taskId) {
		$is_main_task = $rootTaskId == $taskId;
		$taskArr = TaskopediaData::getTaskPageData($mainTaskId, $taskId);
		$title = $taskArr["title"];
		if ($is_main_task) {
			return "<a href=index.php?page=main_task_page&main_task_id=$mainTaskId>Main task: $title</a>";
		}
		else {
			return "<a href=index.php?page=task_page&main_task_id=$mainTaskId&task_id=$taskId>Subtask: $title</a>";
		}
	}
	
}

?>