<?php

include_once("ForumData.php");
include_once("SkeletonPage.php");
include_once("ForumConfig.php");

class EditReplySubmitPage extends SkeletonPage {
	
	public $forumFile;
	public $topicId;
	public $replyId;
	public $content;
	
	public function preHandle() {
		$html = "";
		$html .= "Forum file: " . $this->forumFile . "<br>";
		$html .= "Topic id: " . $this->topicId . "<br>";
		$html .= "Reply id: " . $this->replyId . "<br>";
		$html .= "Content: " . $this->content . "<br>";
		
		$topics_arr = ForumData::getTopics($this->forumFile);
		$topicRef = &ForumData::getTopicRef($topics_arr, $this->topicId);
		$replyRef = &ForumData::getReplyRef($topicRef, $this->replyId);

		$replyRef["content"] = $this->content;

		ForumData::setTopics($this->forumFile, $topics_arr);		
		
		// $html .= "Your changes have been submittted<br>";
		// return $html;
	}
	
	public function getContent() {
		$html = "";
		$html .= <<<HTML
Your reply was successfully edited!<br><br>
To view your newly edited reply, click the button below, and then scroll down the page to your reply<br><br>
<button id=go_to_topic_button>Go to topic</button>		
HTML;
		return $html;
	}
	
	public function getAddToHead() {
		$path = ForumConfig::$mainPagePath;
		$extraParams = ForumConfig::getExtraParams($this);		
		$html = "";
		$html .= <<<HTML
<script>
$(document).ready(function() {
	$("#go_to_topic_button").click(function() {
		location = "$path?page=forum_view_topic&forum_file={$this->forumFile}&topic_id={$this->topicId}&$extraParams";
	});
});
</script>		
HTML;
		return $html;
	}
	
}

?>