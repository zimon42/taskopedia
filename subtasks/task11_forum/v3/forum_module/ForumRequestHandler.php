<?php

include_once ("ViewTopicListPage.php");
include_once ("ViewTopicPage.php");

class ForumRequestHandler {
	
	public static function getPage($pageName) {
		
		if ($pageName == "forum_view_topic_list") {
			$page = new ViewTopicListPage();
			$page->forumFile = $_GET["forum_file"];
			return $page;
		}
		if ($pageName == "forum_view_topic") {
			return new ViewTopicPage();
		}
		
	}
	
}

?>