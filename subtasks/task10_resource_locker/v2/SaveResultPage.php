<?php

include_once("JsonFileHandler.php");

class SaveResultPage {
	
	public function getContent() {

		$resState = $_POST["res_state"];
		$arr = array();
		$arr["content"] = $resState;
		
		JsonFileHandler::writePhpArray("result.txt", $arr);
		
	}
	
	public function getAddToHead() {
		return "";
	}
	
}

?>