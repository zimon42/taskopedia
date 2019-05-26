<?php

// http://localhost/taskopedia/iteration1/index.php?page=main_task_page&main_task_id=00000001
// http://localhost/taskopedia/iteration1/index.php?page=task_page&main_task_id=00000001&task_id=10000002


include_once("SkeletonPage.php");
include_once("TaskopediaData.php");
include_once("TaskHandler.php");
include_once("TaskHierarchy.php");
include_once("login_module/LoginHandler.php");
include_once("TaskopediaDataHelper.php");

class TaskPage extends SkeletonPage {
	
	public function getContent() {
		if ($this->taskType == "main_task") {
			$arr = TaskopediaData::getRootTaskPageData($this->mainTaskId);
		}
		if ($this->taskType == "subtask") {
			$arr = TaskopediaData::getTaskPageData($this->mainTaskId, $this->taskId);
		}
		$title = $arr["title"];
		$description = $arr["description"];
		$more_info = $arr["more_info"];
		$team_members = self::renderTeamMembers($arr);
		$status = $arr["status"];
		$result = $arr["result"];
		$subtasks = self::renderSubtasks($this->mainTaskId, $arr["subtasks"]);
		$work_logs = self::renderWorkLogs($arr["worklogs"]);
		
		if ($this->taskType == "main_task") {
			$task_hierarchy = TaskHierarchy::renderAll($this->mainTaskId);
		}
		if ($this->taskType == "subtask") {
			$task_hierarchy = TaskHierarchy::render($this->taskType, $this->mainTaskId, $this->taskId);
		}
		
		
		$html = "";
		$html .= <<<HTML
<span class=header3>Task: {$title}</span><br><br>
<div class=header_content>
	<span class=header2>Description/Background:</span> {$description}<br><br>
	<span class=header2>More info:</span> {$more_info}<br><br>
	<span class=header2>Task team members:</span> {$team_members}<br><br>
	<span class=header2>Task status:</span> {$status}<br><br>
</div>

<button id=edit_task_button>Edit task info</button>
HTML;
		if ($this->taskType != "main_task") {
			$html .= " <button id=move_this_task_button>Move this task</button>";
		}
		$html .= <<<HTML
<hr>

<span class=header3>Result:</span><br><br>{$result}<br><br>

<button id=edit_result_button>Edit result</button>

<hr>

<span class=header3>Subtasks:</span><br>{$subtasks}

<button id=edit_subtasks_button>Edit subtasks</button>
<button id=create_new_subtask_button>Create new subtask</button>
HTML;
		if ($this->should_show_move_task_here_button()) {
			$html .= " <button id=move_task_here_button>Move task here</button>";
		}
		$html .= <<<HTML
<hr>

<span class=header3>Work logs:</span><br><br> {$work_logs}

<hr>

<span class=header3>Task Hierarchy:</span><br> {$task_hierarchy}
	
HTML;
		return $html;
	}

	public static function renderTeamMembers($taskArr) {
		$teamMemberArr = $taskArr["team_members"];
		$html = "";
		for ($i=0; $i<count($teamMemberArr); $i++) {
			$html .= "<a href=''>" . $teamMemberArr[$i] . "</a>, ";
		}
		// Check if "leave" button should display:
		if (LoginHandler::userIsLoggedIn() && in_array(LoginHandler::loggedInUserName(), $taskArr["team_members"])) {
			$html .= "<button id=leave_team_button>Leave team</button>";
		}
		else {
			$html .= "<button id=join_team_button>Join team</button>";
		}
		return $html;
	}
	
	public static function renderSubtasks($main_task_id, $subtasksArr) {
		$html = "<ul class=subtasks_list>";
		for ($i=0; $i<count($subtasksArr); $i++) {
			$subtaskPageId = $subtasksArr[$i];
			$subtaskPageData = TaskopediaData::getTaskPageData($main_task_id, $subtaskPageId);
			$subtaskTitle = $subtaskPageData["title"];
			$html .= "<li><a href='index.php?page=task_page&task_type=subtask&main_task_id=".$main_task_id."&task_id=".$subtaskPageId."'>" . $subtaskTitle . "</a></li>";
		}
		$html .= "</ul>";
		return $html;
	}

	public static function renderWorkLogs($workLogArr) {
		$isLoggedIn = LoginHandler::userIsLoggedIn();
		$loggedInUserName = LoginHandler::loggedInUserName();
		$html = "";
		for ($i=0; $i<count($workLogArr); $i++) {
			$workLog = $workLogArr[$i];
			$name = $workLog["name"];
			$content = $workLog["content"];
			$html .= "<b>$name</b>: " . $content;
			$html .= "<br>";
			// Add edit worklog button
			if ($isLoggedIn && $name == $loggedInUserName) {
				$html .= "<br><button id=edit_worklog_button data-user_name='$name'>Edit your worklog</button><br><br>";
			}			
		}
		return $html;
	}
	
	/*
	public static function renderWorkLogs($workLogArr) {
		$isLoggedIn = LoginHandler::userIsLoggedIn();
		$loggedInUserName = LoginHandler::loggedInUserName();
		$html = "";
		for ($i=0; $i<count($workLogArr); $i++) {
			$workLog = $workLogArr[$i];
			foreach ($workLog as $key => $value) {
				$name = $key;
				$content = $value;
				$html .= "<b>$name</b>: " . $content;
			}
			$html .= "<br>";
			// Add edit worklog button
			if ($isLoggedIn && $name == $loggedInUserName) {
				$html .= "<br><button>Edit your worklog</button><br><br>";
			}
		}
		return $html;
	}
	*/
	
	public function should_show_move_task_here_button() {
		if (isset($_SESSION["task_clipboard"])) {
			$move_this_task_main_task_id = $_SESSION["task_clipboard_main_task_id"];
			$move_this_task_task_id = $_SESSION["task_clipboard_task_id"];
			$move_to_task_main_task_id = $this->mainTaskId;
			$move_to_task_task_id = $this->taskId;
			
			// Case 1: At the moment moving tasks between different main tasks, not allowed
			if ($move_this_task_main_task_id != $move_to_task_main_task_id) {
				return FALSE;
			}
			
			// Case 2: Move a task to its subtasks, not allowed
			if ($move_this_task_main_task_id == $move_to_task_main_task_id &&
				$move_this_task_task_id == $move_to_task_task_id) {
				return FALSE;
			}
			
			// Case 3: Move a task to a decendant task, not allowed
			
			
			return TRUE;
		}
		return FALSE;
	}		
	
	public function getAddToHead() {
		$taskParams = TaskHandler::getTaskParams($this);
		$isLoggedInBoolVal = LoginHandler::userIsLoggedIn() ? "true" : "false";
		$loggedInUserName = LoginHandler::loggedInUserName();
		$html = "";
		$html .= <<<HTML
<link rel=stylesheet type=text/css href=task_page.css>
<script src=resource_locker_module/ResourceLocker.js></script>
<script>
var userIsLoggedIn = $isLoggedInBoolVal;
var loggedInUserName = "$loggedInUserName";
$(document).ready(function() {
	$("#edit_subtasks_button").click(function() {
		if (userIsLoggedIn) {
			ResourceLocker.editButtonClickHandler(
			{
				res_id: "maintask_{$this->mainTaskId}_subtask_{$this->taskId}_subtasks",
				user_name: loggedInUserName,
				edit_page: "index.php?page=edit_subtasks_page&$taskParams"
			}
			);			
		}
		else {
			alert("You have to be logged in to edit subtasks. Click the login link in the top of this page");
		}				
	});
	$("#create_new_subtask_button").click(function() {
		// location="index.php?page=create_task_page&$taskParams";
		if (userIsLoggedIn) {
			// alert("Logged in");
			ResourceLocker.editButtonClickHandler(
			{
				res_id: "maintask_{$this->mainTaskId}_subtask_{$this->taskId}_subtasks",
				user_name: loggedInUserName,
				edit_page: "index.php?page=create_task_page&$taskParams"
			}
			);			
		}
		else {
			alert("You have to be logged in to create a new subtask. Click the login link in the top of this page");
		}		
	});
	$("#edit_result_button").click(function() {
		if (userIsLoggedIn) {
			// alert("Logged in");
			ResourceLocker.editButtonClickHandler(
			{
				res_id: "maintask_{$this->mainTaskId}_subtask_{$this->taskId}_result",
				user_name: loggedInUserName,
				edit_page: "index.php?page=edit_result_page&$taskParams"
			}
			);			
		}
		else {
			alert("You have to be logged in to edit the result. Click the login link in the top of this page");
		}
	});
	$("#edit_task_button").click(function() {
		if (userIsLoggedIn) {
			ResourceLocker.editButtonClickHandler(
			{
				res_id: "maintask_{$this->mainTaskId}_subtask_{$this->taskId}_taskinfo",
				user_name: loggedInUserName,
				edit_page: "index.php?page=edit_taskinfo_page&$taskParams"
			}
			);						
		}
	});
	$("#move_this_task_button").click(function() {
		if (userIsLoggedIn) {
			$.post(
			"index.php?page=move_this_task_submit&$taskParams",
			{
			},
			function (data, status) {
				console.log(data);
				alert("This task has now been placed in the task clipboard. To move this task to a another task, go to that task, scroll down to the \"subtasks\" section, and click the \"move task here\" button");
			}
			);
		}
		else {
			alert("You need to be logged in to move this task. Click the login link at the top of this page");
		}
	});	
	$("#edit_worklog_button").click(function() {
		var user_name = $(this).attr("data-user_name");
		if (userIsLoggedIn) {
			// alert("Logged in");
			ResourceLocker.editButtonClickHandler(
			{
				res_id: "maintask_{$this->mainTaskId}_subtask_{$this->taskId}_username_"+user_name+"_worklog",
				user_name: loggedInUserName,
				edit_page: "index.php?page=edit_worklog_page&user_name="+user_name+"&$taskParams"
			}
			);			
		}
		else {
			alert("Error: You have clicked the 'Edit your worklog' button, but you don't seem to be logged in");
		}
	});	
	$("#join_team_button").click(function() {
		if (userIsLoggedIn) {
			location="index.php?page=join_team_submit&$taskParams";
		}
		else {
			alert("You need to be logged in to join the team. You can login by clicking the link at the top of this page");
		}
	});
	$("#leave_team_button").click(function() {
		location="index.php?page=leave_team_submit&$taskParams";
	});
	
});
</script>
HTML;
		return $html;
	}
	
}

?>