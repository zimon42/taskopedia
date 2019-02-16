<?php

$forumFile = $_GET["forum_file"];
$skeletonPageFile = $_GET["skeleton_page"];

include_once("FileHandler.php");
include_once($skeletonPageFile);

SkeletonPage::addToHead("<link rel=\"stylesheet\" type=\"text/css\" href=\"task_forum.css\">");
$script = <<<HTML
<script>
$(document).ready(function() {
	alert("Ready");
});
</script>
HTML;
SkeletonPage::addToHead($script);


SkeletonPage::setContent("Hello world");

echo SkeletonPage::render();

/*
echo "<pre>";
echo FileHandler::readStringFromFile($forumFile);
echo "</pre>";
*/
?>