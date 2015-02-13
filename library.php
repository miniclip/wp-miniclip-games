<?php

/**
 * Miniclip Games
 * A class that makes it easy to consume the Miniclip API data
 */
class miniclip_games {

	// default language
	private $language = 'en';


	/**
	 *
	 */
	public function __construct() {

		// set default language using WordPress localisation functionality
		$this->language = substr( get_locale(), 0, 2 );

	}


	/**
	 * Get the data for a specific game
	 *
	 * @param type $key
	 * @param type $language
	 * @return boolean
	 */
	public function get_game( $game_id, $language = null ) {

		if ( ! isset( $game_id ) ) {
			return false;
		}

		$game_id = (int) $game_id;

		if ( ! $language ) {
			$language = $this->language;
		}

		$data = $this->get( 'games/' . $game_id, $language );

		if ( is_wp_error( $data ) ) {
			return $data;
		}

		if ( isset( $data[ $game_id ] ) ) {
			return $data[ $game_id ];
		}

		return false;

	}


	/**
	 * Get the data for a specific category
	 *
	 * @param type $category_id
	 * @param type $language
	 * @return boolean
	 */
	public function get_category( $category_id, $language = null ) {

		if ( ! isset( $category_id ) ) {
			return false;
		}

		$category_id = (int) $category_id;

		if ( ! $language ) {
			$language = $this->language;
		}

		$data = $this->get( 'genre/' . $category_id, $language );

		if ( ! empty( $data ) ) {
			return $data;
		}

		return false;

	}


	/**
	 * get a list of all the categories
	 *
	 * @return boolean
	 */
	public function get_categories() {

		$data = $this->get( 'genre', '' );

		if ( ! empty( $data ) ) {
			return $data;
		}

		return false;

	}


	/**
	 * Generic method for accessing api data
	 *
	 * @param type $key
	 * @param type $language
	 * @return type
	 */
	public function get( $key, $language = null ) {

		if ( ! $language ) {
			$language = $this->language;
		}

		$path = esc_url( 'http://webmasters.miniclip.com/api/' . $key . '/' . $language . '.json' );

		$transient = 'mc_games_get_' . md5( $path );

		$data_body = get_transient( $transient );

		if ( empty( $data_body ) ) {

			$data = wp_remote_get( $path );

			// check if the data is valid - if not send error response
			if ( is_wp_error( $data ) ) {
				if ( WP_DEBUG ) {
					var_dump( $path );
					var_dump( $data );
				}
				return $data;
			}

			$data_body = wp_remote_retrieve_body( $data );

			// cache the data
			set_transient( $transient, $data_body, WEEK_IN_SECONDS );

		}

		return json_decode( $data_body, true );

	}


	/**
	 * embed a game in a page
	 *
	 * @param type $game_id
	 * @return string
	 */
	function embed_game( $game_id, $emebed_type = '' ) {

		$game_id = (int) $game_id;
		$game = $this->get_game( $game_id );

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
		<?php printf( __( 'Play %s', 'miniclip-games' ), $game['name'] ); ?>
	</a>
	<script>mcg_game_list[<?php echo $game['game_id']; ?>] = '<?php echo $game['embed']; ?>';</script>
<?php
				return ob_get_clean();

			}

		}

		return '';

	}


	/**
	 * list game categories
	 * @param type $category_id
	 * @return string
	 */
	function embed_category( $category_id = 0 ) {

		$quantity = 5;
		$category_id = (int) $category_id;

		$category = $this->get_category( $category_id );

		if ( $category && ! is_wp_error( $category ) ) {

			$count = 0;
			$html = '';

			foreach( $category as $game ) {
				if ( '1' == $game['is_webmaster_game'] ) {
					$html .= $this->embed_game( $game['game_id'] );
					$count ++;
				}

				if ( $count >= $quantity ) {
					break;
				}
			}

			return $html;

		}

		return '';

	}

}
