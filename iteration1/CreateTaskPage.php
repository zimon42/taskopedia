<?php

include_once("SkeletonPage.php");

class CreateTaskPage extends SkeletonPage {
	
	public function getContent() {
		$html = "";
		$html .= <<<HTML
Title:<br>
<input type=text class=form_elem id=title></input><br>
Description:<br>
<textarea rows=5 class=form_elem id=description></textarea><br>
More info:<br>
<textarea rows=3 class=form_elem id=more_info></textarea><br>
HTML;
		return $html;
	}
	
	public function getAddToHead() {
		$html = "";
		$html .= <<<HTML
<link rel=stylesheet type=text/css href=create_edit_task.css>		
HTML;
		return $html;
	}
	
}

?>