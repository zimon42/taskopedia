<?php
	include_once("FileHandler.php");
	
	$string = FileHandler::readStringFromFile("example_file.txt");
	FileHandler::writeStringToFile("example_file2.txt", $string);
	
	echo "Done";


?>