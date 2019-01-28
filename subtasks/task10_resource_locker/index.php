<?php

include_once("FileHandler.php");

echo "<html>";
echo "<head>";
echo "<script src=jquery.js></script>";
echo "<script>";
echo <<<JS
$(document).ready(function() {
	$("#edit_result_button").click(function() {
		$.post(
		"edit_button_click_handler.php",
		{
			res_id: "task_10000001_result",
			user_name: $("#user_text").val()
		},
		function (data, status) {
			// alert("data:"+data);
			var arr = JSON.parse(data);
			var resource_acquired = arr["resource_acquired"];
			var user_name = arr["resource_user_name"];
			if (!resource_acquired) {
				alert("Resource is locked. It is currently being edited by "+user_name);
			}
			else {
				// alert("Resource is free");
				location='edit_result.php';
			}
		}
		);
		// location="edit_result.php";
	});
});
JS;
echo "</script>";
echo "</head>";

echo "<body>";
echo "<h1>Result</h1>";

echo FileHandler::readStringFromFile("resource_text.txt");

echo "<br><br>";

echo "<input id=user_text type=text value='Simon' />";

echo "<br><br>";

echo "<button id=edit_result_button>Edit result</button>";
echo "</body>";
echo "</body>";

?>