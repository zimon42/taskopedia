<?php

include_once("EditButtonClickHandler.php");
include_once("UpdateResourceLatestTime.php");
include_once("UnlockNotChangedResource.php");

class ResourceLockerRequestHandler {
	
	public static function getPage($pageName) {
		$page = FALSE;
		if ($pageName == "edit_button_click_handler") {
			$page = new EditButtonClickHandler();
		}
		if ($pageName == "update_resource_latest_time") {
			$page = new UpdateResourceLatestTime();
		}
		if ($pageName == "unlock_not_changed_resource") {
			$page = new UnlockNotChangedResource();
		}
		if ($page !== FALSE) {
			// TaskHandler::setTaskParams($page);
			return $page;
		}
		return FALSE;
	}
	
}

?>