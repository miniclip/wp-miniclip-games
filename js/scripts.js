var mcg_game_list = new Array();

;(function( $ ){
	// only do this stuff once everything has loaded
	$( window ).load( function(){

		function init_popup( target_id ) {

			var $popup = $( '<div class="mc-game-popup"></div>' );

			console.log( mcg_game_list[ target_id ] );

			$( 'body' ).append( $popup );
			$popup.html( decodeHtml(mcg_game_list[ target_id ]) );

			// add close button
			var close = $( '<a href="" class="mc-close-button">x</a>' );

			close.on( 'click', function( e ) {
				e.preventDefault();
				$( this ).parent().remove();
				return false;
			});

			$popup.append( close );

			// make the popup close when clicked
			$popup.on( 'click', function( e ) {
				e.preventDefault();
				e.stopPropagation();
				$( this ).remove();
				return false;
			});

			$popup.show();

			build_miniclip_game();
		}

		function decodeHtml(html) {
			var txt = document.createElement( "textarea" );
			txt.innerHTML = html;
			return txt.value;
		}

		// make the buttons pop open the game
		$( '.mc-game-play' ).on( 'click', function( e ) {
			e.preventDefault();

			var target_id = $( this ).data( 'target' );
			init_popup( target_id );

			return false;
		});

		$( '.mc-game-popup' ).each( function(){


		});

	});
})( jQuery );