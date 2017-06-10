<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://ratkosolaja.info/
 * @since      1.0.0
 *
 * @package    RS_Likes
 * @subpackage RS_Likes/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    RS_Likes
 * @subpackage RS_Likes/public
 * @author     Ratko Solaja <me@ratkosolaja.info>
 */
class RS_Likes_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$options = get_option( $this->plugin_name . '-settings' );
		
		if ( ! empty( $options['toggle-css'] ) && $options['toggle-css'] == 1 ) {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rs-likes-public.css', array(), $this->version, 'all' );
		}

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		$options = get_option( $this->plugin_name . '-settings' );
		$like = __( 'Like', 'rs-like' );
		$dislike = __( 'Undo Like', 'rs-like' );

		if ( ! empty( $options['like-text'] ) ) {
			$like = $options['like-text'];
		}
		if ( ! empty( $options['dislike-text'] ) ) {
			$dislike = $options['dislike-text'];
		}

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rs-likes-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script(
			$this->plugin_name,
			'rs_like_ajax',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'like_txt' => $like,
				'undo_txt' => $dislike
			)
		);

	}

	/**
	 * Override 'the_content'.
	 *
	 * @since    1.0.0
	 */
	public function override_content( $content ) {

		$options = get_option( $this->plugin_name . '-settings' );
		$post_types = array();
		$toggle = 0;

		if ( ! empty( $options['post-type'] ) ) {
			$post_types = $options['post-type'];
		}
		if ( ! empty( $options['toggle-content-override'] ) ) {
			$toggle = $options['toggle-content-override'];
		}

		if ( $toggle == 1 && ! empty( $post_types ) && is_singular() ) {
			$post_id = get_queried_object_id();
			foreach ( $post_types as $post_type ) {
				$current_post_type = get_post_type( $post_id );
				if ( $current_post_type == $post_type ) {
					$custom_content = '';
					ob_start();
					echo $this->get_like_object_display();
					$custom_content .= ob_get_contents();
					ob_end_clean();
					$content = $content . $custom_content;
				}
			}
		}

		return $content;

	}

	/**
	 * Check User IP
	 *
	 * @since    1.0.0
	 */
	public function check_user_IP() {

		$client  = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  = $_SERVER['REMOTE_ADDR'];

		if ( filter_var( $client, FILTER_VALIDATE_IP ) ) {
			$IP = $client;
		} elseif ( filter_var( $forward, FILTER_VALIDATE_IP ) ) {
			$IP = $forward;
		} else {
			$IP = $remote;
		}

		return $IP;

	}

	/**
	 * Like Object
	 *
	 * @since    1.0.0
	 */
	public function like_object() {

		if ( ! wp_verify_nonce( $_REQUEST['nonce'], 'rs_object_like' ) ) {
			die;
		}

		$voted = false;
		$object_id = isset( $_REQUEST['object_id'] ) ? intval( $_REQUEST['object_id'] ) : 0;
		$currentIP = $this->check_user_IP();
		$currentIP = (string) $currentIP;
		$votedIPs = get_post_meta( $object_id, 'rs_like_voted_ips', true );
		$currentValue = get_post_meta( $object_id, 'rs_like_value', true );

		if ( ! empty( $currentValue ) ) {
			$currentValue = $currentValue;
		} else {
			$currentValue = 0;
		}

		if ( empty( $votedIPs ) ) {
			$votedIPs = array();
		}

		if ( isset( $_COOKIE['rs_like_' . $object_id] ) ) {
			$voted = true;
		} else {
			$voted = false;
		}

		if ( in_array( $currentIP, $votedIPs ) ) {
			$voted = true;
			unset( $votedIPs[array_search( $currentIP, $votedIPs )] );
		} else {
			$voted = false;
			array_push( $votedIPs, $currentIP );
		}

		if ( $voted == true ) {
			$return = array(
				'update' => $voted,
				'value'  => $currentValue - 1
			);
			update_post_meta( $object_id, 'rs_like_voted_ips', $votedIPs );
			update_post_meta( $object_id, 'rs_like_value', $currentValue - 1 );
		} else {
			$return = array(
				'update' => $voted,
				'value'  => $currentValue + 1
			);
			update_post_meta( $object_id, 'rs_like_voted_ips', $votedIPs );
			update_post_meta( $object_id, 'rs_like_value', $currentValue + 1 );
		}

		return wp_send_json( $return );

	}

	/**
	 * Set nocache constants and headers.
	 *
	 * @since    1.0.5
	 * @access   private
	 */
	private static function nocache() {
		if ( ! defined( 'DONOTCACHEPAGE' ) ) {
			define( "DONOTCACHEPAGE", true );
		}
		if ( ! defined( 'DONOTCACHEOBJECT' ) ) {
			define( "DONOTCACHEOBJECT", true );
		}
		if ( ! defined( 'DONOTCACHEDB' ) ) {
			define( "DONOTCACHEDB", true );
		}
		nocache_headers();
	}

	/**
	 * Like post button.
	 *
	 * @since    1.0.0
	 */
	public function get_like_object_display() {

		self::nocache();

		if ( is_singular() ) {
			$object_id = get_queried_object_id();
		} else {
			$object_id = get_the_ID();
		}
		$voted = false;

		$currentIP = $this->check_user_IP();
		$currentIP = (string) $currentIP;
		$votedIPs = get_post_meta( $object_id, 'rs_like_voted_ips', true );

		$currentValue = get_post_meta( $object_id, 'rs_like_value', true );
		if ( ! empty( $currentValue ) ) {
			$currentValue = $currentValue;
		} else {
			$currentValue = 0;
		}

		if ( empty( $votedIPs ) ) {
			$votedIPs = array();
		}

		if ( isset( $_COOKIE['rs_like_' . $object_id] ) ) {
			$voted = true;
		} else {
			$voted = false;
		}

		if ( in_array( $currentIP, $votedIPs ) ) {
			$voted = true;
		} else {
			$voted = false;
		}

		$options = get_option( $this->plugin_name . '-settings' );
		$like = __( 'Like', 'rs-like' );
		$dislike = __( 'Undo Like', 'rs-like' );

		if ( ! empty( $options['like-text'] ) ) {
			$like = $options['like-text'];
		}
		if ( ! empty( $options['dislike-text'] ) ) {
			$dislike = $options['dislike-text'];
		}
		if ( ! empty( $options['toggle-color'] ) && $options['toggle-color'] == 1 ) {
			if ( ! empty( $currentValue ) && $currentValue >= 1 ) {
				$color_class = 'has-likes';
			} else {
				$color_class = '';
			}
		} else {
			$color_class = '';
		}

		$html_to_return = '';
		$inner_html_to_return = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64" height="64" viewBox="0 0 64 64"><path d="M46 4c-4.808 0-8.662 1.726-12.060 5.126-0.002 0.002-0.004 0.004-0.006 0.006h-0.002l-1.932 2.434-1.932-2.286c-0.002-0.002-0.004-0.004-0.006-0.006h-0.002c-3.4-3.402-7.252-5.274-12.060-5.274s-9.328 1.872-12.728 5.272c-3.398 3.4-5.272 7.92-5.272 12.728 0 4.804 1.87 9.324 5.266 12.722l23.894 24.094c0.75 0.758 1.774 1.184 2.84 1.184s2.090-0.426 2.84-1.184l23.892-24.094c3.396-3.398 5.268-7.916 5.268-12.722 0-4.808-1.874-9.328-5.272-12.728-3.4-3.4-7.92-5.272-12.728-5.272v0z"></path></svg>';

		if ( $voted == true ) {
			$html_to_return .= '<a href="#" class="like-button liked ' . $color_class . '" data-toggle="tooltip" data-placement="top" data-title="' . esc_attr( $dislike ) . '" data-count="' . esc_attr( $currentValue ) . '" data-nonce="' . wp_create_nonce( 'rs_object_like' ) . '" data-object-id="' . esc_attr( $object_id ) . '">';
			$html_to_return .= apply_filters( 'rs_likes_html', $inner_html_to_return );
			$html_to_return .= '</a>';
		} else {
			$html_to_return .= '<a href="#" class="like-button ' . $color_class . '" data-toggle="tooltip" data-placement="top" data-title="' . esc_attr( $like ) . '" data-count="' . esc_attr( $currentValue ) . '" data-nonce="' . wp_create_nonce( 'rs_object_like' ) . '" data-object-id="' . esc_attr( $object_id ) . '">';
			$html_to_return .= apply_filters( 'rs_likes_html', $inner_html_to_return );
			$html_to_return .= '</a>';
		}

		return $html_to_return;

	}

	/**
	 * Create advanced search shortcode.
	 *
	 * @since    1.0.0
	 */
	public function likes_shortcode() {

		return $this->get_like_object_display();

	}

}