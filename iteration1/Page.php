<?php

class Page {
	
	public function preHandle()  {
		
	}
	
	public function getWhole() {
		
		return "getWhole() is not set";
		
	}
	
}

/*

Note on preHandle function: Must be called before getWhole() and getContent() and getAddToHead(). The reason this function is needed is when creating the "Go to newly created task" and "Go back to parent task" buttons in CreateTaskSubmit. The getAddToHead function needs information calculated in the getContent function, the newly created task id and the parent task id. Theoretically this could work anyways because getContent is called before the getAddToHead function but is not good programming to rely on this. Therefor create a preHandle function that we ensure gets called before both getContent and getAddToHead. In that function we can set class variables that can be accessed in getContent and getAddToHead.

*/

?>