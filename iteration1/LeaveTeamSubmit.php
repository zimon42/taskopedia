<?php

include_once("SkeletonPage.php");
include_once("login_module/LoginHandler.php");
include_once("TaskNewsData.php");
include_once("TaskHandler.php");

class LeaveTeamSubmit extends SkeletonPage {

	public $gTaskId;

	public function preHandle() {
		
		$taskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);
		$taskArr = TaskopediaData::getTaskPageData($this->mainTaskId, $taskId);
		
		if (!LoginHandler::userIsLoggedIn()) {
			return "Error: You seem to be leaving a team, but you are not logged in";
		}
		
		$userName = LoginHandler::loggedInUserName();

		$newTeamMemberArr = array();
		
		// Filter out team members 
		for ($i=0; $i<count($taskArr["team_members"]); $i++) {
			if ($taskArr["team_members"][$i] != LoginHandler::loggedInUserName()) {
				array_push($newTeamMemberArr, $taskArr["team_members"][$i]);
			}
		}
		
		$taskArr["team_members"] = $newTeamMemberArr;
				
		TaskopediaData::setTaskPageData($this->mainTaskId, $taskId, $taskArr);	
	
		// Register news event
		TaskNewsData::addEvent3($this->taskType, $this->mainTaskId, $this->taskId, array("type" => "user_left"));	
		
		$this->gTaskId = $taskId;
	}
	
	public function getContent() {
		$html = "";
		$html .= <<<HTML
You have successfully left the team!<br><br>
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
	
}

?>