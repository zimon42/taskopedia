<?php

include_once ("connect_to_database.php");

$db_conn->query("DROP TABLE resource_locks");

$sql = "CREATE TABLE resource_locks (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
resource_id VARCHAR(100),
user_name VARCHAR(100),
latest_update_time DATETIME
)";

if ($db_conn->query($sql) === TRUE) {
    echo "Table resource_locks created successfully";
} else {
    echo "Error creating resource_locks table: " . $db_conn->error;
}

$db_conn->close();

?>