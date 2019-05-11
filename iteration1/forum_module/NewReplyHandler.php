<?php

include_once("utils/GuidCreator.php");
include_once("DateHandler.php");
include_once("ForumData.php");

class NewReplyHandler {
	
	public static function addNewReply($args) {
				
		$forumFile = $args["forum_file"];
		$topicId = $args["topic_id"];
		$replyId = isset($args["reply_Id"]) ? $args["reply_id"] : GuidCreator::create();
		$user = isset($args["user"]) ? $args["user"] : "Simon";
		$content = $args["content"];
		$date = isset($args["date"]) ? $args["date"] : DateHandler::getNowDateTimeString();
		
		$html = "";
		$html .= "forumFile: $forumFile<br>";
		$html .= "topicId: $topicId<br>";
		$html .= "replyId: $replyId<br>";
		$html .= "user: $user<br>";
		$html .= "content: $content<br>";
		$html .= "date: $date<br>";
		
		$new_reply = array();
		$new_reply["reply_id"] = $replyId;
		$new_reply["user"] = $user; // LoginHandler::loggedInUserName(); 
		$new_reply["content"] = $content;
		$new_reply["date"] = $date;

		// Add reply to topic

		$topics_arr = ForumData::getTopics($forumFile);
		for ($i=0; $i<count($topics_arr); $i++) {
			$topic = &$topics_arr[$i]; // <-- note using reference
			if ($topicId == $topic["topic_id"]) {
				array_push($topic["replies"], $new_reply);
			}
		}
		ForumData::setTopics($forumFile, $topics_arr);
	
		return array("status" => "ok", "html" => $html);	
	
	}
	
}

?>