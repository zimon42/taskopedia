<?php

include_once("ResourceLockerConfig.php");
include_once(ResourceLockerConfig::$path_to_page_class);

class UpdateResourceLatestTime extends Page {
	
	public function getWhole() {
		return "UpdateResourceLatestTime";
	}
	
}

?>