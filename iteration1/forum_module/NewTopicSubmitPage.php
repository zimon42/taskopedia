<?php

include_once ("ForumData.php");
include_once ("utils/GuidCreator.php");
include_once ("NewTopicHandler.php");
include_once ("SkeletonPage.php");
include_once ("ForumConfig.php");

class NewTopicSubmitPage extends SkeletonPage {
	
	public $forumFile;
	public $title;
	public $content;
	public $sticky;
	
	public function getContent() {
		$response = NewTopicHandler::addNewTopic(array(
			"forum_file" => $this->forumFile,
			"title" => $this->title,
			"content" => $this->content,
			"sticky" => $this->sticky
		));
		if ($response["status"] == "ok") {
			$html = $response["html"];
			
			ForumConfig::newTopicListener(array(
				"task_type" => $this->taskType,
				"main_task_id" => $this->mainTaskId,
				"task_id" => $this->taskId,
				"topic_id" => $response["topic_id"],
				"title" => $this->title
			));			
			
			return "$html<br>New topic has been added";
		}
				
	}
	
	public function getAddToHead() {
		return "";
	}
	
}

?>