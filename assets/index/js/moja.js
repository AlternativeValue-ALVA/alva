$(function() {
    $('ul.nav a, .row a').bind('click',function(event){
	var $anchor = $(this);
	$('[data-spy="scroll"]').each(function () {
	var $spy = $(this).scrollspy('refresh')
	});
	$('html, body').stop().animate({
	scrollTop: $($anchor.attr('href')).offset().top
	}, 600);
	event.preventDefault();
	});
});

$(function() {
$.backstretch("assets/index/img/bg.jpg");
});