<?php

include_once("ForumData.php");
include_once("SkeletonPage.php");

class EditReplyPage extends SkeletonPage {
	
	public $forumFile;
	public $topicId;
	public $replyId;
	
	public function getContent() {
		$html = "";
		
		/*
		$html .= "Forum file: " . $this->forumFile . "<br>";
		$html .= "Topic id: " . $this->topicId . "<br>";
		$html .= "Reply id: " . $this->replyId . "<br>";
		*/
		
		$topics = ForumData::getTopics($this->forumFile);
		$topicRef = ForumData::getTopicRef($topics, $this->topicId);
		$replyRef = ForumData::getReplyRef($topicRef, $this->replyId);
		$html = "";
		$html .= <<<HTML
<div id=edit_reply_form>
Content:<br>
<textarea rows=10 id=content>{$replyRef["content"]}</textarea>
</div><br>
<button id=edit_reply_done_button data-topic-id={$this->topicId} data-reply-id={$this->replyId}>Done</button>
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
	$("#edit_reply_done_button").click(function(event) {
		\$button = $(event.target);
		\$topicId = \$button.attr("data-topic-id");
		\$replyId = \$button.attr("data-reply-id");
		content = $("#content").val();
		location="$mainPagePath?page=forum_edit_reply_submit&forum_file={$this->forumFile}&topic_id="+\$topicId+"&reply_id="+\$replyId+"&content="+content+"&$extraParams";
	});
});
</script>
HTML;
		return $html;
	}
	
}

?>