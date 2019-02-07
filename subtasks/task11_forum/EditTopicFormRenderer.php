<?php

include_once("TaskForumData.php");

class EditTopicFormRenderer {
	
	public static function render($topicId) {
		$topic = TaskForumData::getTopic($topicId);
		$html = "";
		$html .= <<<HTML
<div id=new_topic_form>
Title:<br>
<input type=text id=title value="{$topic["title"]}"/><br><br>
Content:<br>
<textarea rows=10 id=content>{$topic["content"]}</textarea>
</div><br>
<button id=new_topic_done_button>Done</button>
HTML;
		return $html;
		
	}
	
}

?>