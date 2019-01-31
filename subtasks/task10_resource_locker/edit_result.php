<?php

include_once("FileHandler.php");

echo "<html>";
echo "<head>";
echo "<script src=jquery.js></script>";
echo "<script>";
echo <<<JS
$(document).ready(function() {
	$("#save_result_button").click(function() {
		save_resource();
	});
	$("#exit_button").click(function() {
		exit_resource();
	});	
	resource_previous_state = getResourceCurrentState();
	resource_saved_state = getResourceCurrentState();
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
var resource_saved_state;

function update_resource_no_change() {
	resource_current_state = getResourceCurrentState();
	if (resource_current_state != resource_previous_state) {
		num_times_no_change = 0;
		resource_previous_state = getResourceCurrentState();
	}
	else {
		num_times_no_change++;
		if (num_times_no_change >= max_times_no_change) {
			unlock_not_changed_resource();
		}
	}
}

function unlock_not_changed_resource() {
	$.post(
		"unlock_not_changed_resource.php",
		{
			res_id: "task_10000001_result"
		},
		function (data, status) {			
			$.post(
				"save_resource.php",
				{
					res_id: "task_10000001_result",
					res_state: getResourceCurrentState()
				},
				function (data, status) {			
					alert("Due to inactivity your work has been saved and you will be exited");
				}
			);
			location="index.php";
		}
	);
}

function save_resource() {
	$.post(
		"save_resource.php",
		{
			res_id: "task_10000001_result",
			res_state: getResourceCurrentState()
		},
		function (data, status) {			
			alert("Your resource has been saved");
		}
	);
	resource_saved_state = getResourceCurrentState();
}

function exit_resource() {
	if (resource_saved_state != getResourceCurrentState()) {
		if (confirm("Do you wanto save your work before you exit?")) {
			$.post(
				"save_resource.php",
				{
					res_id: "task_10000001_result",
					res_state: getResourceCurrentState()
				},
				function (data, status) {			
				}
			);			
		}
	}
	location="index.php";
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
echo "<button id=exit_button>Exit</button>";
echo "</body>";


?>