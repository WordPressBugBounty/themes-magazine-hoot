jQuery(document).ready(function($) {
	"use strict";

	$('.maghoot-abouttheme-top').on('click',function(e){
		var $target = $( $(this).attr('href') );
		if ( $target.length ) {
			e.preventDefault();
			var destin = $target.offset().top - 50;
			$("html:not(:animated),body:not(:animated)").animate({ scrollTop: destin}, 500 );
		}
	});

	$('.maghoot-abouttabs .nav-tab, .maghoot-about-sub .linkto-tab, .maghoot-abouttabs .linkto-tab').on('click',function(e){
		e.preventDefault();
		var targetid = $(this).data('tabid'),
			$navtabs = $('.maghoot-abouttabs .nav-tab'),
			$tabs = $('.maghoot-abouttabs .maghoot-tab'),
			$target = $('#maghoot-'+targetid);
		if ( $target.length ) {
			$navtabs.removeClass('nav-tab-active');
			$navtabs.filter('[data-tabid="'+targetid+'"]').addClass('nav-tab-active');
			$tabs.removeClass('maghoot-tab-active');
			$target.addClass('maghoot-tab-active');
			var destin = $target.offset().top - 150;
			$("html:not(:animated),body:not(:animated)").animate({ scrollTop: destin}, 200 );
		}
	});

	$('#maghoot-welcome-msg .notice-dismiss').on('click',function(e){
		if( 'undefined' != typeof maghoot_dismissible_notice && 'undefined' != typeof maghoot_dismissible_notice.nonce && 'undefined' != typeof maghoot_dismissible_notice.ajax_action ) {
			// e.preventDefault();
			jQuery.ajax({
				url : ajaxurl, // maghoot_dismissible_notice.ajax_url
				type : 'post',
				data : {
					'action': maghoot_dismissible_notice.ajax_action,
					'nonce': maghoot_dismissible_notice.nonce
				},
				success : function( response ) {}
			}); //$.post(ajaxurl, data);
		}
	});

});