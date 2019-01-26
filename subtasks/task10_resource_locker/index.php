<?php

include_once("FileHandler.php");

echo "<html>";
echo "<head>";
echo "<script src=jquery.js></script>";
echo "<script>";
echo <<<JS
$(document).ready(function() {
	$("#edit_result_button").click(function() {
		location="edit_result.php";
	});
});
JS;
echo "</script>";
echo "</head>";

echo "<body>";
echo "<h1>Result</h1>";

echo FileHandler::readStringFromFile("resource_text.txt");

echo "<br><br>";

echo "<button id=edit_result_button>Edit result</button>";
echo "</body>";
echo "</body>";

?>