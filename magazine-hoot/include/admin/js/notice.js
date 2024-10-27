jQuery(document).ready(function($) {
	"use strict";

	$('#maghoot-welcome-msg .notice-dismiss').on('click',function(e){
		e.preventDefault();
		if( 'undefined' != typeof maghoot_admin_notice && 'undefined' != typeof maghoot_admin_notice.nonce && 'undefined' != typeof maghoot_admin_notice.dismiss_action ) {
			jQuery.ajax({
				url : ajaxurl, // maghoot_admin_notice.ajax_url
				type : 'post',
				data : {
					'action': maghoot_admin_notice.dismiss_action,
					'nonce': maghoot_admin_notice.nonce
				},
				success : function( response ) {}
			}); //$.post(ajaxurl, data);
		}
	});

	$( '.maghoot-btn-processplugin' ).click( function ( e ) {
		e.preventDefault();
		if ($(this).hasClass('disabled')) {
			return;
		}

		if( 'undefined' != typeof maghoot_admin_notice && 'undefined' != typeof maghoot_admin_notice.nonce && 'undefined' != typeof maghoot_admin_notice.maghoot_processplugin_action ) {

			var $this = $( this );
			var origText = $this.text();
			var activeText = $this.hasClass( 'maghoot-btn-smallmsg' ) ? 'Processing...' : maghoot_admin_notice.maghoot_processplugin_btntext;
			var pluginName = $(this).attr('data-plugin');
			$this.nextAll('.error').remove();
			$this.addClass( 'updating-message disabled' ).text( activeText );
			jQuery.ajax({
				url : ajaxurl, // maghoot_admin_notice.ajax_url
				type : 'post',
				data : {
					'action': maghoot_admin_notice.maghoot_processplugin_action,
					'nonce': maghoot_admin_notice.nonce,
					'plugin': pluginName ? pluginName : 'hoot-import',
				},
				success : function( response ) {
					console.log(response);
					if ( response.redirect ) {
						window.location.href = response.redirect;
					} else {
						$this.removeClass( 'updating-message disabled' ).text( origText );
						if ( response.errorInstall ) {
							var $errorDiv = $('<div class="error">' + response.errorInstall + '</div>');
							$this.after( $errorDiv );
							$errorDiv.delay(5000).fadeOut( 400, function() { $(this).remove(); } );
						} else if ( response.errorMessage ) {
							var $errorDiv = $('<div class="error">' + response.errorMessage + '</div>');
							$this.after( $errorDiv );
							$errorDiv.delay(5000).fadeOut( 400, function() { $(this).remove(); } );
						}
					}
				},
				error   : function( xhr, ajaxOptions, thrownError ){
					$this.removeClass( 'updating-message disabled' ).text( origText );
					console.log(thrownError);
				}
			}); //$.post(ajaxurl, data);

		}

	} );

});