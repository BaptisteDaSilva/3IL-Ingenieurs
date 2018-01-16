$(document).ready(function() {
    $('.carte').append('<div class="overlay">');
    $('.carte area').mouseover(function() {
        var index = $(this).index();
        var left = -index * 400 - 400;
        $('.carte .overlay').css({
            backgroundPosition: left + 'px 0px'
        });
    });
    $('.carte').mouseout(function() {
        $('.carte .overlay').css({
            backgroundPosition: '400px 0px'
        });
    });
});