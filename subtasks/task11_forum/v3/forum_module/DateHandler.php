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
		return $monthNum;
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
	
}

?>