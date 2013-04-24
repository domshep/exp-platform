$(document).ready(function() {
	// Match all #calendar <a/> links with a title tag and convert to a qtip.
	$('#calendar a[title]').qtip();
	
	// Match all .info <a/> links with a title tag and convert to a qtip.
	$('a.info[title]').qtip();
	$('a.infohover[title]').qtip();

	//Examples of how to assign the ColorBox event to in-line elements
	$("a.info").colorbox({inline:true, width:"50%"});
});

function getImperialHeight(cms)
{
	if(isNaN(cms)) cms = 0;
	
	if (cms > 0){
		var newfeet = Math.floor(cms / 30.48);
		var newinches = (cms / 2.54);
		newinches = (newinches - (newfeet*12));
		newinches = Math.round(newinches * 10)/10;
		$(".feet").val(newfeet);
		$(".inches").val(Math.round(newinches * 10)/10);
	}
}

function getMetricHeight(feet, inches)
{
    if(isNaN(feet)) feet = 0;
	if(isNaN(inches)) inches = 0;
	
	if (feet > -1 && inches > -1){
		var newcm = Math.round(((feet * 12) + inches) * 2.54);
		$(".cms").val(newcm);
	}
	
	if (inches >= 12){
		var newfeet = ($(".feet").val()* 1) + 1;
		var newinches = ($(".inches").val()* 1) - 12;
		while (newinches >= 12)
		{
			newfeet = newfeet + 1;
			newinches = newinches - 12;
		}
		$(".feet").val(newfeet);
		$(".inches").val(newinches);
	}
	if (inches < 0){
		$(".inches").val(0);
	}
	
}