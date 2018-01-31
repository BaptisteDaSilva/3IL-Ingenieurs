var slideWidth;
var sliderUlWidth;
var slideRatio;

var autoPlay;
var timeOut;

var auto = true;

var timeAutoPlay = 3000;
var timeTimeOut= 5000;

function startAutoPlay() {
	autoPlay = setInterval(moveRight, timeAutoPlay);
	
	auto = true;
};

function stopAutoPlay() {
	clearInterval(autoPlay);
	
	auto = false;
};

function moveLeftUtil() {	
	stopAutoPlay();
	clearTimeout(timeOut);
	
    $('#slider ul').animate({
        left: + slideWidth
    }, 50, function () {
        $('#slider ul li:last-child').prependTo('#slider ul');
        $('#slider ul').css('left', '');
    });
    
    timeOut = setTimeout(startAutoPlay, timeTimeOut);
};

function moveRightUtil() {
	stopAutoPlay();
	clearTimeout(timeOut);
	
	moveRight();
    
    timeOut = setTimeout(startAutoPlay, timeTimeOut);
};

function moveRight() {	
    $('#slider ul').animate({
        left: - slideWidth
    }, 200, function () {
        $('#slider ul li:first-child').appendTo('#slider ul');
        $('#slider ul').css('left', '');
    });
};

jQuery(document).ready(function ($) {
	startAutoPlay();
	
	slideCount = $('#slider ul li').length;
	slideWidth = $('#slider').width();
	slideRatio = $('#slider').height() / slideWidth;
	sliderUlWidth = slideCount * slideWidth;
		
	$('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
	
	$('#slider ul li').css({ width: sliderUlWidth/slideCount });
	
    $('#slider ul li:last-child').prependTo('#slider ul');

    $('a.control_prev').click(function () {
        moveLeftUtil();
    });

    $('a.control_next').click(function () {
    	moveRightUtil();
    });
});

window.onresize = function()
{	
	slideWidth = $('#slider').width();
	sliderUlWidth = slideCount * slideWidth;
	
	var slideHeight = slideRatio * slideWidth;
	
	$('#slider').css({ height: slideHeight });
	
	$('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
	
	$('#slider ul li').css({ width: sliderUlWidth/slideCount });
}