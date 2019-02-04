<?php

class TopicListRenderer {

	public static function render($topics) {
		
		$html = "";
		$html .= "<h3>Task Forum</h3>";

		$html .= "<button class=new_topic_button>New Topic</button><br><br>";
		
		$html .= "<table id=topics_table cellspacing=0>";
		$html .= self::renderHeaderRow();
		
		// Render topic rows
		for ($i=0; $i<count($topics); $i++) {
			$html .= self::renderTopicRow($topics[$i]);
		}
		
		$html .= "</table>";

		$html .= "<br><button class=new_topic_button>New Topic</button><br>";
		
		return $html;
		
	}
	
	public static function renderHeaderRow() {
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
	
	public static function renderTopicRow($topic) {
		$numReplies = self::getNumReplies($topic);
		return <<<HTML
<tr class=topic_row>
	<td class=topic_title>
		<a href=view_topic.php?topic_id={$topic["topic_id"]}>
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

	public static function getNumReplies($topic) {
		return count($topic["replies"]);
	}
	
}

?>