<?php

include_once("EditReplyFormRenderer.php");

$topicId = $_GET["topic_id"];
$replyId = $_GET["reply_id"];

echo <<<HTML
<html>
<head>
<link rel="stylesheet" type="text/css" href="task_forum.css">
<script src=jquery.js></script>
<script>
$(document).ready(function() {
	$("#edit_reply_done_button").click(function(event) {
		\$button = $(event.target);
		\$topicId = \$button.attr("data-topic-id");
		\$replyId = \$button.attr("data-reply-id");
		content = $("#content").val();
		location="edit_reply_submit.php?topic_id="+\$topicId+"&reply_id="+\$replyId+"&content="+content;
	});
});
</script>
</head>
<body>
HTML;

echo EditReplyFormRenderer::render($topicId, $replyId);

echo <<<HTML
</body>
</html>
HTML;


?>