<?php

include_once("TaskForumData.php");

$topicId = $_GET["topic_id"];
$replyId = $_GET["reply_id"];
$content = $_GET["content"];

$topics_arr = TaskForumData::getTopics();
$topicRef = &TaskForumData::getTopicRef($topics_arr, $topicId);
$replyRef = &TaskForumData::getReplyRef($topicRef, $replyId);

$replyRef["content"] = $content;

TaskForumData::setTopics($topics_arr);

echo "Your reply has been updated";


?>