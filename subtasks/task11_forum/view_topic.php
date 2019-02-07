<?php

include_once("TaskForumData.php");
include_once("TopicRenderer.php");

echo <<<HTML
<html>
<head>
<link rel="stylesheet" type="text/css" href="task_forum.css">
<script src=jquery.js></script>
<script>
$(document).ready(function() {
	$(".edit_post_button").click(function(event) {
		\$button = $(event.target);
		\$topic_id = \$button.attr("data-topic-id");
		\$post_id = \$button.attr("data-post-id");
		\$post_index = \$button.attr("data-post-index");
		if (\$post_index == 0) {
			location="edit_topic?topic_id="+\$topic_id;
		}
		else {
			location="edit_reply?topic_id="+\$topic_id+"&reply_id="+\$post_id;
		}
	});
	$(".new_reply_button").click(function(event) {
		\$button = $(event.target);
		\$topic_id = \$button.attr("data-topic-id");
		location="new_reply?topic_id="+\$topic_id;
	});
});
</script>
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