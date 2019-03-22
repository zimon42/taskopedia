<?php

include_once("JsonFileHandler.php");

class TaskPage {

	public function getContent() {
		
		$html = "";
		$html = <<<HTML
<h3>Result</h3>
HTML;

		$result_arr = JsonFileHandler::readPhpArray("result.txt");
		$result_content = $result_arr["content"];

		$html .= $result_content . "<br>"; 

		$html .= "<button id=edit_result_button>Edit result</button>";

		$html .= <<<HTML
<h3>Subtasks</h3>
HTML;

		$subtasks_arr = JsonFileHandler::readPhpArray("subtasks.txt");
		for ($i=0; $i<count($subtasks_arr); $i++) {
			$subtask = $subtasks_arr[$i];
			$html .= ($i+1) . ". " . $subtask["title"] . "<br>";
		}

		$html .= <<<HTML
<button id=edit_subtasks_button>Edit subtasks</button>
</body>
</html>
HTML;

		return $html;
	}
	
	public function getAddToHead() {
		
		$html = "";
		
		$html .= <<<HTML
<script src=resource_locker_module/ResourceLock.js></script>
<script src=resource_locker_module/Hello.js></script>
<script>
$(document).ready(function() {
	$("#edit_result_button").click(function() {
		ResourceLocker.editButtonClickHandler();
	});
	$("#edit_subtasks_button").click(function() {
		ResourceLocker.editButtonClickHandler();
	});	
})
</script>
HTML;
		return $html;
		
	}
	
}
?>