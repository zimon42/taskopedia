<?php

class NewReplyFormRenderer {
	
	public static function render($topicId) {
		$html = "";
		$html .= <<<HTML
<div id=new_reply_form>
Content:<br>
<textarea rows=10 id=content></textarea>
</div><br>
<button id=new_reply_done_button data-topic-id={$topicId}>Done</button>
HTML;
		return $html;

	}
	
}

?>