<?php

include_once("FileHandler.php");
include_once("JsonPrettyPrinter.php");

class JsonFileHandler {
	
	public static function readPhpArray($fileName) {
		
		$jsonString = FileHandler::readStringFromFile($fileName);
		$arr = JsonPrettyPrinter::jsonToPhpArray($jsonString);
		return $arr;
		
	}
	
	public static function writePhpArray($fileName, $arr) {
		
		$jsonString = JsonPrettyPrinter::phpArrayToJson($arr);
		FileHandler::writeStringToFile($fileName, $jsonString);
		
	}
	
}


?>