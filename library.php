<?php

/**
 *
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

		if ( empty( $transient_body ) ) {
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
			set_transient( $transient, $data_body, DAY_IN_SECONDS );

		}

		return json_decode( $data_body, true );

	}

}
