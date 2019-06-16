<?php

include_once("MysqlLockConfig.php");
// include_once("mysql_db_handler/connect_to_database.php");
include_once(MysqlLockConfig::$connect_to_database_script_path);

class LockHandler {
	
	public static function lock() {
		global $db_conn;
		// mysqli_query($db_conn,"LOCK TABLES global_lock WRITE;");
		mysqli_query($db_conn,"LOCK TABLES " . MysqlLockConfig::$lock_tables_string . ";");
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

// https://www.codexpedia.com/php/lock-a-mysql-table-in-php/

// Multiple table locks:
// https://dev.mysql.com/doc/refman/8.0/en/lock-tables.html
?>