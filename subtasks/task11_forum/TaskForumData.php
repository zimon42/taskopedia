<?php

include_once("JsonFileHandler.php");

class TaskForumData {
	
	public static function getTopics() {
		return JsonFileHandler::readPhpArray("task_forum.txt");
	}

	public static function setTopics($topics_arr) {
		return JsonFileHandler::writePhpArray("task_forum.txt", $topics_arr);
	}
	
	public static function getTopic($topicId) {
		$topics = self::getTopics();
		for ($i=0; $i<count($topics); $i++) {
			$topic = $topics[$i];
			if ($topicId == $topic["topic_id"]) {
				return $topic;
			}
		}
		echo ("Error TaskForumData::getTopic, no such id: $topicId");
		return null;
	}

	public static function getTopicRef($topics, $topicId) {
		for ($i=0; $i<count($topics); $i++) {
			$topic = $topics[$i];
			if ($topicId == $topic["topic_id"]) {
				$topicRef = &$topic;
				return $topicRef;
			}
		}
		echo ("Error TaskForumData::getTopicRef, no such id: $topicId");
		return null;		
	}
	
}

?>