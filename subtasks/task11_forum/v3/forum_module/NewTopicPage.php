<?php

include_once ("ForumConfig.php");

class NewTopicPage {
	
	public $forumFile;
	
	public function getContent() {
		$html = "";
		$html .= <<<HTML
<div id=new_topic_form>
Title:<br>
<input type=text id=title /><br><br>
Content:<br>
<textarea rows=10 id=content></textarea>
</div><br>
<button id=new_topic_done_button>Done</button>
HTML;
		return $html;
	}
	
	public function getAddToHead() {
		$styleFilePath = ForumConfig::$forumModulePath . "/" . "forum.css";
		$mainPagePath = ForumConfig::$mainPagePath;
		$html = "";
		$html .= <<<HTML
<link rel="stylesheet" type="text/css" href="$styleFilePath">
<script>
$(document).ready(function() {
	$("#new_topic_done_button").click(function() {
		title = $("#title").val();
		content = $("#content").val();
		// Add random number to url so doesn't cache response
		location="$mainPagePath?page=forum_new_topic_submit&forum_file={$this->forumFile}&title="+title+"&content="+content+"&randnum="+Math.random();
	});
});
</script>
HTML;
		return $html;
	}
	
}

?>