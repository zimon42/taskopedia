<?php
// Test with php arrays, print json

// $string = '{"product_name":"prod1","val1":1,"val2":8}';

$arr = array("product_name" => "prod1", "val1" => 1, "val2" => 18); 

// $json = json_decode($string);

echo "<pre>";
echo json_encode($arr, JSON_PRETTY_PRINT);
echo "</pre>";

?>