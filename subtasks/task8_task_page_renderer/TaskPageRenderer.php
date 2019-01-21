<?php

include_once("TaskopediaData.php");

class TaskPageRenderer {
	
	public static function render($main_task_id, $task_page_id) {
		$arr = TaskopediaData::getTaskPageData($main_task_id, $task_page_id);
		
		echo <<<HTML
<html>
<head>
	<link rel="stylesheet" type="text/css" href="task_page.css">
</head>
<body>

	<div id=top_panel>
		<img src=puzzle_piece.png width=30 />
		<span id=taskopedia_title>Taskopedia task page</span><br>
		Main task: Finding treatments for DIPG cancer
	</div>
	
	<hr>
	
	<div id=menu_panel>
		logged in as <a href="">Simon</a>, <a href="">logout</a>, <a href="">task forum</a>, <a href="">your page</a>
	</div>
	
	<hr>

	<div id=content>
		<span class=header>Task:</span> <span class=task_title>Finding treatments for DIPG cancer</span><br>
		<div class=header_content>
			<span class=header2>Background:</span> DIPG stands for Diffuse intrinsic pontine glioma and is a type of brain cancer that effects children. There is currently no cure. We will change that. Together we will find treatments for DIPG!<br>
			<span class=header2>More info:</span><br>
			<span class=header2>Task team members:</span> <a href="">Simon</a>, <a href="">Eric</a> <button>Join team</button><br>
			<span class=header2>Task status:</span> Work in progress<br><br>
		</div>
		
		<span class=header>Result:</span><br><br>

		<span class=header>Subtasks:</span><br><br>
		
		<span class=header>Work logs:</span><br>
		<span class=header2>Simon:</span><br>
		<span class=header2>Eric:</span><br>
	</div>
	
</body>
</html>		
HTML;

		// print_r($arr);
	}
	
}

?>