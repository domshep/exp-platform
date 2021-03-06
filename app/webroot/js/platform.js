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

function getImperialWeight(kgs)
{
	if(isNaN(kgs)) kgs = 0;
	
	if (kgs > 0){
		var newlbs = kgs * 2.20462;
		var newstones = Math.floor(newlbs / 14);
		newlbs = (newlbs - (newstones*14));
		newlbs = Math.floor(newlbs * 2) / 2;
		$(".lbs").val(newlbs);
		$(".stones").val(newstones);
	}
}


function getMetricWeight(stones, lbs)
{
    if(isNaN(stones)) stones = 0;
	if(isNaN(lbs)) lbs = 0;
	
	if (stones > -1 && lbs > -1){
		var newkgs = ((stones * 14) + lbs) / 2.20462;
		newkgs = Math.round(newkgs * 10)/10;
		$(".kgs").val(newkgs);
	}
	
	if (lbs >= 14){
		var newstone = ($(".stones").val()* 1) + 1;
		var newlbs = ($(".lbs").val()* 1) - 14;
		while (newlbs >= 14)
		{
			newstone = newstone + 1;
			newlbs = newlbs - 14;
		}
		$(".stones").val(newstone);
		$(".lbs").val(newlbs);
	}
	if (lbs < 0){
		$(".lbs").val(0);
	}
	
}
