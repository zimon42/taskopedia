<?php

include_once("ResourceLocker.php");

$resId = $_POST["res_id"];

ResourceLocker::unlock($resId);

?>