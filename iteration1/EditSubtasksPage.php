<?php

include_once("SkeletonPage.php");

class EditSubtasksPage extends SkeletonPage {
	
	public function getContent() {
		$html = "";
		$html .= <<<HTML
<h3>Subtasks</h3>
<div id=subtask_list_div></div>
<button id=save_subtask_list_button>Save</button>
HTML;
		return $html;
	}
	
	public function getAddToHead() {
		return "";
	}
	
}

?>