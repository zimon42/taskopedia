<?php

include_once("TaskForumData.php");

class EditReplyFormRenderer {
	
	public static function render($topicId, $replyId) {
		$topics = TaskForumData::getTopics();
		$topicRef = TaskForumData::getTopicRef($topics, $topicId);
		$replyRef = TaskForumData::getReplyRef($topicRef, $replyId);
		$html = "";
		$html .= <<<HTML
<div id=edit_reply_form>
Content:<br>
<textarea rows=10 id=content>{$replyRef["content"]}</textarea>
</div><br>
<button id=edit_reply_done_button data-topic-id={$topicId} data-reply-id={$replyId}>Done</button>
HTML;
		return $html;
	}
	
}

?>