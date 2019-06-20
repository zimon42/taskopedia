<?php

include_once("SkeletonPage.php");
include_once("login_module/LoginHandler.php");
include_once("TaskNewsData.php");

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

		// Register news event
		TaskNewsData::addEvent3($this->taskType, $this->mainTaskId, $this->taskId, array("type" => "user_joined"));

		$html = "";
		$html .= <<<HTML
You have successfully joined the team<br><br>
<b>Note</b>: you do not have to be a member of a task team to work with the task page. However being member of a task team lets other users see who are currently working on the task page. Also, if you are a member of a task team, those tasks will show up when you click the "Your page" link at the top of the task page.
HTML;
		return $html;
	
	}
	
}

?>