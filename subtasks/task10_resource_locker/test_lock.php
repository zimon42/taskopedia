<?php

include_once("connect_to_database.php");

ob_end_flush();

echo "Reached lock<br>";

mysqli_query($db_conn,"LOCK TABLES global_lock WRITE;");
 
//Do something or sleep for 20 seconds, no other users can access this table
echo "Sleeping<br>";

sleep(10);
 
echo "Unlocking<br>";

mysqli_query($db_conn, "UNLOCK TABLES;");
 
mysqli_close($db_conn);

ob_start();


?>