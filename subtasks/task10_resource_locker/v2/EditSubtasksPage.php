<?php

class EditSubtasksPage {
	
	public function getContent() {
		$html = "";
		$html .= <<<HTML
<h3>Subtasks</h3>
HTML;

		$subtasks_arr = JsonFileHandler::readPhpArray("subtasks.txt");
		for ($i=0; $i<count($subtasks_arr); $i++) {
			$subtask = $subtasks_arr[$i];
			$html .= ($i+1) . ". " . $subtask["title"] . "<br>";
		}
		return $html;
	}
	
	public function getAddToHead() {
		return "";
	}
	
}

?>