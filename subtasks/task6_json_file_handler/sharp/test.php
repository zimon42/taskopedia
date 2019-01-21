<?php

include_once("JsonFileHandler.php");

/*
$arr = JsonFileHandler::readPhpArray("test.txt");

echo "json: <br>";
echo "<pre>";
print_r($arr);	
echo "</pre>";

$arr2 = array("name" => "Hi world");
JsonFileHandler::writePhpArray("test2.txt", $arr2);
*/

$arr = JsonFileHandler::readPhpArray("test.txt");
$arr["name"] .= " changed";
JsonFileHandler::writePhpArray("test.txt", $arr);

?>