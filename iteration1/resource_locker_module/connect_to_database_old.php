<?php
include("database_info.php");

$db_conn = new mysqli($taskopedia_db_server, $taskopedia_db_username, $taskopedia_db_password, $taskopedia_db_database);

if ($db_conn->connect_error) {
    die('Connect Error (' . $db_conn->connect_errno . ') '
            . $db_conn->connect_error);
}
?>