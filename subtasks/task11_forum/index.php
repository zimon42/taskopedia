<?php

include_once("TaskForumData.php");
include_once("TopicListRenderer.php");

echo <<<HTML
<html>
<head>
<link rel="stylesheet" type="text/css" href="task_forum.css">
<script src=jquery.js></script>
<script>
$(document).ready(function() {
	$(".new_topic_button").click(function() {
		location="new_topic.php";
	});
});
</script>

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