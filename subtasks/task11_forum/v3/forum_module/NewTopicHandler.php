<?php

include_once ("DateHandler.php");

class NewTopicHandler {
	
	public static function addNewTopic($args) {
		
		$forumFile = $args["forum_file"];
		$topicId = isset($args["topic_id"]) ? $args["topic_id"] : GuidCreator::create();
		$title = isset($args["title"]) ? $args["title"] : "No title set";
		$user = isset($args["user"]) ? $args["user"] : "Simon"; // LoginHandler::loggedInUserName();
		$content = isset($args["content"]) ? $args["content"] : "No content set";
		$date = isset($args["date"]) ? $args["date"] : DateHandler::getNowDateString(); // "06 aug 2019";
		
		$html = "";
		$html .= "forumFile: $forumFile<br>";
		$html .= "topicId: $topicId<br>";
		$html .= "title: $title<br>";
		$html .= "user: $user<br>";
		$html .= "content: $content<br>";
		$html .= "date: $date<br>";
		
		$topics_arr = ForumData::getTopics($forumFile);

		$new_topic = array();
		$new_topic["topic_id"] = $topicId;
		$new_topic["title"] = $title;
		$new_topic["user"] = $user; 
		$new_topic["content"] = $content;
		$new_topic["date"] = $date;
		$new_topic["views"] = 0;
		$new_topic["replies"] = [];

		array_push($topics_arr, $new_topic);

		ForumData::setTopics($forumFile, $topics_arr);
		
		return array("status" => "ok", "html" => $html);
	}
	
}

?>