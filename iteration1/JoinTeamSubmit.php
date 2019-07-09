<?php

include_once("SkeletonPage.php");
include_once("login_module/LoginHandler.php");
include_once("TaskNewsData.php");
include_once("TaskHandler.php");

class JoinTeamSubmit extends SkeletonPage {

	public $gTaskId; // Set in preHandle and accessed in getAddToHead
	
	public function preHandle() {

		$taskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);
		$taskArr = TaskopediaData::getTaskPageData($this->mainTaskId, $taskId);
		
		if (!LoginHandler::userIsLoggedIn()) {
			return "Error: You seem to be joining a team, but you are not logged in";
		}
		
		$userName = LoginHandler::loggedInUserName();

		$teamMemberArr = &$taskArr["team_members"];
		
		array_push($teamMemberArr, $userName);
		
		// If not exists, add user entry in work logs
		if (!self::userExistsInWorklogs($userName, $taskArr["worklogs"])) {
			$worklogEntry = array("name" => $userName, "content" => "");
			array_push($taskArr["worklogs"], $worklogEntry);
		}
		
		TaskopediaData::setTaskPageData($this->mainTaskId, $taskId, $taskArr);	

		// Register news event
		TaskNewsData::addEvent3($this->taskType, $this->mainTaskId, $this->taskId, array("type" => "user_joined"));		
	
		$this->gTaskId = $taskId;
	}
	
	public function getContent() {

		$html = "";
		$html .= <<<HTML
You have successfully joined the team!<br><br>
<b>Note</b>: you do not have to be a member of a task team to work with the task page. However being member of a task team lets other users see who are currently working on the task page. Also, if you are a member of a task team, those tasks will show up when you click the "Your page" link at the top of the task page. Plus you need to join a team to create an entry in the work log with your name<br><br>
<button id=go_to_task_button>Go back to task</button>
HTML;
		return $html;
	
	}
	
	public function getAddToHead() {
		$link = TaskHandler::getLinkToTaskPage($this->mainTaskId, $this->gTaskId);
		$html = "";
		$html .= <<<HTML
<script>
$(document).ready(function() {
	$("#go_to_task_button").click(function() {
		location = "$link";
	});
});
</script>
HTML;
		return $html;
	}
	
	public static function userExistsInWorklogs($userName, $worklogsArr) {
		for ($i=0; $i<count($worklogsArr); $i++) {
			if ($userName == $worklogsArr[$i]["name"]) {
				return true;
			}
		}
		return false;
	}
	
}

?>