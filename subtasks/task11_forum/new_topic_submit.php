<?php

include_once("TaskForumData.php");
include_once("LoginHandler.php");


$title = $_GET["title"];
$content = $_GET["content"];

$topics_arr = TaskForumData::getTopics();

$new_topic = array();
$new_topic["topic_id"] = "00000004";
$new_topic["title"] = $title;
$new_topic["user"] = LoginHandler::loggedInUserName();
$new_topic["content"] = $content;
$new_topic["date"] = "06 aug 2019";
$new_topic["views"] = 0;
$new_topic["replies"] = [];

array_push($topics_arr, $new_topic);

TaskForumData::setTopics($topics_arr);

?>