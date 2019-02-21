<?php

include_once ("ForumData.php");
include_once ("GuidCreator.php");
include_once ("NewTopicHandler.php");

class NewTopicSubmitPage {
	
	public $forumFile;
	public $title;
	public $content;
	
	public function getContent() {
		$response = NewTopicHandler::addNewTopic(array(
			"forum_file" => $this->forumFile,
			"title" => $this->title,
			"content" => $this->content
		));
		if ($response["status"] == "ok") {
			$html = $response["html"];
			return "$html<br>New topic has been added";
		}
	}
	
	public function getAddToHead() {
		return "";
	}
	
}

?>