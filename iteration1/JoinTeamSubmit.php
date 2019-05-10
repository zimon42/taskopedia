<?php

include_once("SkeletonPage.php");
include_once("login_module/LoginHandler.php");

class JoinTeamSubmit extends SkeletonPage {
	
	public function getContent() {

		$taskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);
		$taskArr = TaskopediaData::getTaskPageData($this->mainTaskId, $taskId);
		
		if (!LoginHandler::userIsLoggedIn()) {
			return "Error: You seem to be joining a team, but you are not logged in";
		}
		
		$userName = LoginHandler::loggedInUserName();

		$teamMemberArr = &$taskArr["team_members"];
		
		array_push($teamMemberArr, $userName);
		
		TaskopediaData::setTaskPageData($this->mainTaskId, $taskId, $taskArr);	
	
		return "You have successfully joined the team";
	
	}
	
}

?>