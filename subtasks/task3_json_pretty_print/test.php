<?php

$string = '{"product_name":"prod1","val1":1,"val2":8}';

$json = json_decode($string);

echo "<pre>";
echo json_encode($json, JSON_PRETTY_PRINT);
echo "</pre>";

?>