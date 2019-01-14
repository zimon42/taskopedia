<?php
// Test with php arrays, read json

// $string = '{"product_name":"prod1","val1":1,"val2":8}';

$arr = array("product_name" => "prod1", "val1" => 1, "val2" => 18); 

$json = json_encode($arr, JSON_PRETTY_PRINT);

echo "<pre>";
echo json_encode($arr, JSON_PRETTY_PRINT);
echo "</pre>";

$arr2 = json_decode($json, TRUE);

print_r($arr2);


echo "<br>";
echo $arr2["val1"];

?>