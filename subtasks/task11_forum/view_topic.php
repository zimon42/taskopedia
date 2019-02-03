<?php

include_once("TaskForumData.php");
include_once("TopicRenderer.php");

echo <<<HTML
<html>
<head>
<link rel="stylesheet" type="text/css" href="task_forum.css">
</head>
<body>
HTML;

$topic_id = $_GET["topic_id"];
$topic = TaskForumData::getTopic($topic_id);

echo TopicRenderer::render($topic);

echo <<<HTML
</body>
</html>
HTML;

?>