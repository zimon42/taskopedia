<?php

include_once("ResourceLockerConfig.php");
include_once(ResourceLockerConfig::$path_to_page_class);
include_once("ResourceLocker.php");

class UpdateResourceLatestTime extends Page {
	
	public function getWhole() {
		$resId = $_POST["res_id"];

		ResourceLocker::updateLatestTime($resId);
		
		return "UpdateResourceLatestTime class";
	}
	
}

?>