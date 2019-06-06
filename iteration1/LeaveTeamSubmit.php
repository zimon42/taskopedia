<?php

include_once("SkeletonPage.php");
include_once("login_module/LoginHandler.php");
include_once("TaskNewsData.php");

class LeaveTeamSubmit extends SkeletonPage {
	
	public function getContent() {
	
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
	
		return "You have successfully left the team";
	
	}
	
}

?>