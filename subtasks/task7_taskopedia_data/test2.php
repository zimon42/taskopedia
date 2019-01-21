<?php

include_once("TaskopediaData.php");

$arr = TaskopediaData::getTaskPageData("00000001", "10000001");

echo "<pre>";
print_r($arr);
echo "</pre>";

?>