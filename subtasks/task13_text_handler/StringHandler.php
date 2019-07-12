<?php

// http://localhost/taskopedia/subtasks/task13_text_handler/StringHandler.php

class StringHandler {
	
	// Returns true (1) if the second argment occurrs in the first argument
	public static function in_string($str, $substr) {
		return strrpos($str, $substr) !== false;
	}

	// https://stackoverflow.com/questions/2790899/how-to-check-if-a-string-starts-with-a-specified-string	
	public static function starts_with($str, $starts_with_str) {
		return strpos($str, $starts_with_str) === 0;
	}
	
	// Substitutes the part from start_pos to end_pos (end_pos included) in str with with_str
	public static function replace_part($str, $start_pos, $end_pos, $with_str) {
		return substr($str, 0, $start_pos) . $with_str . substr($str, $end_pos + 1);
	}
	
	// Returns the part that starts at start_pos and ends at endpos (endpos included)
	public static function get_part($str, $start_pos, $end_pos) {
		$length = $end_pos - $start_pos + 1;
		return substr($str, $start_pos, $length);
	}
		
	public static function test1() {
		// echo self::in_string("This is hello world", "hello");
		// echo self::starts_with("http://address", "http");
		// echo self::replace_part("This http://address is it", 5, 18, "[1]");
		echo self::get_part("This http://address is it", 5, 18);
	}
	
}

// StringHandler::test1();

?>