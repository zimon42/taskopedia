<?php

include_once ("ViewTopicListPage.php");
include_once ("ViewTopicPage.php");
include_once ("NewTopicPage.php");
include_once ("NewTopicSubmitPage.php");
include_once ("NewReplyPage.php");
include_once ("NewReplySubmitPage.php");

class ForumRequestHandler {
	
	public static function getPage($pageName) {
		
		if ($pageName == "forum_view_topic_list") {
			$page = new ViewTopicListPage();
			$page->forumFile = $_GET["forum_file"];
			return $page;
		}
		if ($pageName == "forum_view_topic") {
			$page = new ViewTopicPage();
			$page->forumFile = $_GET["forum_file"];
			$page->topicId = $_GET["topic_id"];
			return $page;
		}
		if ($pageName == "forum_new_topic") {
			$page = new NewTopicPage();
			$page->forumFile = $_GET["forum_file"];
			return $page;
		}
		if ($pageName == "forum_new_topic_submit") {
			$page = new NewTopicSubmitPage();
			$page->forumFile = $_GET["forum_file"];
			$page->title = $_GET["title"];
			$page->content = $_GET["content"];
			return $page;
		}
		if ($pageName == "forum_new_reply") {
			$page = new NewReplyPage();
			$page->forumFile = $_GET["forum_file"];
			$page->topicId = $_GET["topic_id"];
			return $page;
		}
		if ($pageName == "forum_new_reply_submit") {
			$page = new NewReplySubmitPage();
			$page->forumFile = $_GET["forum_file"];
			$page->topicId = $_GET["topic_id"];
			$page->content = $_GET["content"];	
			return $page;
		}
		return FALSE;
	}
	
}

?>