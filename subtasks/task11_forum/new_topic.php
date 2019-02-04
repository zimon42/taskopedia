<?php

include_once("NewTopicFormRenderer.php");

echo <<<HTML
<html>
<head>
<link rel="stylesheet" type="text/css" href="task_forum.css">
<script src=jquery.js></script>
<script>
$(document).ready(function() {
	$("#new_topic_done_button").click(function() {
		title = $("#title").val();
		content = $("#content").val();
		// Add random number to url so doesn't cache response
		location="new_topic_submit.php?title="+title+"&content="+content+"&randnum="+Math.random();
	});
});
</script>
</head>
<body>
HTML;

echo NewTopicFormRenderer::render();

echo <<<HTML
</body>
</html>
HTML;

?>