<?php

include_once("TaskForumData.php");
include_once("TopicListRenderer.php");

echo <<<HTML
<html>
<head>
<link rel="stylesheet" type="text/css" href="task_forum.css">
</head>
<body>
HTML;

$data = TaskForumData::getTopics();

echo TopicListRenderer::render($data);

echo <<<HTML
</body>
</html>
HTML;
?>