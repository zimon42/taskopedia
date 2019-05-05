<?php

include_once("SkeletonPage.php");
include_once("TaskopediaData.php");

class EditTaskinfoPage extends SkeletonPage {
	
	public function getContent() {
		$taskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);
		$taskArr = TaskopediaData::getTaskPageData($this->mainTaskId, $taskId);
		$title = $taskArr["title"];
		$desc = $taskArr["description"];
		$moreInfo = $taskArr["more_info"];
		
		// Status radio buttons:
		$statusWorkInProgress = "";
		$statusTaskSolved = "";
		if ($taskArr["status"] == "work in progress") $statusWorkInProgress = " checked";
		if ($taskArr["status"] == "task solved") $statusTaskSolved = " checked";
		
		$html = "";
		$html .= <<<HTML
<h3 id=header>Edit task info</h3>
Title:<img src=qmark.png class=qmark_img data-field=title /><br>
<input type=text class=form_elem id=title value="$title"></input><br>
Description:<img src=qmark.png class=qmark_img data-field=description /><br>
<textarea rows=5 class=form_elem id=description>$desc</textarea><br>
More info:<img src=qmark.png class=qmark_img data-field=more_info /><br>
<textarea rows=3 class=form_elem id=more_info>$moreInfo</textarea><br><br>
Task status:<br>
<input type=radio name=status value="work in progress"$statusWorkInProgress>Work in progress<br>
<input type=radio name=status value="task solved"$statusTaskSolved>Task solved</br><br>
<button id=save_taskinfo_button>Save</button>
<button id=exit_taskinfo_button>Exit</button>
HTML;
		return $html;
	}
	
	public function getAddToHead() {
		$taskParams = TaskHandler::getTaskParams($this);
		$html = "";
		$html .= <<<HTML
<link rel=stylesheet type=text/css href=create_edit_task.css>		
<script src=CreateEditTaskHelper.js></script>
<script src=resource_locker_module/ResourceLocker.js></script>
<script>
$(document).ready(function() {
	$(".qmark_img").click(function() {
		\$field = $(this).attr("data-field");
		alert(getHelp(\$field));
	});
});
$(document).ready(function() {
	$("#save_taskinfo_button").click(function() {
		ResourceLocker.save_resource(
		{
			save_page: getResourceSavePage()
		}
		);
	});
	$("#exit_taskinfo_button").click(function() {
		ResourceLocker.exit_resource(
		{
			save_page: getResourceSavePage()
		}
		);
	});		
});		

function getResourceCurrentState() {
	var title = \$("#title").val();
	var desc = \$("#description").val();
	var more_info = \$("#more_info").val();
	var status = \$("input[name='status']:checked").val();
	return "title="+title+"&desc="+desc+"&more_info="+more_info+"&status="+status;
}

function getResourceIdentifier() {
	return "maintask_{$this->mainTaskId}_subtask_{$this->taskId}_taskinfo";
}

function getResourceSavePage() {
	return "index.php?page=save_taskinfo_submit&$taskParams";
}

ResourceLocker.start();

</script>
HTML;
		return $html;
	}
	
}

?>