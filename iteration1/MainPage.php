<?php

include_once("Page.php");

class MainPage extends Page {
	
	public function getWhole() {
		$html = "";
		$html .= <<<HTML
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="main_page.css">
<script src=jquery.js></script>
<script>
$(document).ready(function() {
	$("#go_to_task_button").click(function() {
		location="index.php?page=main_task_page&main_task_id=00000001";
	});
});
</script>
</head>
<body>		


	<div id=top_bar>
		<img src="puzzle_piece.png" id=logo_img width="65"/>
		<span id=taskopedia_title>Taskopedia</span><br>
		<span id=taskopedia_subtitle>- People coming together to solve complex tasks</span>
	</div>

	<hr>

	<span id=current_tasks_title>Current tasks:</span>

	<div class=main_task>
		<b>Main task</b>: <a href="index.php?page=main_task_page&main_task_id=00000001" class=main_task_link>Finding treatments for DIPG cancer</a><br>
		<b>Background:</b> DIPG stands for Diffuse intrinsic pontine glioma and is a type of brain cancer that effects children. There is currently no cure. We will change that. Together we will find treatments for DIPG!<br>
		<button id=go_to_task_button>Go to task</button>
	</div>

	<span id=about_taskopedia_title>About taskopedia:</span>

	<p>Taskopedia is a platform where people come together to solve complex tasks. There is currently only one task at Taskopedia: Finding treatments for DIPG cancer, see above. All computer resources will be focused on solving this task. Perhaps in the future more tasks can be added. 
	</p>

	<p>The strenghts with Taskopedia are:
		<ol>
			<li>Dividing tasks into subtasks. I don't like using war metaphores but it was Julius Caesar who coined the expression "Divide and conquer". By breaking a task down into smaller subtasks, solving the task becomes more manageable.</li>
			<li>People coming together. After having broken the task into subtasks, different users can be assigned to different tasks, making it possible to solve the task more efficiently, solving subtasks in parallell</li>
			<li>Using work-logs. As you progress in solving a subtask, you write down your progress in a so called work-log, like a diary. Here you can write down what you google, which web pages you visit, what book you read. In this way you can for example backtrack and try other paths in sovling a task
		</ol>
	</p>
	
	<span id=taskopedia_videos_title>Taskopedia videos:</span>

	<p>Here are som videos on how to use Taskopedia</p>

	<ol id=video_list>
		<li><a href=videos/short_intro.mp4>Short introduction</a></li>
		<li><a href=videos/taskpage_overview.mp4>Overview of the task page</a></li>
		<li><a href=videos/work_process.mp4>The work process</a></li>
		<li><a href=videos/join_team.mp4>Joining a task team</a></li>		
		<li><a href=videos/create_task.mp4>Creating a new subtask</a></li>
		<li><a href=videos/reorder_task.mp4>Reordering subtasks</a></li>
		<li><a href=videos/move_task.mp4>Moving subtasks</a></li>
		<li><a href=videos/delete_task.mp4>Deleting subtasks</a></li>
	</ol>
	
</body>
</html>
HTML;
		return $html;
	}
		
}

?>