<?php

include_once("SkeletonPage.php");

class EditWorklogPage extends SkeletonPage {
	
	public $userName;
	
	/*
	public function getContent() {
		return "EditWorklogPage: ".$this->userName;
	}
	*/
	
	public function getContent() {
		$html = "";
		$html .= <<<HTML
<h1 id=edit_worklog_title>Edit Worklog</h1>

<textarea id=resource_text rows=10 cols=50>
HTML;

		$taskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);
		$arr = TaskopediaData::getTaskPageData($this->mainTaskId, $taskId);

		// Get worklog content and output it into textarea element
		for ($i=0; $i<count($arr["worklogs"]); $i++) {
			$workLog = $arr["worklogs"][$i];
			if ($workLog["name"] == $this->userName) {
				$html .= $workLog["content"];
			}
		}
		
		$html .= <<<HTML
</textarea>

<br><br>

<button id=save_worklog_button>Save</button>
<button id=exit_button>Exit</button>
HTML;
		return $html;
	}
	
	public function getAddToHead() {
		$taskParams = TaskHandler::getTaskParams($this);
		$html = "";
		$html .= <<<HTML
<style>
#edit_worklog_title {
	color:gray;
	font-size:16pt;
}
</style>
<script src=resource_locker_module/ResourceLocker.js></script>
<script>
$(document).ready(function() {
	$("#save_worklog_button").click(function() {
		ResourceLocker.save_resource(
		{
			save_page: getResourceSavePage()
		}
		);
	});
	$("#exit_button").click(function() {
		ResourceLocker.exit_resource(
		{
			save_page: getResourceSavePage()
		}
		);
	});		
});		

function getResourceCurrentState() {
	return $("#resource_text").val();
}

function getResourceIdentifier() {
	return "maintask_{$this->mainTaskId}_subtask_{$this->taskId}_username_{$this->userName}_worklog";
}

function getResourceSavePage() {
	return "index.php?page=save_worklog_submit&user_name={$this->userName}&$taskParams";
}

ResourceLocker.start();

</script>
HTML;
		return $html;
	}	
	
}

?>