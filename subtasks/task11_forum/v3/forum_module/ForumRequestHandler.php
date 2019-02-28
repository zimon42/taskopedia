<?php

include_once ("ViewTopicListPage.php");
include_once ("ViewTopicPage.php");
include_once ("NewTopicPage.php");
include_once ("NewTopicSubmitPage.php");
include_once ("NewReplyPage.php");
include_once ("NewReplySubmitPage.php");
include_once ("EditTopicPage.php");
include_once ("EditTopicSubmitPage.php");
include_once ("EditReplyPage.php");

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
		if ($pageName == "forum_edit_topic") {
			$page = new EditTopicPage();
			$page->forumFile = $_GET["forum_file"];
			$page->topicId = $_GET["topic_id"];
			return $page;
		}
		if ($pageName == "forum_edit_topic_submit") {
			$page = new EditTopicSubmitPage();
			$page->forumFile = $_GET["forum_file"];
			$page->topicId = $_GET["topic_id"];
			$page->title = $_GET["title"];
			$page->content = $_GET["content"];
			return $page;
		}
		if ($pageName == "forum_edit_reply") {
			$page = new EditReplyPage();
			$page->forumFile = $_GET["forum_file"];
			$page->topicId = $_GET["topic_id"];
			$page->replyId = $_GET["reply_id"];
			return $page;
		}
		return FALSE;
	}
	
}

?>