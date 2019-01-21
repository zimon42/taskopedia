<?php
include_once("JsonFileHandler.php");

$arr = JsonFileHandler::readPhpArray("taskopedia_data/main_tasks/main_task_00000001/task_pages/task_page_10000001/task_page.txt");

echo "<pre>";
print_r($arr);
echo "</pre>";

?>