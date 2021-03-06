<?php
include_once("connect_to_database.php");

class LockHandler {
	
	public static function lock() {
		global $db_conn;
		mysqli_query($db_conn,"LOCK TABLES global_lock WRITE;");
	}
	
	public static function unlock() {
		global $db_conn;
		mysqli_query($db_conn, "UNLOCK TABLES;");
		mysqli_close($db_conn);		
	}
	
}

/*

// Example usage:

include_once("LockHandler.php");

LockHandler::lock();

sleep(10);

LockHandler::unlock();

*/

/*

Note:

The file connect_to_database.php needs to be present, as
well as the file it includes: database_info.php.

The table global_lock must also be included. You can run
create_tables.php to create it. What fields that table
contains is unimportant

*/

?>