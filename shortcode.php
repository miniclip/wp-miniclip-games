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

	$game_id = (int) $id;

	$mc_games = new miniclip_games();

	$game = $mc_games->get_game( $game_id );

	if ( ! is_wp_error( $game ) ) {

		if ( ! empty( $game['embed'] ) ) {
			// decode so we can modify it a bit
			$game['embed'] = html_entity_decode( $game['embed'] );
			$game['embed'] = preg_replace('#(<script)(.*)(script>)#si', '', $game['embed']);

			// encode again
			$game['embed'] = htmlentities( $game['embed'] );

			ob_start();
?>
	<a href="<?php echo $game['game_path']; ?>" data-target="<?php echo $game['game_id']; ?>" class="mc-game-play">
		<img src="<?php echo esc_url( $game['big_icon'] ); ?>" />
		<?php printf( __( 'Play %s' ), $game['name'] ); ?>
	</a>
	<script>mcg_game_list[<?php echo $game['game_id']; ?>] = '<?php echo $game['embed']; ?>';</script>
<?php
			return ob_get_clean();
		}

	}

	return '';

}

add_shortcode( 'game', 'mc_shortcode_game' );