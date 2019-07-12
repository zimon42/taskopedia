<?php

// http://localhost/taskopedia/subtasks/task13_text_handler/TextHandler.php

// https://stackoverflow.com/questions/7109143/what-characters-are-valid-in-a-url

include_once("StringHandler.php");

class TextHandler {
	
	public static $small_chars = "abcdefghijklmnopqrstuvwxyz";
	public static $big_chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		
	public static function isBigChar($ch) {
		return strrpos(self::$big_chars, $ch) !== false;
	}
	
	// Finds the first occurrence of "http" and returns
	// that position, or -1 if not exists
	public static function findAddressStart($text) {
		for ($i=0; $i<strlen($text); $i++) {
			$text_from_i = substr($text, $i);
			if (StringHandler::starts_with($text_from_i, "http")) {
				return $i;
			}
		}				
		return -1;
	}
	
	// Finds end of address, starting from $start_pos
	public static function findAddressEnd($text, $start_pos) {
		for ($i=$start_pos; $i<strlen($text); $i++) {
			if (self::isAddressEnd($text, $i)) {
				return $i;
			}
		}
		return -1;
	}
	
	public static function isAddressEnd($text, $i) {
		
		// If last character in string
		if ($i == strlen($text)-1) {
			return true;
		}
		
		// If char before space or new line
		if ($text[$i+1] == " " || $text[$i+1] == "\n") {
			return true;
		}
		
		// If next to last character
		if ($i == strlen($text)-2) {
			if ($text[$i+1] == " " || $text[$i+1] == "\n" || $text[$i+1] == "." || $text[$i+1] == "?") {
				return true;
			}
		}
		
		// If next character is dot, comma or question mark, and space or new line or big char after that char
		if ($text[$i+1] == "." || $text[$i+1] == "," || $text[$i+1] == "?") {
			if ($text[$i+2] == " " || $text[$i+2] == "\n" || self::isBigChar($text[$i+2])) {
				return true;
			}
		}
		
		return false;
		
	}
	
	public static function processText($text) {
		
		// ---- Replace all addresses with [..]
		$address_found_i = 0; // index of address found
		$addresses_arr = array(); // stored addresses
		while (true) {
			$address_start_pos = self::findAddressStart($text);
			if ($address_start_pos == -1) {
				break;
			}
			$address_end_pos = self::findAddressEnd($text, $address_start_pos);			
			$addresses_arr[$address_found_i] = StringHandler::get_part($text, $address_start_pos, $address_end_pos); // <- bug, must be called before replace_part
			$text = StringHandler::replace_part($text, $address_start_pos, $address_end_pos, "[".$address_found_i."]");
			$address_found_i++;
			if ($address_found_i > 1000) {
				echo "TextHandler::processText warning: reached more than 1000 links, possible eternal loop, breaking out";
				break;
			}
		}
		
		// echo $text."<br>";
		
		// ---- Replace all [..] with <a href..>
		$address_found_n = $address_found_i;
		$address_found_i = 0;
		for ($address_found_i=0; $address_found_i<$address_found_n; $address_found_i++) {
			$replace_with = "<a href='".$addresses_arr[$address_found_i]."'>".$addresses_arr[$address_found_i]."</a>";
			$text = str_replace("[".$address_found_i."]", $replace_with, $text);
		}
		
		return $text;
	}
	
	/*
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
	*/
	
	public static function test1() {
		// echo self::findAddressStart("This address http://www.dn.se is the right one");
		// echo self::findAddressEnd("This address http://www.dn.se is the right one", 13);
		// echo self::processText("This address http://www.dn.se is the right one");
		echo self::processText("This address http://www.dn.se and http://www.google.se is the right one") . "<br>";
		echo self::processText("This address http://www.dn.se and http://www.google.se.") . "<br>";
		echo self::processText("This address http://www.dn.se, and http://www.google.se.Hello again") . "<br>";
	}
	
}

TextHandler::test1();

?>