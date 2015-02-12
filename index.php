<?php
/*
  Plugin Name: Miniclip Games
  Plugin URI: http://www.miniclip.com/webmasters/
  Description: Easily embed Miniclip Games content onto your website
  Author: Miniclip SA
  Author URI: http://www.miniclip.com/
  Text Domain: mc-games
  Version: 1.0.3

  Copyright 2014 Miniclip SA

  Licenced under the GNU GPL:

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 2 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

include( 'library.php' );
include( 'shortcode.php' );

/**
 * enqueue scripts and styles needed for the plugin to function
 */
function mcg_enqueue() {

	wp_enqueue_style( 'mcg-style', plugins_url( '/styles/styles.css', __FILE__ ), null, '1.0.2' );

	if ( WP_DEBUG ) {
		wp_enqueue_script( 'mcg-script', plugins_url( '/js/scripts.js', __FILE__ ), array( 'jquery' ), '1.0.3' );
	} else {
		// enqueue compressed version for production
		wp_enqueue_script( 'mcg-script', plugins_url( '/js/min/scripts-min.js', __FILE__ ), array( 'jquery' ), '1.0.3' );
	}

}

add_action( 'wp_enqueue_scripts', 'mcg_enqueue' );


/**
 * add the embed script to the page
 */
function mcg_foot_script() {
?>
	<script src="//static.miniclipcdn.com/js/game-embed.js"></script>
<?php
}

add_action( 'wp_footer', 'mcg_foot_script' );