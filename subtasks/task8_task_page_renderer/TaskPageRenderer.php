<?php

include_once("TaskopediaData.php");

class TaskPageRenderer {
	
	public static function render($main_task_id, $task_page_id) {
		$arr = TaskopediaData::getTaskPageData($main_task_id, $task_page_id);
		$title = $arr["title"];
		$background = $arr["background"];
		$more_info = $arr["more_info"];
		$team_members = self::renderTeamMembers($arr["team_members"]);
		$status = $arr["status"];
		$result = $arr["result"];
		$subtasks = self::renderSubtasks($main_task_id, $arr["subtasks"]);
		$work_logs = self::renderWorkLogs($arr["worklogs"]);
		
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
		<span class=header>Task:</span> <span class=task_title>{$title}</span><br>
		<div class=header_content>
			<span class=header2>Background:</span> {$background}<br>
			<span class=header2>More info:</span> {$more_info}<br>
			<span class=header2>Task team members:</span> {$team_members}<button>Join team</button><br>
			<span class=header2>Task status:</span> {$status}<br><br>
		</div>
		
		<span class=header>Result:</span> {$result}<br><br>

		<span class=header>Subtasks:</span><br>{$subtasks}
		
		<span class=header>Work logs:</span><br> {$work_logs}
	</div>
	
</body>
</html>		
HTML;

	}

	public static function renderTeamMembers($teamMemberArr) {
		$html = "";
		for ($i=0; $i<count($teamMemberArr); $i++) {
			$html .= "<a href=''>" . $teamMemberArr[$i] . "</a>, ";
		}
		return $html;
	}
	
	public static function renderSubtasks($main_task_id, $subtasksArr) {
		$html = "<ul>";
		for ($i=0; $i<count($subtasksArr); $i++) {
			$subtaskPageId = $subtasksArr[$i];
			$subtaskPageData = TaskopediaData::getTaskPageData($main_task_id, $subtaskPageId);
			$subtaskTitle = $subtaskPageData["title"];
			$html .= "<li><a href=''>" . $subtaskTitle . "</a></li>";
		}
		$html .= "</ul>";
		return $html;
	}
	
	public static function renderWorkLogs($workLogArr) {
		$html = "";
		for ($i=0; $i<count($workLogArr); $i++) {
			$workLog = $workLogArr[$i];
			foreach ($workLog as $key => $value) {
				$name = $key;
				$content = $value;
				$html .= "<b>$name</b>: " . $content;
			}
			$html .= "<br>";
		}
		return $html;
	}
	
}

?>