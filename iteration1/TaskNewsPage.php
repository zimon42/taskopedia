<?php

include_once("SkeletonPage.php");
include_once("TaskopediaData.php");
include_once("TaskNewsData.php");
include_once("forum_module/ForumData.php");

class TaskNewsPage extends SkeletonPage {
	
	// Render events that are in this task's news events file
	public function getContent() {

		$html = "";
	
		$taskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);
		$taskNewsFilePath = TaskopediaData::getTaskNewsFilePath($this->mainTaskId, $taskId);
		
		$eventsArr = TaskNewsData::getEvents($taskNewsFilePath);
		$eventsArr = array_reverse($eventsArr);
		
		for ($i=0; $i<count($eventsArr); $i++) {
			$evArr = $eventsArr[$i];
			$html .= $this->renderEvent($evArr);
		}
		
		return $html;
		
	}
	
	public function renderEvent($evArr) {
		$html = "";
		$html .= "<b>" . $evArr["date_time"] . "</b>:<br> ";
		if ($evArr["type"] == "created_this_task") {
			$html .= $this->renderCreatedThisTaskEvent($evArr);
		} 		
		elseif ($evArr["type"] == "new_subtask") {
			$html .= $this->renderNewSubtaskEvent($evArr);
		} 
		elseif ($evArr["type"] == "new_forum_topic") {
			$html .= $this->renderNewForumTopicEvent($evArr);
		} 
		elseif ($evArr["type"] == "updated_result") {
			$html .= $this->renderUpdatedResultEvent($evArr);
		} 		
		elseif ($evArr["type"] == "changed_title") {
			$html .= $this->renderChangedTitleEvent($evArr);
		} 				
		elseif ($evArr["type"] == "changed_status") {
			$html .= $this->renderChangedStatusEvent($evArr);
		} 						
		elseif ($evArr["type"] == "user_joined") {
			$html .= $this->renderUserJoinedEvent($evArr);
		} 						
		elseif ($evArr["type"] == "user_left") {
			$html .= $this->renderUserLeftEvent($evArr);
		} 						
		elseif ($evArr["type"] == "moved_this_task") {
			$html .= $this->renderMovedThisTaskEvent($evArr);
		} 		
		elseif ($evArr["type"] == "moved_subtask_away") {
			$html .= $this->renderMovedTaskAwayEvent($evArr);
		} 
		elseif ($evArr["type"] == "moved_subtask_here") {
			$html .= $this->renderMovedTaskHereEvent($evArr);
		} 
		else {
			$html .= $this->renderUnknownEvent($evArr);
		}
		$html .= "<br><br>";
		return $html;
	}

	public function renderCreatedThisTaskEvent($evArr) {
		$taskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);
		$taskArr = TaskopediaData::getTaskPageData($this->mainTaskId, $taskId);
		
		return "This task was created with the title '" . $evArr["title"] . "' by user " . $evArr["user"];
	}
	
	public function renderNewSubtaskEvent($evArr) {
		$taskId = TaskopediaData::getTaskPageId("subtask", $this->mainTaskId, $evArr["subtask_id"]);
		$taskArr = TaskopediaData::getTaskPageData($this->mainTaskId, $taskId);
		
		return "New subtask with the title '" . $evArr["title"] . "' was created by user " . $evArr["user"];
	}
	
	public function renderNewForumTopicEvent($evArr) {
		$taskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);
		$taskForumFilePath = TaskopediaData::getTaskForumFilePath($this->mainTaskId, $taskId);		
		$topicArr = ForumData::getTopic($taskForumFilePath, $evArr["topic_id"]);
		
		return "New forum topic with the title '" . $topicArr["title"] . "' was added by user " . $evArr["user"];
	}
	
	public function renderUpdatedResultEvent($evArr) {
		return "The task result was updated by user " . $evArr["user"];
	}

	public function renderChangedTitleEvent($evArr) {
		$taskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);
		$taskArr = TaskopediaData::getTaskPageData($this->mainTaskId, $taskId);
		
		return "The title of this task was changed from '" . $evArr["old_title"] . "' to '" . $evArr["new_title"]. "' by user " . $evArr["user"];
	}
	
	public function renderChangedStatusEvent($evArr) {
		$taskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);
		$taskArr = TaskopediaData::getTaskPageData($this->mainTaskId, $taskId);
		
		return "The task status was changed from '" . $evArr["old_status"] . "' to '" . $evArr["new_status"] . "' by user " . $evArr["user"];
	}

	public function renderUserJoinedEvent($evArr) {
		return "User " . $evArr["user"] . " has joined the task";
	}

	public function renderUserLeftEvent($evArr) {
		return "User " . $evArr["user"] . " has left the task";
	}

	public function renderMovedThisTaskEvent($evArr) {
		return "Moved this task from the old parent titled '" . $evArr["old_parent_title"] . "' to the new parent titled '" . $evArr["new_parent_title"] . "' by user " . $evArr["user"];
	}
	
	public function renderMovedTaskAwayEvent($evArr) {
		// $taskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $evArr["task_id"]);
		// $taskArr = TaskopediaData::getTaskPageData($this->mainTaskId, $taskId);
		
		return "The subtask with the title '" . $evArr["subtask_title"] . "' was moved to the new parent titled '" . $evArr["new_parent_title"] . "' by user " . $evArr["user"];
	}

	public function renderMovedTaskHereEvent($evArr) {
		// $taskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $evArr["task_id"]);
		// $taskArr = TaskopediaData::getTaskPageData($this->mainTaskId, $taskId);
		
		return "The subtask with the title '" . $evArr["subtask_title"] . "' was moved here from the old parent titled '" . $evArr["old_parent_title"] . "' by user " . $evArr["user"];
	}
	
	public function renderUnknownEvent($evArr) {
		return "New event";
	}
	
}

?>