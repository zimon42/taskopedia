<?php

include_once("JsonFileHandler.php");

class TaskPage {

	public $taskId;

	public function getContent() {
		
		$html = "";
		$html = <<<HTML
		
User: <input type=text id=user_text value=simon></input><br>		
		
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
<script src=resource_locker_module/ResourceLocker.js></script>
<script>
$(document).ready(function() {
	$("#edit_result_button").click(function() {
		ResourceLocker.editButtonClickHandler(
		{
			res_id: "task_{$this->taskId}_result",
			user_name: $("#user_text").val(),
			edit_page: "index.php?page=task_edit_result&task_id={$this->taskId}"
		}
		);
	});
	$("#edit_subtasks_button").click(function() {
		ResourceLocker.editButtonClickHandler(
		{
			res_id: "task_00000001_subtasks",
			user_name: $("#user_text").val(),
			edit_page: "index.php?page=task_edit_subtasks"
		}
		);
	});	
})
</script>
HTML;
		return $html;
		
	}
	
}
?>