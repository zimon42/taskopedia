<?php

include_once("ForumData.php");

class ViewsUpdater {
	
	public static function update($forumFile, $topicId) {
		
		$topics_arr = ForumData::getTopics($forumFile);
		$topicRef = &ForumData::getTopicRef($topics_arr, $topicId);
		$topicRef["views"]++;
		ForumData::setTopics($forumFile, $topics_arr);
		
	}
	
	public static function test1() {
		self::update("../task_forum.txt", "00000001");
	}
	
}

ViewsUpdater::test1();

?>