<?php

include_once("FileHandler.php");

echo "<html>";
echo "<head>";
echo "<script src=jquery.js></script>";
echo "<script>";
echo <<<JS
$(document).ready(function() {

});
JS;
echo "</script>";
echo "</head>";

echo "<body>";
echo "<h1>Edit Result</h1>";

echo "<textarea>";
echo FileHandler::readStringFromFile("resource_text.txt");
echo "</textarea>";

echo "<br><br>";

echo "<button id=save_result_button>Save</button>";
echo "</body>";
echo "</body>";


?>