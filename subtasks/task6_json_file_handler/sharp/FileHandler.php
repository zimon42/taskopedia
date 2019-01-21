<?php

class FileHandler {
	
	// Reads file into string
	public static function readStringFromFile($fileName) {
		return file_get_contents($fileName);
	}
	
	// Writes string to file
	public static function writeStringToFile($fileName,$string) {
		file_put_contents($fileName, $string);	
	}
	
}

/*
Example usage:
// Reads from example_file1.txt and writes it to example_file2.txt

include_once("FileHandler.php");

$string = FileHandler::readStringFromFile("example_file.txt");
FileHandler::writeStringToFile("example_file2.txt", $string);
*/

?>