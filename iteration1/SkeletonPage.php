<?php

include_once ("TaskopediaData.php");
include_once ("utils/JsonFileHandler.php");
include_once ("login_module/LoginHandler.php");

class SkeletonPage extends Page {

	public $taskType;
	public $mainTaskId;
	public $taskId;

	public function getContent() {}
	
	public function getAddToHead() {}
	
	public function getWhole() {
		$content = $this->getContent();
		$addToHead = $this->getAddToHead();
		$top = $this->getTop();
		$html = "";
		$html .= <<<HTML
<!DOCTYPE html>
<html>
<head>
<link rel=\"stylesheet\" type=\"text/css\" href=\"skeleton_page.css\">
<script src=jquery.js></script>
$addToHead
</head>
<body>
$top
<hr>
$content
<hr>
Bottom bar
</body>
</html>		
HTML;
		return $html;
	}
	
	public function getTop() {
		
		$mainTaskInfo = "";
		$subtaskInfo = "";
		$loginInfo = "";
		
		$rootTask = TaskopediaData::getRootTaskPageData($this->mainTaskId);
		$mainTaskInfo = "Main task: " . $rootTask["title"];
		
		if ($this->taskType == "subtask") {
			$subtask = TaskopediaData::getTaskPageData($this->mainTaskId, $this->taskId);
			$subtaskInfo = "<br>Subtask: " . $subtask["title"];
		}
		
		if (LoginHandler::userIsLoggedIn()) {
			$loginInfo .= "Logged in as " . LoginHandler::loggedInUserName() . ", ";
			$loginInfo .= "<a href=index.php?page=login_logout>Logout</a> ";
		} else {
			$loginInfo .= "Not logged in, ";
			$loginInfo .= "<a href=index.php?page=login_form>Login</a> ";			
		}

		
		$html = "";
		$html .= <<<HTML
<div id=top_panel>
	<img src=puzzle_piece.png width=30 />
	<span id=taskopedia_title>Taskopedia</span><br>
	$mainTaskInfo
	$subtaskInfo
	<br>$loginInfo
</div>		
HTML;
		return $html;
	}
	
}

?>