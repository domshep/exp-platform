// JavaScript Document

$(document).ready(function(){
	$('div#fontsize').html('Font size <a class="fontsize" id="font_s" href="#">A</a> <a class="fontsize" id="font_m" href="#">A</a> <a class="fontsize" id="font_l" href="#">A</a> <a class="fontsize" id="font_xl" href="#">A</a>' );

	$('.fontsize').click(function(e){
		e.preventDefault();
		changeFontSize(this.id);
	});
					
	$('#font_m').addClass('selectedfont');
					
});

function changeFontSize(size) {
	$('.fontsize').removeClass('selectedfont');
	
	if (size == "font_s")
		$('body').css('fontSize', '0.65em');
	else if (size == "font_l")
		$('body').css('fontSize', '1.0em');
	else if (size == "font_xl")
		$('body').css('fontSize', '1.4em');
	else
		$('body').css('fontSize', '0.75em');
					
	$('#' + size).addClass('selectedfont');
	//set a cookie
	var today = new Date();
	today.setTime(today.getTime());
	var expires_date = new Date(today.getTime() + (5 * 1000 * 60 * 60 * 24));
	
	document.cookie = 'fontsize_1053=' + escape(size) + ";expires=" + expires_date.toGMTString() + ';path=/';
}