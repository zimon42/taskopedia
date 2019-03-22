<?php

include_once("JsonFileHandler.php");

echo <<<HTML
<html>
<head>
<script src=jquery.js></script>
<script>

$(document).ready(function() {
	$("#edit_result_button").click(function() {
		
	});
	$("#edit_result_button").click(function() {
		
	});	
})

</script>

</head>
<body>
<h3>Result</h3>
HTML;

$result_arr = JsonFileHandler::readPhpArray("result.txt");
$result_content = $result_arr["content"];

echo $result_content . "<br>"; 

echo "<button id=edit_result_button>Edit result</button>";

echo <<<HTML
<h3>Subtasks</h3>
HTML;

$subtasks_arr = JsonFileHandler::readPhpArray("subtasks.txt");
for ($i=0; $i<count($subtasks_arr); $i++) {
	$subtask = $subtasks_arr[$i];
	echo ($i+1) . ". " . $subtask["title"] . "<br>";
}

echo <<<HTML
<button id=edit_subtasks_button>Edit subtasks</button>
</body>
</html>
HTML;

?>