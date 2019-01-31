<?php

include_once("FileHandler.php");

$resId = $_POST["res_id"];
$resState = $_POST["res_state"];

FileHandler::writeStringToFile("resource_text.txt", $resState);

?>