<?php

include_once("SkeletonPage.php");
include_once("TaskopediaData.php");
include_once("TaskNewsData.php");
include_once("forum_module/ForumData.php");

class TaskNewsPage extends SkeletonPage {
	
	public function getContent() {

		$html = "";
	
		$taskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);
		$taskNewsFilePath = TaskopediaData::getTaskNewsFilePath($this->mainTaskId, $taskId);
		
		$eventsArr = TaskNewsData::getEvents($taskNewsFilePath);
		
		for ($i=0; $i<count($eventsArr); $i++) {
			$evArr = $eventsArr[$i];
			$html .= $this->renderEvent($evArr);
		}
		
		return $html;
		
	}
	
	public function renderEvent($evArr) {
		$html = "";
		$html .= "<b>" . $evArr["date_time"] . "</b>:<br> ";
		if ($evArr["type"] == "new_subtask") {
			$html .= $this->renderNewSubtaskEvent($evArr);
		} 
		elseif ($evArr["type"] == "new_forum_topic") {
			$html .= $this->renderNewForumTopicEvent($evArr);
		} 		
		else {
			$html .= $this->renderUnknownEvent($evArr);
		}
		$html .= "<br><br>";
		return $html;
	}
	
	public function renderNewSubtaskEvent($evArr) {
		$taskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $evArr["subtask_id"]);
		$taskArr = TaskopediaData::getTaskPageData($this->mainTaskId, $taskId);
		
		return "New subtask with the title '" . $taskArr["title"] . "' was created by user " . $evArr["user"];
	}
	
	public function renderNewForumTopicEvent($evArr) {
		$taskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);
		$taskForumFilePath = TaskopediaData::getTaskForumFilePath($this->mainTaskId, $taskId);		
		$topicArr = ForumData::getTopic($taskForumFilePath, $evArr["topic_id"]);
		
		return "New forum topic with the title '" . $topicArr["title"] . "' was added by user " . $evArr["user"];
	}
	
	public function renderUnknownEvent($evArr) {
		return "New event";
	}
	
}

?>