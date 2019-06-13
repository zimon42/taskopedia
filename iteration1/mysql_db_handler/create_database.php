<?php
include("database_info.php");

$conn = new mysqli($taskopedia_db_server, $taskopedia_db_username, $taskopedia_db_password);

$sql = "CREATE DATABASE ".$taskopedia_db_database;
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}
?>