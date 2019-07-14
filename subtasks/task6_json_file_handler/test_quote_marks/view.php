<?php

include_once("JsonFileHandler.php");

$arr = JsonFileHandler::readPhpArray("content.txt");

echo "Content: " . $arr["content"];

?>