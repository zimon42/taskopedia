<?php

include_once("LoginHandler.php");
include_once("TaskForumData.php");

$topicId = $_GET["topic_id"];
$content = $_GET["content"];

$new_reply = array();
$new_reply["reply_id"] = "10000004";
$new_reply["user"] = LoginHandler::loggedInUserName(); 
$new_reply["content"] = $content;
$new_reply["date"] = "06 aug 2019";

// Add reply to topic

$topics_arr = TaskForumData::getTopics();
for ($i=0; $i<count($topics_arr); $i++) {
	$topic = &$topics_arr[$i]; // <-- note using reference
	if ($topicId == $topic["topic_id"]) {
		array_push($topic["replies"], $new_reply);
	}
}
TaskForumData::setTopics($topics_arr);

?>