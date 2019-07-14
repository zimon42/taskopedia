<?php

include_once("JsonFileHandler.php");

$content = $_GET["content"];

JsonFileHandler::writePhpArray("content.txt", array("content" => $content));

?>