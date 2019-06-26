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
	
	public $isOk;
	public $topicId;
	
	public function preHandle() {
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
			
			// return "$html<br>New topic has been added";
			
			$this->isOk = true;
			$this->topicId = $response["topic_id"];
		}
		else {
			$this->isOk = false;
		}
				
	}
	
	public function getContent() {
		$html = "";
		if ($this->isOk) {
			$html .= <<<HTML
New topic has been successfully created!<br><br>	
<button id=go_to_new_topic_button>Go to newly created topic</button>	
HTML;
		}
		else {
			$html .= <<<HTML
An error has occurred, this topic was not added			
HTML;
		}
		return $html;
	}
	
	public function getAddToHead() {
		$path = ForumConfig::$mainPagePath;
		$extraParams = ForumConfig::getExtraParams($this);		
		$html = "";
		$html .= <<<HTML
<script>
$(document).ready(function() {
	$("#go_to_new_topic_button").click(function() {
		location = "$path?page=forum_view_topic&forum_file={$this->forumFile}&topic_id={$this->topicId}&$extraParams";
	});
});
</script>		
HTML;
		return $html;
	}
	
}

?>