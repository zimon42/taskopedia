function getHelp(field) {
	if (field == "title") {
		return "Here you specify the title of the task. For example: 'Study Wikipedias page on DIPG'";
	}
	if (field == "description") {
		return "Here you specify a longer description of the task, or background to why you wanto create this task. For example: 'By studying the wikipedia page on DIPG we can find more paths to solving the main task'";
	}
	if (field == "more_info") {
		return "Here you specify more information needed to solve the task, for example the link to the page: 'en.wikipedia.org/dipg'";
	}
	return "Error getHelp: No such field: "+field;
}
