<?php

class ParamsHandler {
	
	public static function getParamValue($paramsString, $paramName) {
		
		$paramsArr = explode("&", $paramsString);
		
		for ($i=0; $i<count($paramsArr); $i++) {
			$pStr = $paramsArr[$i];
			$pArr = explode("=", $pStr);
			$pName = $pArr[0];
			$pValue = $pArr[1];
			if ($pName == $paramName) {
				return $pValue;
			}
		}
		
		return "Param name not found";
		
	}
	
	public static function test() {
		echo self::getParamValue("name=Simon&age=42", "age"); // Prints "42"
	}
	
}

// ParamsHandler::test();

?>