<?php

class NewTopicFormRenderer {
	
	public static function render() {
		$html = "";
		$html .= <<<HTML
<div id=new_topic_form>
Title:<br>
<input type=text id=title /><br><br>
Content:<br>
<textarea rows=10 id=content></textarea>
</div><br>
<button id=new_topic_done_button>Done</button>
HTML;
		return $html;
	}
	
}

?>