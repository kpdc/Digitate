<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://ratkosolaja.info/
 * @since      1.0.0
 *
 * @package    RS_Likes
 * @subpackage RS_Likes/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    RS_Likes
 * @subpackage RS_Likes/includes
 * @author     Ratko Solaja <me@ratkosolaja.info>
 */
class RS_Likes_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'rs-likes',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

}