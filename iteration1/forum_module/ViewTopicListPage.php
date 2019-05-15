<?php

include_once("ForumConfig.php");
include_once("ForumData.php");
include_once("TopicSorter.php");
include_once("SkeletonPage.php");
include_once("login_module/LoginHandler.php");

class ViewTopicListPage extends SkeletonPage {
	
	public $forumFile;
	
	public function getContent() {
		$topics = ForumData::getTopics($this->forumFile);
		
		// TopicSorter::sort($topics);
		TopicSorter::sortIncludingStickies($topics);
		
		$html = "";
		$html .= "<h3>Forum</h3>";

		$html .= "<button class=new_topic_button>New Topic</button><br><br>";
		
		$html .= "<table id=topics_table cellspacing=0>";
		$html .= $this->renderHeaderRow();
		
		// Render topic rows
		for ($i=0; $i<count($topics); $i++) {
			$html .= $this->renderTopicRow($topics[$i]);
		}
		
		$html .= "</table>";

		$html .= "<br><button class=new_topic_button>New Topic</button><br>";
		
		return $html;

	}

	public function renderHeaderRow() {
		return <<<HTML
<tr class=header_row>
	<td>Topic</td>
	<td>User</td>
	<td>Vi.</td>
	<td>Re.</td>
	<td>Date</td>
</tr>
HTML;
	}
	
	public function renderTopicRow($topic) {
		$path = ForumConfig::$mainPagePath;
		$numReplies = $this->getNumReplies($topic);
		$stickyImgPath = ForumConfig::$forumModulePath . "/" . "sticky.png";
		$stickyHtml = isset($topic["sticky"]) && $topic["sticky"] ? "<img src='{$stickyImgPath}' class=sticky_img align=top />" : "";
		$extraParams = ForumConfig::getExtraParams($this);
		return <<<HTML
<tr class=topic_row>
	<td class=topic_title>
	{$stickyHtml}<a href=$path?page=forum_view_topic&forum_file={$this->forumFile}&topic_id={$topic["topic_id"]}&$extraParams>
			{$topic["title"]}
		</a>
	</td>
	<td>{$topic["user"]}</td>
	<td>{$topic["views"]}</td>
	<td>{$numReplies}</td>
	<td>{$topic["date"]}</td>
</tr>
HTML;
	}

	public function getNumReplies($topic) {
		return count($topic["replies"]);
	}
	
	public function getAddToHead() {
		$html = "";
		$styleFilePath = ForumConfig::$forumModulePath . "/" . "forum.css";
		$mainPagePath = ForumConfig::$mainPagePath;
		$extraParams = ForumConfig::getExtraParams($this);
		$isLoggedInBoolVal = LoginHandler::userIsLoggedIn() ? "true" : "false";
		$html .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"$styleFilePath\">\n";
		$html .= <<<HTML
<script>
var userIsLoggedIn = $isLoggedInBoolVal;
$(document).ready(function() {
	$(".new_topic_button").click(function() {
		if (userIsLoggedIn) {
			location="{$mainPagePath}?page=forum_new_topic&forum_file={$this->forumFile}&$extraParams";
		}
		else {
			alert("You have to be logged in to post a new topic. Click the login link at the top of this page");
		}
	});
});
</script>			
HTML;

		return $html;
	}
	
}

?>