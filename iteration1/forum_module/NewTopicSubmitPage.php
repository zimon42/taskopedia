<?php

include_once ("ForumData.php");
include_once ("utils/GuidCreator.php");
include_once ("NewTopicHandler.php");

class NewTopicSubmitPage {
	
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
			return "$html<br>New topic has been added";
		}
	}
	
	public function getAddToHead() {
		return "";
	}
	
}

?>