<?php

include_once ("ForumData.php");
include_once ("GuidCreator.php");

class NewTopicSubmitPage {
	
	public $forumFile;
	public $title;
	public $content;
	
	public function getContent() {
		$topics_arr = ForumData::getTopics($this->forumFile);

		$new_topic = array();
		$new_topic["topic_id"] = GuidCreator::create();
		$new_topic["title"] = $this->title;
		$new_topic["user"] = "Simon"; // LoginHandler::loggedInUserName();
		$new_topic["content"] = $this->content;
		$new_topic["date"] = "06 aug 2019";
		$new_topic["views"] = 0;
		$new_topic["replies"] = [];

		array_push($topics_arr, $new_topic);

		ForumData::setTopics($this->forumFile, $topics_arr);
		
		return "Topic added to forum";
	}
	
	public function getAddToHead() {
		return "";
	}
	
}

?>