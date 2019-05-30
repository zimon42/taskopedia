<?php

class ArrayHandler {
	
	public static function removeElement($arr, $elem) {
		
		$newArr = array();
		for ($i=0; $i<count($arr); $i++) {
			if ($arr[$i] != $elem) {
				array_push($newArr, $arr[$i]);
			}
		}
		return $newArr;
		
	}
	
	public static function test1() {
		$arr = array("red", "blue", "yellow", "green");
		$arr = self::removeElement($arr, "blue");
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}
	
}

// ArrayHandler::test1();

?>