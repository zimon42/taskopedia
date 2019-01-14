<?php

include_once ("connect_to_database.php");

$db_conn->query("DROP TABLE global_lock");

$sql = "CREATE TABLE global_lock (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY
)";

if ($db_conn->query($sql) === TRUE) {
    echo "Table global_lock created successfully";
} else {
    echo "Error creating global_lock table: " . $db_conn->error;
}

$db_conn->close();

?>