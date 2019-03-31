<?php

include_once("JsonFileHandler.php");

class SaveResultPage {
	
	public function getContent() {

		$resState = $_POST["res_state"];
		$resArr = explode(",", $resState);
		
		$subtaskArr = array();
		
		JsonFileHandler::writePhpArray("subtasks.txt", $arr);
		
	}
	
	public function getAddToHead() {
		return "";
	}
	
}

?>