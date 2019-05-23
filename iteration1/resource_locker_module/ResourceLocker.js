ResourceLocker = function() {}

var num_times_no_change = 0;
var max_times_no_change = 3;
var resource_previous_state;
var resource_saved_state;

ResourceLocker.start = function() {
	resource_previous_state = getResourceCurrentState();
	resource_saved_state = getResourceCurrentState();
	setInterval(update_resource_latest_time, 2500);
	setInterval(update_resource_no_change, 20*60*1000); // 20 minutes
}

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
			console.log("data: "+data);
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

function update_resource_latest_time() {
	console.log("update_resource_latest_time");
	$.post(
	"resource_locker_module/update_resource_latest_time.php",
	{
		res_id: getResourceIdentifier()
	},
	function (data, status) {			
	}
	);
}

function update_resource_no_change() {
	resource_current_state = getResourceCurrentState();
	if (resource_current_state != resource_previous_state) {
		num_times_no_change = 0;
		resource_previous_state = getResourceCurrentState();
	}
	else {
		num_times_no_change++;
		if (num_times_no_change >= max_times_no_change) {
			unlock_not_changed_resource();
		}
	}
}

function unlock_not_changed_resource() {
	console.log("unlock not changed resource");
	$.post(
		"resource_locker_module/unlock_not_changed_resource.php",
		{
			res_id: getResourceIdentifier()
		},
		function (data, status) {			
			if (typeof should_exit_without_save !== 'undefined') {
				alert("Due to inactivity this resource has been released and you will be exited");
				location = "index.php";
			}
			$.post(
				getResourceSavePage(),
				{
					res_id: getResourceIdentifier(),
					res_state: getResourceCurrentState()
				},
				function (data, status) {			
					alert("Due to inactivity your work has been saved and you will be exited");
				}
			);
			location="index.php";
		}
	);	
}