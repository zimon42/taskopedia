<?php

class TestRefs {
	
	public static function sort(&$arr) {
		$arr = array(1,2,3);
	}
	
	public static function test() {
		$arr = array(4,5,6);
		self::sort($arr);
		print_r($arr);
	}
	
}

TestRefs::test();

?>