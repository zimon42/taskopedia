<?php

class GuidCreator {
	
	public static function create() {
		
		$digits = "0123456789abcdef";
		
		$str = "";
		
		for ($i=0; $i<8; $i++) {
			$randNum = rand(0,15);
			$str .= $digits[$randNum];
		}
		
		return $str;
		
	}
	
}

/*
echo GuidCreator::create();
*/

?>