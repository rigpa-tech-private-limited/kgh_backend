(function ( $ ) {
 
    $.fn.smplmnu = function(options) {

    	var settings = $.extend({
            background: "#EAD636",
            speed: "0.5s",
            textColor: "#fff"
        }, options );

    	var hittrigger = $(this);
    	var clspos = hittrigger.next('ul');
    	var menutextcolor = hittrigger.next('ul li a');
    	var overllay = '<div class="overally"></div>';
    	hittrigger.addClass('inrwrpr');
    	clspos.addClass('inrwrpr');
    	$('.inrwrpr').wrapAll( "<div class='navwrp'>" );
    	clspos.prepend('<a href="javascript:void(0)" class="mnuclose ion-close-round"><span>X</span></a>');
    	$('body').prepend(overllay);
        hittrigger.click(function(event){
			hittrigger.next('ul').addClass('mobimenu');
		    $('.mobimenu').addClass('mnuopn');
		    $('.mnuopn').css({
		    	'z-index': '9999',
		    	'background-color': settings.background,
		    	'transition': settings.speed
		    });
		    $('.mnuopn a').css({
		    	'color': settings.textColor
		    });
		    $('.overally').addClass('ovrActv');
		});

        $('.mnuclose').click(function(event) {
			hittrigger.next('ul').removeClass('mnuopn');
			$('.overally').removeClass('ovrActv');
		});

		$('.overally').click(function(event) {
			clspos.removeClass('mnuopn');
			$(this).removeClass('ovrActv')
		});
		return this				
    };
 
}( jQuery ));