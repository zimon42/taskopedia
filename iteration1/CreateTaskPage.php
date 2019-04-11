<?php

include_once("SkeletonPage.php");

class CreateTaskPage extends SkeletonPage {
	
	public function getContent() {
		$html = "";
		$html .= <<<HTML
Title:<img src=qmark.png class=qmark_img data-field=title /><br>
<input type=text class=form_elem id=title></input><br>
Description:<img src=qmark.png class=qmark_img data-field=description /><br>
<textarea rows=5 class=form_elem id=description></textarea><br>
More info:<img src=qmark.png class=qmark_img data-field=more_info /><br>
<textarea rows=3 class=form_elem id=more_info></textarea><br>
HTML;
		return $html;
	}
	
	public function getAddToHead() {
		$html = "";
		$html .= <<<HTML
<link rel=stylesheet type=text/css href=create_edit_task.css>
<script>
$(document).ready(function() {
	$(".qmark_img").click(function() {
		\$field = $(this).attr("data-field");
		alert(getHelp(\$field));
	});
});

function getHelp(field) {
	if (field == "title") {
		return "Here you specify the title of the task. For example: 'Study Wikipedias page on DIPG'";
	}
	if (field == "description") {
		return "Here you specify a longer description of the task, or background to why you wanto create this task. For example: 'By studying the wikipedia page on DIPG we can find more paths to solving the main task'";
	}
	if (field == "more_info") {
		return "Here you specify more information needed to solve the task, for example the link to the page: 'en.wikipedia.org/dipg'";
	}
	return "Error getHelp: No such field: "+field;
}
</script>		
HTML;
		return $html;
	}
	
}

?>