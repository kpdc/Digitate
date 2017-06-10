<?php

/**
 * @link     http://ratkosolaja.info/
 * @since    1.0.0
 * @package  RS_Likes
 *
 * Plugin Name: Simplicity Likes
 * Plugin URI:  https://wordpress.org/plugins/rs-likes/
 * Description: Adds support for Likes.
 * Version:     1.1.0
 * Author:      Simplicity LLC
 * Author URI:  http://www.simplicity.rs/
 * License:     GNU General Public License version 3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: rs-likes
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 */
function activate_rs_likes() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rs-likes-activator.php';
	RS_Likes_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_rs_likes() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rs-likes-deactivator.php';
	RS_Likes_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_rs_likes' );
register_deactivation_hook( __FILE__, 'deactivate_rs_likes' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rs-likes.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_rs_likes() {
	$plugin = new RS_Likes();
	$plugin->run();
}
run_rs_likes();