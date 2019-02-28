<?php

include_once("ForumData.php");

class EditTopicSubmitPage {
	
	public $forumFile;
	public $topicId;
	public $title;
	public $content;
	
	public function getContent() {
		
		$html = "";
		$html .= "Forum file: " . $this->forumFile . "<br>";
		$html .= "Topic id: " . $this->topicId . "<br>";
		$html .= "Title: " . $this->title . "<br>";
		$html .= "Content: " . $this->content . "<br>";
		
		$topics_arr = ForumData::getTopics($this->forumFile);
		$topicRef = &ForumData::getTopicRef($topics_arr, $this->topicId);

		$topicRef["title"] = $this->title;
		$topicRef["content"] = $this->content;

		ForumData::setTopics($this->forumFile, $topics_arr);		
		
		$html .= "Edited topic";
		return $html;
	}
	public function getAddToHead() {
		return "";
	}
}

?>