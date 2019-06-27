<?php

include_once("ForumData.php");
include_once("SkeletonPage.php");
include_once("ForumConfig.php");

class EditTopicSubmitPage extends SkeletonPage {
	
	public $forumFile;
	public $topicId;
	public $title;
	public $content;
	public $sticky;
	
	public function preHandle() {
		
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
		
		// $html .= "Edited topic";
		// return $html;
	}
	
	public function getContent() {
		$html = "";
		$html .= <<<HTML
Your topic was successfully edited!<br><br>
<button id=go_to_edited_topic_button>Go to newly edited topic</button>		
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
	$("#go_to_edited_topic_button").click(function() {
		location = "$path?page=forum_view_topic&forum_file={$this->forumFile}&topic_id={$this->topicId}&$extraParams";
	});
});
</script>		
HTML;
		return $html;
	}
	
}

?>