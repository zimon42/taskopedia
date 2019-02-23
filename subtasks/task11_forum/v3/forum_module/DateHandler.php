<?php

class DateHandler {
	
	public static function getNowDateTimeString() {
		$date = new DateTime();
		$result = $date->format('Y-m-d H:i:s');
		return $result;
	}
	
	public static function getDateTimeFromString($str) {
		$format = 'Y-m-d H:i:s';
		$date = DateTime::createFromFormat($format, $str);
		return $date;
	}
	
	public static function getFormattedDate($str) {
		$date = self::getDateTimeFromString($str);
		if ($date === FALSE) return "Unproper date string";
		$monthNum = $date->format('m');
		$monthName = self::getMonthName($monthNum);
		$dateNum = $date->format('d');
		$dateYear = $date->format('Y');
		return $dateNum . " " . $monthName . " " . $dateYear;
	}
	
	private static function getMonthName() {
		 $monthNum = date('m');
		 if ($monthNum == "01") return "jan";
		 if ($monthNum == "02") return "feb";
		 if ($monthNum == "03") return "mar";
		 if ($monthNum == "04") return "apr";
		 if ($monthNum == "05") return "may";
		 if ($monthNum == "06") return "jun";
		 if ($monthNum == "07") return "jul";
		 if ($monthNum == "08") return "aug";
		 if ($monthNum == "09") return "sep";
		 if ($monthNum == "10") return "oct";
		 if ($monthNum == "11") return "nov";
		 if ($monthNum == "12") return "dec";
		 return "Unknown month";
	}

	public static function compareDateTimeStrings($str1, $str2) {
		$datetime1 = new DateTime($str1);
		$datetime2 = new DateTime($str2);
		if ($datetime1 == $datetime2) {
			return 0;
		}
		if ($datetime1 < $datetime2) {
			return -1;
		}
		if ($datetime1 > $datetime2) {
			return 1;
		}		
		echo "DateHandler::compareDateTimeStrings error: No integer value";
	}
	
	public static function sortDateTimeStrings(&$arr) {
		usort($arr, function($a, $b) { return DateHandler::compareDateTimeStrings($a, $b); } );
	}
	
	public static function test() {
		$nowString = self::getNowDateTimeString();
		echo "Now: " . self::getFormattedDate($nowString);
	}
	
	public static function test2() {
		$format = "Y-m-d H:i:s";
		$str = '2019-02-05 13:14:15';
		$date = DateTime::createFromFormat($format, $str);
		echo "Date num: " . $date->format('d');
	}
		
	public static function test3() {
		echo self::compareDateTimeStrings("2018-08-12 12:13:14", "2018-08-14 12:13:14");
	}
		
	public static function test4() {
		$arr = array("2018-08-11 12:13:14", "2018-08-14 12:13:14", "2018-08-12 12:13:14", "2018-08-10 12:13:14");
		self::sortDateTimeStrings($arr);
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}
}

// DateHandler::test4();

?>