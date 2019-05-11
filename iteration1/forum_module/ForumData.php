<?php

include_once("utils/JsonFileHandler.php");

class ForumData {
	
	public static function getTopics($forumFile) {
		return JsonFileHandler::readPhpArray($forumFile);
	}

	public static function setTopics($forumFile, $topics_arr) {
		return JsonFileHandler::writePhpArray($forumFile, $topics_arr);
	}
	
	public static function getTopic($forumFile, $topicId) {
		$topics = self::getTopics($forumFile);
		for ($i=0; $i<count($topics); $i++) {
			$topic = $topics[$i];
			if ($topicId == $topic["topic_id"]) {
				return $topic;
			}
		}
		echo ("Error ForumData::getTopic, no such id: $topicId");
		return null;
	}

	public static function &getTopicRef(&$topics, $topicId) {
		for ($i=0; $i<count($topics); $i++) {
			$topic = &$topics[$i];
			if ($topicId == $topic["topic_id"]) {
				$topicRef = &$topic;
				return $topicRef;
			}
		}
		echo ("Error ForumData::getTopicRef, no such id: $topicId");
		return null;		
	}
	
	public static function &getReplyRef(&$topic, $replyId) {
		$replies = &$topic["replies"];
		for ($i=0; $i<count($replies); $i++) {
			$reply = &$replies[$i];
			if ($replyId == $reply["reply_id"]) {
				$replyRef = &$reply;
				return $replyRef;
			}
		}
		echo ("Error ForumData::getReplyRef, no such id: $replyId");
		return null;		
	}
	
}

?>