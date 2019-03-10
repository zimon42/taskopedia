<?php

include_once("ForumData.php");

class EditTopicSubmitPage {
	
	public $forumFile;
	public $topicId;
	public $title;
	public $content;
	public $sticky;
	
	public function getContent() {
		
		$html = "";
		$html .= "Forum file: " . $this->forumFile . "<br>";
		$html .= "Topic id: " . $this->topicId . "<br>";
		$html .= "Title: " . $this->title . "<br>";
		$html .= "Content: " . $this->content . "<br>";
		$html .= "Sticky: " . $this->sticky . "<br>";
		
		$topics_arr = ForumData::getTopics($this->forumFile);
		$topicRef = &ForumData::getTopicRef($topics_arr, $this->topicId);

		$topicRef["title"] = $this->title;
		$topicRef["content"] = $this->content;
		$topicRef["sticky"] = $this->sticky;
		
		ForumData::setTopics($this->forumFile, $topics_arr);		
		
		$html .= "Edited topic";
		return $html;
	}
	public function getAddToHead() {
		return "";
	}
}

?>