<?php

include_once("EditTopicFormRenderer.php");

$topicId = $_GET["topic_id"];

echo <<<HTML
<html>
<head>
<link rel="stylesheet" type="text/css" href="task_forum.css">
<script src=jquery.js></script>
<script>
$(document).ready(function() {
	$("#edit_topic_done_button").click(function(event) {
		\$button = $(event.target);
		topic_id = \$button.attr("data-topic-id");
		title = $("#title").val();
		content = $("#content").val();
		// Add random number to url so doesn't cache response
		location="edit_topic_submit.php?topic_id="+topic_id+"&title="+title+"&content="+content+"&randnum="+Math.random();
	});
});
</script>
</head>
<body>
HTML;

echo EditTopicFormRenderer::render($topicId);

echo <<<HTML
</body>
</html>
HTML;


?>