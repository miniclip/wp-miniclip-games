<?php
/**
 *
 */


/**
 * Game embed Shortcode
 *
 * @param type $atts
 * @return string
 */
function mc_shortcode_game( $atts ) {

	$atts = shortcode_atts( array(
		'id' => 0,
	), $atts );

	extract( $atts );

	// nothing to do so lets go
	if ( empty( $id ) ) {
		return;
	}

	$mc_games = new miniclip_games();
	return $mc_games->embed_game( $id );

}

add_shortcode( 'game', 'mc_shortcode_game' );



/**
 * Game Category
 *
 * @param type $atts
 * @return type
 */
function mc_shortcode_category( $atts ) {

	$atts = shortcode_atts( array(
		'id' => 0,
	), $atts );

	extract( $atts );

	// nothing to do so lets go
	if ( empty( $id ) ) {
		return;
	}

	$mc_games = new miniclip_games();
	return $mc_games->embed_category( $id );

}

add_shortcode( 'game-category', 'mc_shortcode_category' );