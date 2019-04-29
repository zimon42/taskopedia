<?php

include_once("utils/JsonFileHandler.php");
include_once("SkeletonPage.php");
include_once("TaskopediaData.php");

class EditResultPage extends SkeletonPage {
	
	public function getContent() {
		$html = "";
		$html .= <<<HTML
<h1 id=edit_result_title>Edit Result</h1>

<textarea id=resource_text rows=10 cols=50>
HTML;

		$taskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);
		$arr = TaskopediaData::getTaskPageData($this->mainTaskId, $taskId);
		$html .= $arr["result"];
		$html .= <<<HTML
</textarea>

<br><br>

<button id=save_result_button>Save</button>
<button id=exit_button>Exit</button>
HTML;
		return $html;
	}
	
	public function getAddToHead() {
		$taskParams = TaskHandler::getTaskParams($this);
		$html = "";
		$html .= <<<HTML
<style>
#edit_result_title {
	color:gray;
	font-size:16pt;
}
</style>
<script src=resource_locker_module/ResourceLocker.js></script>
<script>
$(document).ready(function() {
	$("#save_result_button").click(function() {
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
	return "maintask_{$this->mainTaskId}_subtask_{$this->taskId}_result";
}

function getResourceSavePage() {
	return "index.php?page=save_result_submit&$taskParams";
}

ResourceLocker.start();

</script>
HTML;
		return $html;
	}
	
}

?>