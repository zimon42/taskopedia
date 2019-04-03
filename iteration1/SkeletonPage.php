<?php

class SkeletonPage extends Page {

	public function getContent() {}
	
	public function getAddToHead() {}
	
	public function getWhole() {
		$content = $this->getContent();
		$addToHead = $this->getAddToHead();
		$html = "";
		$html .= <<<HTML
<!DOCTYPE html>
<html>
<head>
<script src=jquery.js></script>
$addToHead
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
		return $html;
	}
	
}

?>