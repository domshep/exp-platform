$(document).ready(function() {
	// Smooth scroll for "Back to top"
	$('a[href=#top]').click(function() {
		$('html, body').animate({scrollTop:0}, 'slow');
		return false;
	});
	
	$(".alert").alert();
	
	// Match all #calendar <a/> links with a title tag and convert to a qtip.
	$('#calendar a[title]').tooltip({html:true});
	
	// Match all .info <a/> links with a title tag and convert to a qtip.
	$('a.info[title]').tooltip();
	$('a.infohover[title]').tooltip();
});

function getImperialHeight(cms)
{
	if(isNaN(cms)) cms = 0;
	
	if (cms > 0){
		var newfeet = Math.floor(cms / 30.48);
		var newinches = (cms / 2.54);
		newinches = (newinches - (newfeet*12));
		newinches = Math.round(newinches * 10)/10;
		$("input[id$='Feet']").val(newfeet);
		$("input[id$='Inches']").val(Math.round(newinches * 10)/10);
	}
}

function getMetricHeight(feet, inches)
{
    if(isNaN(feet)) feet = 0;
	if(isNaN(inches)) inches = 0;
	
	if (feet > -1 && inches > -1){
		var newcm = Math.round(((feet * 12) + inches) * 2.54);
		$("input[id$='Cm']").val(newcm);
	}
	
	if (inches >= 12){
		var newfeet = ($("input[id$='Feet']").val()* 1) + 1;
		var newinches = ($("input[id$='Inches']").val()* 1) - 12;
		while (newinches >= 12)
		{
			newfeet = newfeet + 1;
			newinches = newinches - 12;
		}
		$("input[id$='Feet']").val(newfeet);
		$("input[id$='Inches']").val(newinches);
	}
	if (inches < 0){
		$("input[id$='Inches']").val(0);
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
		$("input[id$='Lbs']").val(newlbs);
		$("input[id$='Stones']").val(newstones);
	}
}


function getMetricWeight(stones, lbs)
{
    if(isNaN(stones)) stones = 0;
	if(isNaN(lbs)) lbs = 0;
	
	if (stones > -1 && lbs > -1){
		var newkgs = ((stones * 14) + lbs) / 2.20462;
		newkgs = Math.round(newkgs * 10)/10;
		$("input[id$='Kg']").val(newkgs);
	}
	
	if (lbs >= 14){
		var newstone = ($("input[id$='Stones']").val()* 1) + 1;
		var newlbs = ($("input[id$='Lbs']").val()* 1) - 14;
		while (newlbs >= 14)
		{
			newstone = newstone + 1;
			newlbs = newlbs - 14;
		}
		$("input[id$='Stones']").val(newstone);
		$("input[id$='Lbs']").val(newlbs);
	}
	if (lbs < 0){
		$("input[id$='Lbs']").val(0);
	}
	
}
