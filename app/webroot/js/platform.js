$(document).ready(function() {
	// Match all #calendar <a/> links with a title tag and convert to a qtip.
	$('#calendar a[title]').qtip();
	
	// Match all .info <a/> links with a title tag and convert to a qtip.
	$('a.info[title]').qtip();
	$('a.infohover[title]').qtip();

	//Examples of how to assign the ColorBox event to in-line elements
	$("a.info").colorbox({inline:true, width:"50%"});
});