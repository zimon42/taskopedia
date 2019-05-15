<?php

include_once("ForumConfig.php");
include_once("ForumData.php");
include_once("SkeletonPage.php");

class EditTopicPage extends SkeletonPage {
	
	public $forumFile;
	public $topicId;
	
	public function getContent() {
		$topic = ForumData::getTopic($this->forumFile, $this->topicId);
		$stickyCheckedHtml = isset($topic["sticky"]) && $topic["sticky"] ? "checked" : "";
		$html = "";
		$html .= <<<HTML
<div id=new_topic_form>
Title:<br>
<input type=text id=title value="{$topic["title"]}"/><br><br>
Content:<br>
<textarea rows=10 id=content>{$topic["content"]}</textarea><br><br>
<input type=checkbox id=sticky {$stickyCheckedHtml}>Sticky
</div><br>
<button id=edit_topic_done_button data-topic-id={$this->topicId}>Done</button>
HTML;
		return $html;
	}
	
	public function getAddToHead() {
		$styleFilePath = ForumConfig::$forumModulePath . "/" . "forum.css";
		$mainPagePath = ForumConfig::$mainPagePath;
		$extraParams = ForumConfig::getExtraParams($this);
		$html = "";
		$html .= <<<HTML
<link rel="stylesheet" type="text/css" href="$styleFilePath">
<script>
$(document).ready(function() {
	$("#edit_topic_done_button").click(function(event) {
		\$button = $(event.target);
		topic_id = \$button.attr("data-topic-id");
		title = $("#title").val();
		content = $("#content").val();
		sticky = $('#sticky').is(":checked");
		// Add random number to url so doesn't cache response
		location="$mainPagePath?page=forum_edit_topic_submit&forum_file={$this->forumFile}&topic_id="+topic_id+"&title="+title+"&content="+content+"&sticky="+sticky+"&$extraParams&randnum="+Math.random();
	});
});
</script>
HTML;
		return $html;
	}
	
}

?>