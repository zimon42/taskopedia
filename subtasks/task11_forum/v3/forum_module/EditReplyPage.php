<?php

include_once("ForumData.php");

class EditReplyPage {
	
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
		return "";
	}
	
}

?>