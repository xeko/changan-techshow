jQuery(document).scroll(function () {
    jQuery.currentItem();
});
jQuery(document).ready(function ($) {
    $.currentItem();
    
    //$(‘#menu_top').hide();
    //Add class into menu if scroll page
    window.isBusy = false;

    $(window).scroll(function () {
        var hdr = $('#mmenu');

        if (hdr.offset().top !== 0) {
            if (!hdr.hasClass('shadow')) {
                hdr.addClass('shadow');
            }
        } else {
            hdr.removeClass('shadow');
        }
        
    });
    
    //Back to top
    $('#f_arrow').click(function(){
        $('body,html').animate({scrollTop:0},800);
    });

	$('.link_f').hover(function(){
        	imgSrc = $(this).attr('src');
        	$(this).attr('src', urlHome+'/img/link_f_mover.gif');
    	}, function(){
        	$(this).attr('src', imgSrc);
    	});
	$('.link_t').hover(function(){
        	imgSrc = $(this).attr('src');
        	$(this).attr('src', urlHome+'/img/link_t_mover.gif');
    	}, function(){
        	$(this).attr('src', imgSrc);
    	});
	$('.link_w').hover(function(){
        	imgSrc = $(this).attr('src');
        	$(this).attr('src', urlHome+'/img/link_w_mover.gif');
    	}, function(){
        	$(this).attr('src', imgSrc);
    	});

	$('#about-us').find('.col-xs-12').wrapInner('<div class="wc"></div>');


	   var height_menu = $("#top_menu").css("height");
    	height_menu = parseInt(height_menu + 20, 10);
    	$('#main-nav').localScroll({offset: {top: -height_menu}, duration: 1000});
    	$('#menu_top').localScroll({offset: {top: -height_menu}, duration: 1000});


        $('.panel-group').click(function(){
            
        });
});