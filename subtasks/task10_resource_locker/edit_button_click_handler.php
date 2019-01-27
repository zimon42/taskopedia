<?php

include_once("ResourceLocker.php");

$userName = $_POST["user_name"];
$resId = $_POST["res_id"];

ResourceLocker::tryDeleteLock($resId);

if (ResourceLocker::isLocked($resId)) {
	$reply = array();
	$reply["is_locked"] = true;
	echo json_encode($reply);
}

else {
	$reply = array();
	$reply["is_locked"] = false;
	ResourceLocker::lock($resId, $userName);
	echo json_encode($reply);	
}


?>