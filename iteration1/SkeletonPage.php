<?php

class SkeletonPage extends Page {

	public $taskType;
	public $mainTaskId;
	public $taskId;

	public function getContent() {}
	
	public function getAddToHead() {}
	
	public function getWhole() {
		$content = $this->getContent();
		$addToHead = $this->getAddToHead();
		$top = $this->getTop();
		$html = "";
		$html .= <<<HTML
<!DOCTYPE html>
<html>
<head>
<link rel=\"stylesheet\" type=\"text/css\" href=\"skeleton_page.css\">
<script src=jquery.js></script>
$addToHead
</head>
<body>
$top
<hr>
$content
<hr>
Bottom bar
</body>
</html>		
HTML;
		return $html;
	}
	
	public function getTop() {
		$html = "";
		$html .= <<<HTML
<div id=top_panel>
	<img src=puzzle_piece.png width=30 />
	<span id=taskopedia_title>Taskopedia task page</span><br>
	Main task: Finding treatments for DIPG cancer
</div>		
HTML;
		return $html;
	}
	
}

?>