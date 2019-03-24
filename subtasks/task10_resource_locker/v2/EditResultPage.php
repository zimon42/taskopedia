<?php

include_once("JsonFileHandler.php");

class EditResultPage {
	
	public $taskId;
	
	public function getContent() {
		$html = "";
		$html .= <<<HTML
<h1>Edit Result</h1>

<textarea id=resource_text rows=10 cols=50>
HTML;

		$arr = JsonFileHandler::readPhpArray("result.txt");
		$html .= $arr["content"];
		$html .= <<<HTML
</textarea>

<br><br>

<button id=save_result_button>Save</button>
<button id=exit_button>Exit</button>
HTML;
		return $html;
	}
	
	public function getAddToHead() {
		$html = "";
		$html .= <<<HTML
<script src=resource_locker_module/ResourceLocker.js></script>
<script>
$(document).ready(function() {
	$("#save_result_button").click(function() {
		ResourceLocker.save_resource(
		{
			save_page:"index.php?page=task_save_result"
		}
		);
	});
	$("#exit_button").click(function() {
		ResourceLocker.exit_resource(
		{
			save_page:"index.php?page=task_save_result"
		}
		);
	});		
});		

function getResourceCurrentState() {
	return $("#resource_text").val();
}

</script>
HTML;
		return $html;
	}
	
}

?>