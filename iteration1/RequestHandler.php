<?php

include_once("MainPage.php");
include_once("TaskPage.php");
include_once("TaskHandler.php");
include_once("CreateTaskPage.php");
include_once("CreateTaskSubmit.php");
include_once("EditResultPage.php");
include_once("SaveResultSubmit.php");
include_once("EditTaskinfoPage.php");
include_once("SaveTaskinfoSubmit.php");
include_once("EditWorklogPage.php");
include_once("SaveWorklogSubmit.php");
include_once("JoinTeamSubmit.php");
include_once("LeaveTeamSubmit.php");
include_once("EditSubtasksPage.php");
include_once("SaveSubtasksSubmit.php");
include_once("MoveThisTaskSubmit.php");
include_once("MoveTaskHereSubmit.php");
include_once("YourPage.php");
include_once("login_module/LoginHandler.php");
include_once("login_module/LoginPage.php");

class RequestHandler {
	
	public static function getPage($pageName) {
		
		if ($pageName == "main_page") {
			$page = new MainPage();
			return $page;
		}
		if ($pageName == "main_task_page") {
			$page = new TaskPage();
			$page->taskType = "main_task";
			$page->mainTaskId = $_GET["main_task_id"];
			return $page;
		}				
		if ($pageName == "task_page") {
			$page = new TaskPage();
			$page->taskType = "subtask";
			$page->mainTaskId = $_GET["main_task_id"];
			$page->taskId = $_GET["task_id"];
			return $page;
		}	
		if ($pageName == "create_task_page") {
			$page = new CreateTaskPage();
			TaskHandler::setTaskParams($page);
			return $page;
		}
		if ($pageName == "create_task_submit") {
			$page = new CreateTaskSubmit();
			TaskHandler::setTaskParams($page);
			$page->title = $_GET["title"];
			$page->desc = $_GET["desc"];
			$page->moreInfo = $_GET["more_info"];
			$page->handle();
			return $page;
		}
		if ($pageName == "edit_result_page") {
			$page = new EditResultPage();
			TaskHandler::setTaskParams($page);
			return $page;
		}
		if ($pageName == "save_result_submit") {
			$page = new SaveResultSubmit();
			TaskHandler::setTaskParams($page);
			return $page;
		}
		if ($pageName == "edit_taskinfo_page") {
			$page = new EditTaskinfoPage();
			TaskHandler::setTaskParams($page);
			return $page;
		}
		if ($pageName == "save_taskinfo_submit") {
			$page = new SaveTaskinfoSubmit();
			TaskHandler::setTaskParams($page);
			return $page;
		}
		if ($pageName == "edit_worklog_page") {
			$page = new EditWorklogPage();
			$page->userName = $_GET["user_name"];
			TaskHandler::setTaskParams($page);
			return $page;
		}
		if ($pageName == "save_worklog_submit") {
			$page = new SaveWorklogSubmit();
			$page->userName = $_GET["user_name"];
			TaskHandler::setTaskParams($page);
			return $page;
		}
		if ($pageName == "join_team_submit") {
			$page = new JoinTeamSubmit();
			TaskHandler::setTaskParams($page);
			return $page;
		}		
		if ($pageName == "leave_team_submit") {
			$page = new LeaveTeamSubmit();
			TaskHandler::setTaskParams($page);
			return $page;
		}		
		if ($pageName == "edit_subtasks_page") {
			$page = new EditSubtasksPage();
			TaskHandler::setTaskParams($page);
			return $page;
		}		
		if ($pageName == "save_subtasks_submit") {
			$page = new SaveSubtasksSubmit();
			TaskHandler::setTaskParams($page);
			return $page;
		}		
		if ($pageName == "move_this_task_submit") {
			$page = new MoveThisTaskSubmit();
			TaskHandler::setTaskParams($page);
			return $page;
		}
		if ($pageName == "move_task_here_submit") {
			$page = new MoveTaskHereSubmit();
			TaskHandler::setTaskParams($page);
			return $page;
		}
		if ($pageName == "your_page") {
			if (LoginHandler::userIsLoggedIn()) {
				$page = new YourPage();
				TaskHandler::setTaskParams($page);
				return $page;			
			}
			else {
				$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				$_SESSION["navigate_to_url_after_login"] = $actual_link;				
				$page = new LoginPage();	
				TaskHandler::setTaskParams($page);
				return $page;							
			}
		}
		return FALSE;
	}
	
}

?>