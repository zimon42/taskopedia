<?php

include_once("SkeletonPage.php");
include_once("TaskHandler.php");

class EditSubtasksPage extends SkeletonPage {
	
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
		$taskParams = TaskHandler::getTaskParams($this);		
		$html = "";
		$html .= <<<HTML
<link rel="stylesheet" type="text/css" href="drag_list_module/dragable_list.css">
<script src=drag_list_module/DragableList.js></script>
<script src=resource_locker_module/ResourceLocker.js></script>

<script>

var dragableList = new DragableList();

function addDragableSubtask(subtask) {
	$("#subtask_list_div").append(
		"<div class=block style='display:block'>"+ // <-- Changed none to block
		"    <div style='float:left;width:200px'>"+
	    "        <img class='cross no_select none_dragable' src=drag_list_module/cross.png width=20 height=20></img>"+
		"        <span id=vat_display style='position:relative;bottom:3px'>"+cutEnding(subtask.title)+"</span>"+
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
	
	// Clicked remove block button
	$(".block:last #vat_block_remove").click(function(event) {
		var \$btn = $(event.target);
		\$deletingBlock = \$btn.parents(".block");
		\$deletingBlock.slideUp(deletingBlockSlidedUp);
	});
	
	
}

var \$deletingBlock;
function deletingBlockSlidedUp() {
	\$deletingBlock.remove();
	dragableList.update();
}

// Cut subtask titles if they are too long
function cutEnding(str) {
	if (str.length < 20) return str;
	else return str.substring(0,20) + "...";
}

$(document).ready(function() {
	// addDragableSubtask({id:'10000001', title:'Title 1'});
	// addDragableSubtask({id:'10000002', title:'Title 2'});
	// addDragableSubtask({id:'10000003', title:'Title 3'});

HTML;
		// Call addDragableSubtask for all subtasks:
		$parentTaskId = TaskopediaData::getTaskPageId($this->taskType, $this->mainTaskId, $this->taskId);
		$parentTaskArr = TaskopediaData::getTaskPageData($this->mainTaskId, $parentTaskId);
		$subtaskIdsArr = $parentTaskArr["subtasks"];
		for ($i=0; $i<count($subtaskIdsArr); $i++) {
			$subtaskId = $subtaskIdsArr[$i];
			$subtaskArr = TaskopediaData::getTaskPageData($this->mainTaskId, $subtaskId);
			$html .= "	addDragableSubtask({id:'" . $subtaskId . "',title:'". $subtaskArr["title"] . "'});\n";
		}		
		$html .= <<<HTML
		
	$("#save_subtask_list_button").click(function() {
		ResourceLocker.save_resource(
		{
			save_page: getResourceSavePage()
		}
		);
	});		
		
});

function getResourceCurrentState() {
	var arr = dragableList.getDataList();
	// join subtask id's
	var str = "";
	for (var i=0; i<arr.length; i++) {
		str += arr[i].id;
		if (i<arr.length-1)
			str += ",";
	}
	return str;
}

function getResourceIdentifier() {
	return "maintask_{$this->mainTaskId}_subtask_{$this->taskId}_subtasks";
}

function getResourceSavePage() {
	return "index.php?page=save_subtasks_submit&$taskParams";
}

ResourceLocker.start();

</script>

HTML;
		return $html;
	}
	
}

?>