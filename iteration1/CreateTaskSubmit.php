<?php

// http://localhost/taskopedia/iteration1/index.php?page=create_task_submit&task_type=main_task&main_task_id=00000001&title=&desc=&more_info=

include_once("SkeletonPage.php");
include_once("TaskopediaData.php");
include_once("utils/GuidCreator.php");
include_once("TaskNewsData.php");

class CreateTaskSubmit extends SkeletonPage {
	
	public $title;
	public $desc;
	public $moreInfo;
	
	public function handle() {
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
		
	}
	
	public function getContent() {
		return "This task has been successfully created!";
	}
	
}

?>