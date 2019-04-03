<?php

include_once("JsonFileHandler.php");

class SaveSubtasksPage {
	
	public function getContent() {

		$resState = $_POST["res_state"];
		$subtaskIdArr = explode(",", $resState);
		
		$newSubtaskArr = array();
		
		for ($i=0; $i<count($subtaskIdArr); $i++) {
			array_push($newSubtaskArr, array("id" => $subtaskIdArr[$i]));
		}
		
		JsonFileHandler::writePhpArray("subtasks.txt", $newSubtaskArr);
		
	}
	
	public function getAddToHead() {
		return "";
	}
	
}

?>