$(document).ready(function() {
	// Match all #calendar <a/> links with a title tag and use it as the content (default).
	$('#calendar a[title]').qtip();

	//Examples of how to assign the ColorBox event to in-line elements
	$(".info").colorbox({inline:true, width:"50%"});
});