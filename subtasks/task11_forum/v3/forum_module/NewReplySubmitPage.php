<?php

include_once("ForumData.php");
include_once("GuidCreator.php");
include_once("DateHandler.php");
include_once("NewReplyHandler.php");

class NewReplySubmitPage {
	
	public $forumFile;
	public $topicId;
	public $content;
	
	public function getContent() {
		
		$response = NewReplyHandler::addNewReply(array(
			"forum_file" => $this->forumFile,
			"topic_id" => $this->topicId,
			"content" => $this->content
		));
		if ($response["status"] == "ok") {
			$html = $response["html"];
			return "Added reply to topic!<br>$html";
		}		
		
	}
	
	public function getAddToHead() {
		return "";
	}
	
}

?>