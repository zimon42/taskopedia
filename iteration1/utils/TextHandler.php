<?php

// http://localhost/taskopedia/subtasks/task13_text_handler/TextHandler.php

include_once("AddressesToLinksConverter.php");

class TextHandler {
	
	public static function processAllFilters($text) {
		$text = self::makeHtmlSafe($text);
		$text = AddressesToLinksConverter::processText($text);
		$text = nl2br($text);
		return $text;
	}
	
	public static function makeHtmlSafe($text) {
		$text = str_replace("<", "&lt;", $text);
		$text = str_replace(">", "&gt;", $text);
		return $text;
	}
	
	public static function test1() {
		echo self::processAllFilters("This address <b>http://www.google.se </b> is safe");
	}
	
}

// TextHandler::test1();

?>