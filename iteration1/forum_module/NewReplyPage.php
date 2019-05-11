<?php

class NewReplyPage {
	
	public $forumFile;
	public $topicId;
	
	public function getContent() {
		$html = "";
		$html .= <<<HTML
<div id=new_reply_form>
Content:<br>
<textarea rows=10 id=content></textarea>
</div><br>
<button id=new_reply_done_button data-topic-id={$this->topicId}>Done</button>
HTML;
		return $html;
	}
	
	public function getAddToHead() {
		$styleFilePath = ForumConfig::$forumModulePath . "/" . "forum.css";
		$mainPagePath = ForumConfig::$mainPagePath;
		$html = "";
		$html .= <<<HTML
<link rel="stylesheet" type="text/css" href="$styleFilePath">
<script src=jquery.js></script>
<script>
$(document).ready(function() {
	$("#new_reply_done_button").click(function(event) {
		\$button = $(event.target);
		topic_id = \$button.attr("data-topic-id");
		content = $("#content").val();
		// Add random number to url so doesn't cache response
		location="$mainPagePath?page=forum_new_reply_submit&forum_file={$this->forumFile}&topic_id="+topic_id+"&content="+content+"&randnum="+Math.random();
	});
});
</script>
HTML;

		return $html;

	}
	
}

?>