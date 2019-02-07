<?php

include_once("EditTopicFormRenderer.php");

$topicId = $_GET["topic_id"];

echo <<<HTML
<html>
<head>
<link rel="stylesheet" type="text/css" href="task_forum.css">
<script src=jquery.js></script>
<script>
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