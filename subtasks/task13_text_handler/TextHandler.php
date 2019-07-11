<?php

// http://localhost/taskopedia/subtasks/task13_text_handler/TextHandler.php

// https://stackoverflow.com/questions/7109143/what-characters-are-valid-in-a-url

class TextHandler {
	
	public static $small_chars = "abcdefghijklmnopqrstuvwxyz";
	public static $big_chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	public static $address_chars = self::$small_chars . "./:-_?&%";
	
	// Returns true if $ch is in $str
	public static function instr($str, $ch) {
		return strrpos($str, $ch) !== false;
	}
	
	public static function isBigChar($ch) {
		return strrpos(self::$big_chars, $ch) !== false;
	}

	public static function isSmallChar($ch) {
		return strrpos(self::$small_chars, $ch) !== false;
	}
	
	public static function processText($text) {
		return "Hello world";
	}
	
	public static function findDotInAddress($text) {
		
	}
	
	// argument $i is position of dot
	public static function isDotInAddress($text, $i) {
		
		// If dot in the beginning or end of text, not dot in address
		if ($i==0 || $i==strlen($text)-1) {
			return false;
		}
		
		// If big char after dot, probably not address because addresses
		// don't usually have big chars. Probably beginning of new sentence
		if (self::isBigChar($text[$i+1])) {
			return false;
		}
		
		// If small letters surrounding dot, probably address
		
		
	}
	
	// Argument $i points at the last char, not the char after the last char
	public static function isEndOfAddress($text, $i) {
		
		// If at end of text, is end of address
		if ($i==strlen($text)-1) {
			return true;
		}
		
		// If space after char, is end of address
		if ($text[$i+1] == " ") {
			return true;
		}
		
		if
		
	}
	
	public static function test1() {
		echo self::processText("");
	}
	
}

TextHandler::test1();

?>