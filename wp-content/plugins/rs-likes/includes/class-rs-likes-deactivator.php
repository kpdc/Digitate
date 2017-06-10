<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://ratkosolaja.info/
 * @since      1.0.0
 *
 * @package    RS_Likes
 * @subpackage RS_Likes/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    RS_Likes
 * @subpackage RS_Likes/includes
 * @author     Ratko Solaja <me@ratkosolaja.info>
 */
class RS_Likes_Deactivator {

	/**
	 * Deactivate this plugin.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {

		// Delete all meta
		delete_post_meta_by_key( 'rs_like_voted_ips' );
		delete_post_meta_by_key( 'rs_like_value' );

	}

}