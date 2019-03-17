<?php

class JsonPrettyPrinter {
	
	// Takes a php array and returns a json string
	// that is pretty printed
	public static function phpArrayToJson($arr) {
		return json_encode($arr, JSON_PRETTY_PRINT);
	}
	
	// Takes a json string and converts it into a
	// php array and returns that array
	public static function jsonToPhpArray($json) {
		return json_decode($json, TRUE);
	}
	
}

?>