<?php

include_once("connect_to_database.php");

class ResourceLocker {
	
	public static $deleteLockAfterNumSecs = 30;
	
	public static function isLocked($resId) {
		global $db_conn;
		$sql = "SELECT * FROM resource_locks WHERE resource_id='".$resId."'";
		$result = $db_conn->query($sql); 
		$result || die("ResourceLocker::isLocked error: ".$db_conn->error());
		return $result->num_rows > 0;		
	}
	
	public static function lock($resId, $userName) {
		global $db_conn;
		$sql = "INSERT INTO resource_locks (resource_id, user_name, latest_update_time) ";
		$sql .= "VALUES ('".$resId."','".$userName."',NOW())";
		$db_conn->query($sql) || die("ResourceLocker::lock error: ".$db_conn->error());
	}
	
	public static function tryDeleteLock($resId) {
		global $db_conn;
		$sql = "DELETE FROM resource_locks WHERE resource_id='".$resId."' ";
		$sql .= "AND DATE_ADD(latest_update_time, INTERVAL ".self::$deleteLockAfterNumSecs." SECOND)<NOW()";
		$db_conn->query($sql) || die("ResourceLocker::tryDeleteLock error: ".$db_conn->error());		
	}
	
}

?>