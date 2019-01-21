<?php

include_once("TaskopediaData.php");

$arr = TaskopediaData::getTaskPageData("00000001", "10000001");
array_push($arr["team_members"], "John");
TaskopediaData::setTaskPageData("00000001", "10000001", $arr);

echo "<pre>";
print_r($arr);
echo "</pre>";

?>