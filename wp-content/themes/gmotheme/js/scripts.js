jQuery(document).scroll(function () {
    jQuery.currentItem();
});
jQuery(document).ready(function ($) {
    $.currentItem();
    
    //Back to top
    $('#f_arrow').click(function () {
        $('body,html').animate({scrollTop: 0}, 800);
    });


    var height_menu = $("#top_menu").css("height");
    height_menu = parseInt(height_menu, 10) + 60;
    $('#main-nav').localScroll({offset: {top: -height_menu}, duration: 300});
    $('#menu_top').localScroll({offset: {top: -height_menu}, duration: 300});

});