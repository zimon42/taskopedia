<?php
	include_once("FileHandler.php");
	
	$string = FileHandler::readStringFromFile("test_folder/example_file.txt");
	FileHandler::writeStringToFile("example_file2.txt", $string);
	
	echo "Done";


?>