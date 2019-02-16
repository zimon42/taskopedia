<?php

include_once("ForumConfig.php");
include_once("ForumData.php");

class ViewTopicListPage {
	
	public $forumFile;
	
	public function getContent() {
		$topics = ForumData::getTopics($this->forumFile);
		
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
		return <<<HTML
<tr class=topic_row>
	<td class=topic_title>
		<a href=$path?page=forum_view_topic&topic_id={$topic["topic_id"]}>
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
		$path = ForumConfig::$forumModulePath . "/" . "task_forum.css";
		return "<link rel=\"stylesheet\" type=\"text/css\" href=\"$path\">";
	}
	
}

?>