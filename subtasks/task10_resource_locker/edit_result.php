<?php

include_once("FileHandler.php");

echo "<html>";
echo "<head>";
echo "<script src=jquery.js></script>";
echo "<script>";
echo <<<JS
$(document).ready(function() {
	resource_previous_state = getResourceCurrentState();
	setInterval(update_resource_latest_time, 2500);
	setInterval(update_resource_no_change, 3300);
});

function update_resource_latest_time() {
	$.post(
	"update_resource_latest_time.php",
	{
		res_id: "task_10000001_result",
	},
	function (data, status) {			
	}
	);
}

var num_times_no_change = 0;
var max_times_no_change = 3;
var resource_previous_state;

function update_resource_no_change() {
	resource_current_state = getResourceCurrentState();
	if (resource_current_state != resource_previous_state) {
		num_times_no_change = 0;
		resource_previous_state = getResourceCurrentState();
	}
	else {
		num_times_no_change++;
		if (num_times_no_change >= max_times_no_change) {
			release_resource();
		}
	}
}

function release_resource() {
	alert("release_resource");
}

function getResourceCurrentState() {
	return $("#resource_text").val();
}

JS;
echo "</script>";
echo "</head>";

echo "<body>";
echo "<h1>Edit Result</h1>";

echo "<textarea id=resource_text rows=10 cols=50>";
echo FileHandler::readStringFromFile("resource_text.txt");
echo "</textarea>";

echo "<br><br>";

echo "<button id=save_result_button>Save</button>";
echo "</body>";
echo "</body>";


?>