<?php

include_once("TaskForumData.php");

$topic_id = $_GET["topic_id"];
$title = $_GET["title"];
$content = $_GET["content"];

$topics_arr = TaskForumData::getTopics();
$topicRef = &TaskForumData::getTopicRef($topics_arr, $topic_id);

$topicRef["title"] = $title;
$topicRef["content"] = $content;

TaskForumData::setTopics($topics_arr);

echo "Your topic has been updated";

?>