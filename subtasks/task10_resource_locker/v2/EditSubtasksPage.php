<?php

class EditSubtasksPage {
	
	public function getContent() {
		$html = "";
		$html .= <<<HTML
<h3>Subtasks</h3>
<div id=subtask_list_div></div>
<button id=save_subtask_list_button>Save</button>
HTML;
		return $html;
	}
	
	public function getAddToHead() {
		$html = "";
		$html .= <<<HTML
<link rel="stylesheet" type="text/css" href="drag_list_module/dragable_list.css">
<script src=drag_list_module/DragableList.js></script>
<script>

var dragableList = new DragableList();

function addDragableSubtask(subtask) {
	$("#subtask_list_div").append(
		"<div class=block style='display:block'>"+ // <-- Changed none to block
		"    <div style='float:left;width:200px'>"+
	    "        <img class='cross no_select none_dragable' src=drag_list_module/cross.png width=20 height=20></img>"+
		"        <span id=vat_display style='position:relative;bottom:3px'>"+subtask.id+"</span>"+
		"    </div>"+
		"    <div style='float:left;width:275px;text-align:right'>"+
		"        <button id=vat_block_edit>Redigera</button>"+
		"        <button id=vat_block_remove>Ta bort</button>"+
		"    </div>"+
	    "</div>"
	);
	dragableList.update();
	
	// Attach subtask data to block
	$(".block:last").data(subtask);
}

$(document).ready(function() {
HTML;
		$subtasks_arr = JsonFileHandler::readPhpArray("subtasks.txt");
		for ($i=0; $i<count($subtasks_arr); $i++) {
			$subtask = $subtasks_arr[$i];
			$html .= "addDragableSubtask({id:'" . $subtask["id"] . "'});\n";
		}

		$html .= <<<HTML
		
	$("#save_subtask_list_button").click(function() {
		var arr = dragableList.getDataList();
		// join subtask id's
		var str = "";
		for (var i=0; i<arr.length; i++) {
			str += arr[i].id;
			if (i<arr.length-1)
				str += ",";
		}
		alert(str);
	});		
		
});


</script>
HTML;
		return $html;
	}
	
}

?>