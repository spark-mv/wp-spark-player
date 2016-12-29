<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Admin Class
 *
 * Manage Admin Panel Class
 *
 * @package Hola Video Player
 * @since 1.0.0
 */

class Hvp_Admin {

	public $model, $scripts;

	//class constructor
	function __construct() {

		global $hvp_model, $hvp_scripts;

		$this->scripts = $hvp_scripts;
		$this->model = $hvp_model;
	}

	function hvp_shortcode_button( $plugin_array ) {

		$plugin_array['hvp_video'] = HVP_INC_URL . '/js/hvp-shortcodes.js?ver='.HVP_VERSION;
		return $plugin_array;
	}

	function hvp_shortcode_display_button( $buttons ) {
		array_push( $buttons, "|", "hvp_video" );
		return $buttons;
	}

	/**
	 * Add shortcode button to post or page editor
	 * 
	 * @package Hola Video Player
	 * @since 1.0.0
	 */
	function hvp_add_shortcode_button() {

		if( current_user_can( 'manage_options' ) || current_user_can( 'edit_posts' ) ) {
			add_filter( 'mce_external_plugins', array( $this, 'hvp_shortcode_button' ) );
   			add_filter( 'mce_buttons', array( $this, 'hvp_shortcode_display_button' ) );
		}
		register_setting( 'hvp_plugin_options', 'hvp_options', array($this, 'hvp_validate_options') );
	}
	function hvp_validate_options( $input ) {
	
		// sanitize text input (strip html tags, and escape characters)
		$input['title']	=  $this->model->hvp_escape_slashes_deep( $input['hvp_activate_analytics'] );
		//$input = $this->model->wpd_ws_escape_slashes_deep($input);
		return $input;
	}
	/**
	 * Pop Up On Editor
	 *
	 * Includes the pop up on the WordPress editor
	 *
	 * @package Hola Video Player
	 * @since 1.0.0
	 */
	function hvp_shortcode_popup() {
		include_once( HVP_ADMIN_DIR . '/forms/hvp-admin-popup.php' );
	}
	 /**
	 * Add html field in general setting page
	 *
	 * @package Hola Video Player
	 * @since 1.0.0
	 */
	function hvp_general_settings_fields_html(){
		
		$activate_analytics = get_option('hvp_activate_analytics');
		if( $activate_analytics == '1' ){
			$display = "display:block";
		}else {
			$display = "display:none";
		}
	?>
	    <input name="hvp_activate_analytics" type="checkbox" id="hvp_activate_analytics" value="1" <?php checked('1', get_option('hvp_activate_analytics')); ?> />
	    <label><?php _e('Please Check for Activate analytics', HVP_TEXTDOMAIN ); ?></label><br>
	    <a href="mailto:or@hola.org?subject=activate video analytics" id="hvp_activate_analytics_link" style="<?php echo $display ; ?>"><?php _e('to activate free video analytics, contact us', HVP_TEXTDOMAIN ); ?></a>
	<?php
	}
	public function hvp_add_menu_page(){
		$hook = add_menu_page( __( 'Free video player', HVP_TEXTDOMAIN ), __( 'Free video player', HVP_TEXTDOMAIN ), 'manage_options', 'hvp_player_setting_page', array( $this, 'hvp_player_setting_page') );
	}
	
	/**
	 * Includes Plugin Settings
	 * 
	 * Including File for plugin settings
	 *
	 * @package Hola Video Player
	 * @since 1.0.0
	 */
	public function hvp_player_setting_page() {
		
		include_once( HVP_ADMIN_DIR . '/forms/hvp-plugin-settings.php' );
		
	}
	/**
	 * Adding Hooks
	 *
	 * @package Hola Video Player
	 * @since 1.0.0
	 */
	function add_hooks() {

		// add filters for add add button in post / page container
		add_action( 'admin_init', array( $this, 'hvp_add_shortcode_button' ) );
		// add admin menu for Hola video player setting page
		add_action( 'admin_menu', array( $this, 'hvp_add_menu_page' ) );

		// mark up for popup
		add_action( 'admin_footer-post.php', array( $this,'hvp_shortcode_popup' ) );
		add_action( 'admin_footer-post-new.php', array( $this,'hvp_shortcode_popup' ) );
	}
}
?>