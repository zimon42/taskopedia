<?php

	include_once("JsonPrettyPrinter.php");
	
	// Test phpArrayToJson: --------------------
	
	echo "phpArrayToJson:<br>";
	
	$arr = array("product_name" => "prod1", "val1" => 2, "val2" => 18); 

	echo "<pre>";
	echo JsonPrettyPrinter::phpArrayToJson($arr);
	echo "</pre>";
	
	echo "<br>";
	
	
	// Test jsonToPhpArray: -------------------
	
	echo "jsonToPhpArray:<br>";
	
	$json = '{"product_name":"prod1","val1":1,"val2":8}';
	$arr2 = JsonPrettyPrinter::jsonToPhpArray($json);
	
	print_r($arr2);

	echo "<br>";
	
	echo $arr2["val2"];

?>