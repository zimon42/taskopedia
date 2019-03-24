<?php

include_once("ResourceLocker.php");

$userName = $_POST["user_name"];
$resId = $_POST["res_id"];

ResourceLocker::tryDeleteLock($resId);

if (ResourceLocker::isLocked($resId)) {
	$reply = array();
	$reply["resource_acquired"] = false;
	$reply["resource_user_name"] = ResourceLocker::getUserName($resId);
	echo json_encode($reply);
}

else {
	$reply = array();
	$reply["resource_acquired"] = true;
	ResourceLocker::lock($resId, $userName);
	echo json_encode($reply);	
}


?>