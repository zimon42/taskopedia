<?php

include_once ("TaskopediaData.php");
include_once ("utils/JsonFileHandler.php");
include_once ("login_module/LoginHandler.php");
include_once ("TaskHandler.php");

class SkeletonPage extends Page {

	public $isSkeletonPage = true;

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
<link rel=stylesheet type=text/css href=skeleton_page.css>
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
		$mainTaskInfo = "<a id=main_task_info href='index.php?page=main_task_page&main_task_id=".$this->mainTaskId."'>Main task: " . $rootTask["title"] . "</a>";
		
		if ($this->taskType == "subtask") {
			$subtask = TaskopediaData::getTaskPageData($this->mainTaskId, $this->taskId);
			$subtaskInfo = "<br><a id=subtask_info href='index.php?page=task_page&main_task_id=".$this->mainTaskId."&task_id=".$this->taskId."'>Subtask: " . $subtask["title"] . "</a>";
		}
		
		if (LoginHandler::userIsLoggedIn()) {
			$loginInfo .= "Logged in as " . LoginHandler::loggedInUserName() . ", ";
			$loginInfo .= "<a href=index.php?page=login_logout&" . TaskHandler::getTaskParams($this) . ">Logout</a> ";
		} else {
			$loginInfo .= "Not logged in, ";
			$loginInfo .= "<a href=index.php?page=login_form&" . TaskHandler::getTaskParams($this) . ">Login</a> ";			
		}

		$loginInfo .= "<a href=index.php?page=your_page&" . TaskHandler::getTaskParams($this) . ">Your page</a>";
		
		$taskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);
		$taskForumFilePath = TaskopediaData::getTaskForumFilePath($this->mainTaskId, $taskId);
		
		$moreLinks = "";
		
		if ($this->taskType == "main_task") {
			$moreLinks .= "<a href=index.php?page=main_task_page&" . TaskHandler::getTaskParams($this) . ">Task page</a> ";
		}
		if ($this->taskType == "subtask") {
			$moreLinks .= "<a href=index.php?page=task_page&" . TaskHandler::getTaskParams($this) . ">Task page</a> ";
		}		
		$moreLinks .= "<a href=index.php?page=forum_view_topic_list&forum_file=$taskForumFilePath&" . TaskHandler::getTaskParams($this) . ">Task forum</a> ";
		$moreLinks .= "<a href=index.php?page=task_news_page&" . TaskHandler::getTaskParams($this) . ">Task news</a> ";
		
		
		$html = "";
		$html .= <<<HTML
<div id=top_panel>
	<img src=puzzle_piece.png width=30 />
	<a id=taskopedia_title href=index.php>Taskopedia</a><br>
	$mainTaskInfo
	$subtaskInfo
	<br>$loginInfo
	<br>$moreLinks
</div>		
HTML;
		return $html;
	}
	
}

?>