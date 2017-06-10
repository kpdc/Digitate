<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://ratkosolaja.info/
 * @since      1.0.0
 *
 * @package    RS_Likes
 * @subpackage RS_Likes/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    RS_Likes
 * @subpackage RS_Likes/admin
 * @author     Ratko Solaja <me@ratkosolaja.info>
 */
class RS_Likes_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles( $hook ) {

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

		if ( 'tools_page_rs-likes' != $hook ) {
			return;
		}
		

		wp_enqueue_style( $this->plugin_name . '-font-roboto', 'https://fonts.googleapis.com/css?family=Roboto:400,500,500italic,300&subset=latin,latin-ext', array(), '', 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rs-likes-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts( $hook ) {

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

		if ( 'tools_page_rs-likes' != $hook ) {
			return;
		}

		// wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rs-likes-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the page for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function register_admin_page() {

		// add_submenu_page ( string $parent_slug, string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '' )
		add_submenu_page(
			'tools.php',
			__( 'Simplicity Likes', 'rs-likes' ),
			__( 'Simplicity Likes', 'rs-likes' ),
			'manage_options',
			'rs-likes',
			array( $this, 'display_admin_page' )
		);

	}

	/**
	 * Display the page for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function display_admin_page() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/rs-likes-admin-display.php';

	}

	/**
	 * Settings callbacks.
	 *
	 * @since    1.0.0
	 */
	public function sandbox_setting_callback( $input ) {

		$new_input = array();

		if ( isset( $input ) ) {
			foreach ( $input as $key => $value ) {
				if ( $key == 'post-type' ) {
					$new_input[ $key ] = $value;
				} else {
					$new_input[ $key ] = sanitize_text_field( $value );
				}
			}
		}

		return $new_input;

	}

	/**
	 * Register settings.
	 *
	 * @since    1.0.0
	 */
	public function register_settings() {

		// Settings
		register_setting(
			$this->plugin_name . '-settings',
			$this->plugin_name . '-settings',
			array( $this, 'sandbox_setting_callback' )
		);

		// Section
		add_settings_section(
			$this->plugin_name . '-settings-section',
			__( 'Settings', 'rs-likes' ),
			array( $this, 'sandbox_settings_section_callback' ),
			$this->plugin_name . '-settings'
		);

		// Fields
		add_settings_field(
			'toggle-content-override',
			__( 'Do you want us to add the like button to the end of your content:', 'rs-likes' ),
			array( $this, 'sandbox_toggle_content_override_callback' ),
			$this->plugin_name . '-settings',
			$this->plugin_name . '-settings-section',
			array(
				'label_for' => $this->plugin_name . '-settings[toggle-content-override]'
			)
		);
		add_settings_field(
			'post-type',
			__( 'Add like button to these post types:', 'rs-likes' ),
			array( $this, 'sandbox_post_type_callback' ),
			$this->plugin_name . '-settings',
			$this->plugin_name . '-settings-section'
		);
		add_settings_field(
			'toggle-css',
			__( 'Do you want to use our styling for likes:', 'rs-likes' ),
			array( $this, 'sandbox_toggle_css_callback' ),
			$this->plugin_name . '-settings',
			$this->plugin_name . '-settings-section'
		);
		add_settings_field(
			'toggle-color',
			__( 'Do you want to paint the heart in red when there is at least one like?', 'rs-likes' ),
			array( $this, 'sandbox_toggle_color_callback' ),
			$this->plugin_name . '-settings',
			$this->plugin_name . '-settings-section'
		);
		add_settings_field(
			'like-text',
			__( 'Your "Like" text. Default: Like', 'rs-likes' ),
			array( $this, 'sandbox_like_text_callback' ),
			$this->plugin_name . '-settings',
			$this->plugin_name . '-settings-section'
		);
		add_settings_field(
			'dislike-text',
			__( 'Your "Dislike" text. Default: Undo Like', 'rs-likes' ),
			array( $this, 'sandbox_dislike_text_callback' ),
			$this->plugin_name . '-settings',
			$this->plugin_name . '-settings-section'
		);

	}

	/**
	 * Section callbacks.
	 *
	 * @since    1.0.0
	 */
	public function sandbox_settings_section_callback() {

		return;

	}

	/**
	 * Field callbacks.
	 *
	 * @since    1.0.0
	 */
	public function sandbox_toggle_content_override_callback() {

		$options = get_option( $this->plugin_name . '-settings' );
		$option = 0;

		if ( ! empty( $options['toggle-content-override'] ) ) {
			$option = $options['toggle-content-override'];
		}

		?>

		<input type="checkbox" name="<?php echo $this->plugin_name . '-settings'; ?>[toggle-content-override]" id="<?php echo $this->plugin_name . '-settings'; ?>[toggle-content-override]" <?php checked( $option, 1, true ); ?> value="1" />

		<?php

	}

	public function sandbox_post_type_callback() {

		$options = get_option( $this->plugin_name . '-settings' );
		$option = array();

		if ( ! empty( $options['post-type'] ) ) {
			$option = $options['post-type'];
		}

		$args = array(
			'public' => true
		);
		$post_types = get_post_types( $args, 'names' );

		foreach ( $post_types as $post_type ) {
			if ( $post_type != 'attachment' ) {
				$checked = in_array( $post_type, $option ) ? 'checked="checked"' : '';
				?>

					<div class="rs-input-row">
						<input type="checkbox" id="<?php echo $this->plugin_name; ?>-settings[post-type]" name="<?php echo $this->plugin_name; ?>-settings[post-type][]" value="<?php echo esc_attr( $post_type ); ?>" <?php echo $checked; ?> />
						<span class="rs-input-label"><?php echo $post_type; ?>	</span>
					</div>

				<?php
			}
		}

	}

	public function sandbox_toggle_css_callback() {

		$options = get_option( $this->plugin_name . '-settings' );
		$option = 0;

		if ( ! empty( $options['toggle-css'] ) ) {
			$option = $options['toggle-css'];
		}

		?>

		<input type="checkbox" name="<?php echo $this->plugin_name . '-settings'; ?>[toggle-css]" id="<?php echo $this->plugin_name . '-settings'; ?>[toggle-css]" <?php checked( $option, 1, true ); ?> value="1" />

		<?php

	}

	public function sandbox_toggle_color_callback() {

		$options = get_option( $this->plugin_name . '-settings' );
		$option = 0;

		if ( ! empty( $options['toggle-color'] ) ) {
			$option = $options['toggle-color'];
		}

		?>

		<input type="checkbox" name="<?php echo $this->plugin_name . '-settings'; ?>[toggle-color]" id="<?php echo $this->plugin_name . '-settings'; ?>[toggle-color]" <?php checked( $option, 1, true ); ?> value="1" />

		<?php

	}

	public function sandbox_like_text_callback() {

		$options = get_option( $this->plugin_name . '-settings' );
		$option = __( 'Like', 'rs-like' );

		if ( ! empty( $options['like-text'] ) ) {
			$option = $options['like-text'];
		}

		?>

			<input type="text" id="<?php echo $this->plugin_name; ?>-settings[like-text]" name="<?php echo $this->plugin_name; ?>-settings[like-text]" value="<?php echo esc_attr( $option ); ?>">

		<?php

	}

	public function sandbox_dislike_text_callback() {

		$options = get_option( $this->plugin_name . '-settings' );
		$option = __( 'Undo Like', 'rs-like' );

		if ( ! empty( $options['dislike-text'] ) ) {
			$option = $options['dislike-text'];
		}

		?>

			<input type="text" id="<?php echo $this->plugin_name; ?>-settings[dislike-text]" name="<?php echo $this->plugin_name; ?>-settings[dislike-text]" value="<?php echo esc_attr( $option ); ?>">

		<?php

	}

}