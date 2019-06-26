<?php

include_once("ForumData.php");
include_once("utils/GuidCreator.php");
include_once("DateHandler.php");
include_once("NewReplyHandler.php");
include_once("SkeletonPage.php");
include_once("ForumConfig.php");

class NewReplySubmitPage extends SkeletonPage {
	
	public $forumFile;
	public $topicId;
	public $content;

	public $isOk;
	
	public function preHandle() {
		
		$response = NewReplyHandler::addNewReply(array(
			"forum_file" => $this->forumFile,
			"topic_id" => $this->topicId,
			"content" => $this->content
		));
		if ($response["status"] == "ok") {
			$html = $response["html"];
			// return "Added reply to topic!<br>$html";
			$this->isOk = true;
		}		
		else {
			$this->isOk = false;
		}
		
	}
	
	public function getContent() {
		$html = "";
		$html .= <<<HTML
Your reply was successfully added to the topic!<br><br>
Click the button below to navigate to the topic page, and then scroll down to the bottom of the page to see your newly created reply<br><br>
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