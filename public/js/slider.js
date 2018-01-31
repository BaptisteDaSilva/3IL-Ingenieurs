var slideWidth;
var sliderUlWidth;
var slideRatio;

jQuery(document).ready(function ($) {
    setInterval(function () {
        moveRight();
    }, 1000);
	
	slideCount = $('#slider ul li').length;
	slideWidth = $('#slider').width();
	slideRatio = $('#slider').height() / slideWidth;
	sliderUlWidth = slideCount * slideWidth;
		
	$('#slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });
	
	$('#slider ul li').css({ width: sliderUlWidth/slideCount });
	
    $('#slider ul li:last-child').prependTo('#slider ul');

    function moveLeft() {    	
        $('#slider ul').animate({
            left: + slideWidth
        }, 50, function () {
            $('#slider ul li:last-child').prependTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    function moveRight() {
        $('#slider ul').animate({
            left: - slideWidth
        }, 200, function () {
            $('#slider ul li:first-child').appendTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    $('a.control_prev').click(function () {
        moveLeft();
    });

    $('a.control_next').click(function () {
        moveRight();
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