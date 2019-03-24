ResourceLocker = function() {}

var resource_saved_state;

ResourceLocker.editButtonClickHandler = function (args) {
	$.post(
	"resource_locker_module/edit_button_click_handler.php",
	{
		res_id: args.res_id,
		user_name: args.user_name
	},
	function (data, status) {
		var arr = JSON.parse(data);
		var resource_acquired = arr["resource_acquired"];
		var user_name = arr["resource_user_name"];
		if (!resource_acquired) {
			alert("Resource is locked. It is currently being edited by "+user_name);
		}
		else {
			// alert("Resource is free");
			location=args.edit_page;
		}
	}
	);
}

ResourceLocker.save_resource = function(args) {
	$.post(
		args.save_page,
		{
			res_state: getResourceCurrentState()
		},
		function (data, status) {			
			alert("Your resource has been saved");
		}
	);
	resource_saved_state = getResourceCurrentState();
}

ResourceLocker.exit_resource = function(args) {
	if (resource_saved_state != getResourceCurrentState()) {
		if (confirm("Do you wanto save your work before you exit?")) {
			$.post(
				args.save_page,
				{
					res_state: getResourceCurrentState()
				},
				function (data, status) {			
				}
			);			
		}
	}
	location="index.php";
}
