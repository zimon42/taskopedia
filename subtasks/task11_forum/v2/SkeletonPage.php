<?php

class SkeletonPage {
	
	public static $content;
	public static $addedToHead="";
	
	public static function setContent($content) {
		self::$content = $content;
	}
	
	public static function addToHead($headContent) {
		self::$addedToHead .= $headContent;
	}
	
	public static function render() {
		$content = self::$content;
		$addedToHead = self::$addedToHead;
		return <<<HTML
<html>
<head>
<script src=jquery.js></script>
$addedToHead
</head>
<body>
Top bar
<hr>
$content
<hr>
Bottom bar
</body>
</html>		
HTML;
	}
	
}

?>