<?php

include_once("ForumData.php");
include_once("DateHandler.php");

class TopicSorter {
	
	public static function sort(&$topics_arr) {
		usort($topics_arr, function($topic1, $topic2) { 
			$reply1 = self::getMostRecentReply($topic1);
			$reply2 = self::getMostRecentReply($topic2);
			return DateHandler::compareDateTimeStrings($reply1["date"], $reply2["date"]); 
		});		
	}
	
	private static function getMostRecentReply($topic) {
		$numReplies = count($topic["replies"]);
		return $topic["replies"][$numReplies-1];
	}
	
	public static function test1() {
		$testArr = self::getTestArray();
		echo "<pre>";
		print_r($testArr);
		echo "</pre>";
	}
	
	public static function test2() {
		$testArr = self::getTestArray();
		echo "Before sort:<br>";
		echo "<pre>";
		print_r($testArr);
		echo "</pre>";		
		usort($testArr, function($topic1, $topic2) { 
			$reply1 = self::getMostRecentReply($topic1);
			$reply2 = self::getMostRecentReply($topic2);
			return DateHandler::compareDateTimeStrings($reply1["date"], $reply2["date"]); 
		});
		echo "<br>After sort:<br>";
		echo "<pre>";
		print_r($testArr);
		echo "</pre>";		

	}
	
	public static function test3() {
		$arr = self::getTestArray();
		$reply = self::getMostRecentReply($arr[2]);
		echo $reply["date"];
	}
	
	private static function getTestArray() {
		$arr = <<<HTML
[
	{ "title": "Topic 1", "replies": 
		[
			{ "date": "2019-03-19 09:26:45" },
			{ "date": "2019-03-19 09:26:48" }
		]
	},
	{ "title": "Topic 1", "replies": 
		[
			{ "date": "2019-03-19 09:26:42" },
			{ "date": "2019-03-19 09:26:43" }
		]
	},
	{ "title": "Topic 1", "replies": 
		[
			{ "date": "2019-03-19 09:26:44" },
			{ "date": "2019-03-19 09:26:47" },
			{ "date": "2019-03-19 09:26:49" }
		]
	},
	{ "title": "Topic 1", "replies": 
		[
			{ "date": "2019-03-19 09:26:40" },
			{ "date": "2019-03-19 09:26:41" }
		]
	}	
]
HTML;
		return json_decode($arr, true);
	}
	
}

// TopicSorter::test2();

/*
Bug: json_decode didnt return an array, added second argument "true";
https://stackoverflow.com/questions/6815520/cannot-use-object-of-type-stdclass-as-array
*/

/*
Bug: Passed reply array to comparison function, and not reply["date"];
*/
?>