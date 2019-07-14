<?php
// http://localhost/taskopedia/subtasks/task6_json_file_handler/test_quote_marks/edit.php
?>
<html>
<head>
<script src=jquery.js></script>
<script>
$(document).ready(function() {
	$("#submit_button").click(function() {
		content = $("#content").val();
		location="submit.php?content=" + content;
	});
});
</script>
</head>
<body>
<textarea id=content>
</textarea>
<button id=submit_button>Submit</button>
</body>
</html>