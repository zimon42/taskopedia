function DragableList() {

	var numBlocks = 0;
	var $blocks;
	var $crosses;
	var $spaces;
	var isDraggingBlock = false;
	var $draggingBlock;
	var $moveToSpace;
	
	this.getNumBlocks = function() {
		return numBlocks;
	}
	
	function addSpaces() {
		var $blocks = $(".block");
		$blocks.each(function(index) {
			$block = $(this);
			$block.after("<div class=space></div>");
			if (index==0) {
				$block.before("<div class=space></div>");			
			}
		});
	}

	function update() {
		numBlocks = $(".block").length;
		$(".space").remove();
		addSpaces();
		initVariables();
		initListeners();
	}
	
	this.update = update;
	
	function initVariables() {
		$blocks = new Array(numBlocks);
		$crosses = new Array(numBlocks);
		$spaces = new Array(numBlocks+1);
		for (var i=0; i<numBlocks; i++) {
			$blocks[i] = $(".block").eq(i); // $("#"+blockIds[i]);
			$crosses[i] = $(".cross").eq(i); // $("#"+crossIds[i]);
			$spaces[i] = $(".space").eq(i);
		}
		// Put space after last block:
		$spaces[numBlocks] = $(".space").eq(numBlocks);		
	}
	
	function initListeners() {
		
		// Mouse down on cross
		for (var i=0; i<numBlocks; i++) {
			$crosses[i].mousedown(function(event) {
				// var crossId = event.target.id;
				// var index = getCrossIndex(crossId);
				// isDraggingBlock = true;
				// draggingBlockIndex = index;
				isDraggingBlock = true;
				var crossIndex = $(".cross").index($(event.target));
				$draggingBlock = $blocks[crossIndex];
				$("body").css("cursor","move");
			});
		}		

		// Mouse enter on space
		for (var i=0; i<numBlocks+1; i++) {
			$spaces[i].mouseenter(function(event) {
				if (isDraggingBlock) {
					// var spaceId = event.target.id;
					// var index = getSpaceIndex(spaceId);
					// $spaces[index].css("background-color","lightyellow");
					$space = $(event.target);
					$space.css("background-color","lightyellow");
				}
			});
		}

		// Mouse leave space
		for (var i=0; i<numBlocks+1; i++) {		
			$spaces[i].mouseleave(function(event) {
				if (isDraggingBlock) {
					// var spaceId = event.target.id;
					// var index = getSpaceIndex(spaceId);
					// $spaces[index].css("background-color","white");
					$space = $(event.target);
					$space.css("background-color","white");
				}
			});
		}
		
		// Mouse up on space
		for (var i=0; i<numBlocks+1; i++) {		
			$spaces[i].mouseup(function(event) {
				if (isDraggingBlock) {
					$moveToSpace = $(event.target);
					$("body").css("cursor","auto");					
					moveBlock_Step1();	
				}		
			});	
		}		
		
	}
	
	var moveBlock_Step1 = function() {
		// alert("moveBlock_Step1");
		// $moveBlock = $blocks[draggingBlockIndex];
		// $moveBlock.slideUp(250, moveBlock_Step2);
		$draggingBlock.slideUp(250, moveBlock_Step2);
	}	
	
	var moveBlock_Step2 = function() {
		// Move block
		
		/*
		if (toSpaceIndex < numBlocks)
			$blocks[toSpaceIndex].before($blocks[draggingBlockIndex]);
		else
			$blocks[toSpaceIndex-1].after($blocks[draggingBlockIndex]);
	
		$moveBlock = $blocks[draggingBlockIndex];
		$moveBlock.slideDown(250, moveBlock_Step3);

		// Remove all spaces:
		$(".space").remove();
		
		// Add all spaces again:
		init();
		*/
		
		$moveToSpace.after($draggingBlock);
		update();
		$draggingBlock.slideDown(250, moveBlock_Step3);
		
	}	
	
	var moveBlock_Step3 = function() {
		update();
	}
	
}
