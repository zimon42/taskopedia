<?php

include_once("SkeletonPage.php");
include_once("TaskHandler.php");

class CreateTaskPage extends SkeletonPage {
	
	public function getContent() {
		$html = "";
		$html .= <<<HTML
<h3 id=header>Create new task</h3>
Title:<img src=qmark.png class=qmark_img data-field=title /><br>
<input type=text class=form_elem id=title></input><br>
Description:<img src=qmark.png class=qmark_img data-field=description /><br>
<textarea rows=5 class=form_elem id=description></textarea><br>
More info:<img src=qmark.png class=qmark_img data-field=more_info /><br>
<textarea rows=3 class=form_elem id=more_info></textarea><br>
<button id=create_task_done_button>Done</button>
HTML;
		return $html;
	}
	
	public function getAddToHead() {
		$taskParams = TaskHandler::getTaskParams($this);
		$html = "";
		$html .= <<<HTML
<link rel=stylesheet type=text/css href=create_edit_task.css>
<script src=CreateEditTaskHelper.js></script>
<script>
$(document).ready(function() {
	$(".qmark_img").click(function() {
		\$field = $(this).attr("data-field");
		alert(getHelp(\$field));
	});
	$("#create_task_done_button").click(function() {
		var title = $("#title").val();
		var desc = $("#description").val();
		var more_info = $("#more_info").val();
		location="index.php?page=create_task_submit&$taskParams&title="+title+"&desc="+desc+"&more_info="+more_info;
	});
});
</script>		
HTML;
		return $html;
	}
	
}

?>