<?php

include_once("NewReplyFormRenderer.php");

$topicId = $_GET["topic_id"];

echo <<<HTML
<html>
<head>
<link rel="stylesheet" type="text/css" href="task_forum.css">
<script src=jquery.js></script>
<script>
$(document).ready(function() {
	$("#new_reply_done_button").click(function(event) {
		\$button = $(event.target);
		topic_id = \$button.attr("data-topic-id");
		content = $("#content").val();
		// Add random number to url so doesn't cache response
		location="new_reply_submit.php?topic_id="+topic_id+"&content="+content+"&randnum="+Math.random();
	});
});
</script>
</head>
<body>
HTML;

echo NewReplyFormRenderer::render($topicId);

echo <<<HTML
</body>
</html>
HTML;


?>