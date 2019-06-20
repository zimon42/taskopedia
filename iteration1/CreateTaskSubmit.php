<?php

// http://localhost/taskopedia/iteration1/index.php?page=create_task_submit&task_type=main_task&main_task_id=00000001&title=&desc=&more_info=

include_once("SkeletonPage.php");
include_once("TaskopediaData.php");
include_once("utils/GuidCreator.php");
include_once("TaskNewsData.php");
include_once("TaskHandler.php");

class CreateTaskSubmit extends SkeletonPage {
	
	public $title;
	public $desc;
	public $moreInfo;

	// These are set in preHandle() and accessed in getAddToHead()
	public $newTaskId;
	public $parentTaskId;
	
	public function preHandle() {
		$newTaskId = GuidCreator::create();
		TaskopediaData::makeTaskPageDir($this->mainTaskId, $newTaskId);
		
		$taskArr = array();
		$taskArr["title"] = $this->title;
		$taskArr["description"] = $this->desc;
		$taskArr["more_info"] = $this->moreInfo;
		$taskArr["status"] = "Work in progress";
		$taskArr["result"] = "";
		$taskArr["team_members"] = array();
		$taskArr["subtasks"] = array();
		$taskArr["worklogs"] = array();
		
		TaskopediaData::setTaskPageData($this->mainTaskId, $newTaskId, $taskArr);
		
		// Update parent task subtask list
		$parentTaskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);
		$parentTaskArr = TaskopediaData::getTaskPageData($this->mainTaskId, $parentTaskId);
		array_push($parentTaskArr["subtasks"], $newTaskId);
		TaskopediaData::setTaskPageData($this->mainTaskId, $parentTaskId, $parentTaskArr);

		// Create task forum file
		TaskopediaData::createTaskForumFile($this->mainTaskId, $newTaskId);
		
		// Create task news file
		TaskopediaData::createTaskNewsFile($this->mainTaskId, $newTaskId);
		
		// Add "created this task" news event
		$evArr = array(
			"type" => "created_this_task",
			"title" => $this->title
		);
		TaskNewsData::addEvent3("subtask", $this->mainTaskId, $newTaskId, $evArr);
		
		// Add "new subtask" news event
		$evArr = array(
			"type" => "new_subtask",
			"subtask_id" => $newTaskId,
			"title" => $this->title
		);
		TaskNewsData::addEvent3($this->taskType, $this->mainTaskId, $this->taskId, $evArr);

		// Set these class variables so they can be accessed in getAddToHead
		$this->newTaskId = $newTaskId;
		$this->parentTaskId = $parentTaskId;
		
	}
	
	public function getContent() {
		
		// Output reply
		$html = "";
		$html .= <<<HTML
This task has been successfully created!<br><br>
<button id=go_to_new_task_button>Go to newly created task</button>
&nbsp;<button id=go_back_to_parent_task_button>Go back to parent task</button>		
HTML;
		return $html;
	}
	
	public function getAddToHead() {
		$newTaskLink = TaskHandler::getLinkToTaskPage($this->mainTaskId, $this->newTaskId);
		$parentTaskLink = TaskHandler::getLinkToTaskPage($this->mainTaskId, $this->parentTaskId);		
		$html = "";
		$html .= <<<HTML
<script>		
$(document).ready(function() {
	$("#go_to_new_task_button").click(function() {
		location = "$newTaskLink";
	});
	$("#go_back_to_parent_task_button").click(function() {
		location = "$parentTaskLink";
	});
});
</script>
HTML;
		return $html;
	}
	
}

?>