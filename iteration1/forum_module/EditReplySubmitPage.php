<?php

include_once("ForumData.php");
include_once("SkeletonPage.php");

class EditReplySubmitPage extends SkeletonPage {
	
	public $forumFile;
	public $topicId;
	public $replyId;
	public $content;
	
	public function getContent() {
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
		
		$html .= "Your changes have been submittted<br>";
		return $html;
	}
	
	public function getAddToHead() {
		return "";
	}
	
}

?>