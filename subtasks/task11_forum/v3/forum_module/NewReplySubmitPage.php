<?php

include_once("ForumData.php");
include_once("GuidCreator.php");

class NewReplySubmitPage {
	
	public $forumFile;
	public $topicId;
	public $content;
	
	public function getContent() {
		$new_reply = array();
		$new_reply["reply_id"] = GuidCreator::create();
		$new_reply["user"] = "Simon"; // LoginHandler::loggedInUserName(); 
		$new_reply["content"] = $this->content;
		$new_reply["date"] = "06 aug 2019";

		// Add reply to topic

		$topics_arr = ForumData::getTopics($this->forumFile);
		for ($i=0; $i<count($topics_arr); $i++) {
			$topic = &$topics_arr[$i]; // <-- note using reference
			if ($this->topicId == $topic["topic_id"]) {
				array_push($topic["replies"], $new_reply);
			}
		}
		ForumData::setTopics($this->forumFile, $topics_arr);
		
		return "Added reply to topic";
	}
	
	public function getAddToHead() {
		return "";
	}
	
}

?>