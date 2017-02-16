<?php
/*
Plugin Name: Hola Free Video Player
Plugin URI: http://holacdn.com/player
Description: The Hola Free Video Player is VideoJS on steroids, a commercial grade, flexible video player, which provides your users the best viewing experience.
Version: 1.3.2
Author: Hola Networks
Author URI: http://holacdn.com/player
*/

/**
 * Basic plugin definitions
 *
 * @package Hola Video Player
 * @since 1.0.0
 */
if(!defined('HVP_DIR')) {
  define('HVP_DIR', dirname(__FILE__));      // Plugin dir
}
if(!defined('HVP_VERSION')) {
  define('HVP_VERSION', '1.3.2');      // Plugin Version
}
if(!defined('HVP_URL')) {
  define('HVP_URL', plugin_dir_url(__FILE__));   // Plugin url
}
if(!defined('HVP_INC_DIR')) {
  define('HVP_INC_DIR', HVP_DIR.'/includes');   // Plugin include dir
}
if(!defined('HVP_INC_URL')) {
  define('HVP_INC_URL', HVP_URL.'includes');    // Plugin include url
}
if(!defined('HVP_ADMIN_DIR')) {
  define('HVP_ADMIN_DIR', HVP_INC_DIR.'/admin');  // Plugin admin dir
}
if(!defined('HVP_PREFIX')) {
  define('HVP_PREFIX', 'hvp'); // Plugin Prefix
}
if(!defined('HVP_TEXTDOMAIN')) {
  define('HVP_TEXTDOMAIN', 'wphvp'); // Plugin Textdomain
}
if(!defined('HVP_VAR_PREFIX')) {
  define('HVP_VAR_PREFIX', '_hvp_'); // Variable Prefix
}

// Include MISC functions file
include_once(HVP_INC_DIR.'/hvp-misc-functions.php');

/**
 * Load Text Domain
 *
 * This gets the plugin ready for translation.
 *
 * @package Hola Video Player
 * @since 1.0.0
 */
load_plugin_textdomain('wphvp', false, dirname(plugin_basename(__FILE__)) . '/languages/');

/**
 * Activation Hook
 *
 * Register plugin activation hook.
 *
 * @package Hola Video Player
 * @since 1.0.0
 */
register_activation_hook(__FILE__, 'hvp_install');
function hvp_install() {
	add_option('hvp_firstrun','hvp-plugin-activated');
  add_option('hvp-cdn-customerid', '');
}

/**
 * Deactivation Hook
 *
 * Register plugin deactivation hook.
 *
 * @package Hola Video Player
 * @since 1.0.0
 */
register_deactivation_hook(__FILE__, 'hvp_uninstall');

function hvp_uninstall(){
}

// Global variables
global $hvp_scripts, $hvp_model, $hvp_shortcode, $hvp_admin;

// Script class handles most of script functionalities of plugin
include_once(HVP_INC_DIR.'/class-hvp-scripts.php');
$hvp_scripts = new Hvp_Scripts();
$hvp_scripts->add_hooks();

// Model class handles most of model functionalities of plugin
include_once(HVP_INC_DIR.'/class-hvp-model.php');
$hvp_model = new Hvp_Model();

// Shortcode class handles shortcodes of plugin
include_once(HVP_INC_DIR.'/class-hvp-shortcodes.php');
$hvp_shortcode = new Hvp_Shortcode();
$hvp_shortcode->add_hooks();


// Admin class handles most of admin panel functionalities of plugin
include_once(HVP_ADMIN_DIR.'/class-hvp-admin.php');
$hvp_admin = new Hvp_Admin();
$hvp_admin->add_hooks();

//includes widget file
require_once (HVP_INC_DIR . '/widgets/class-hvp-widget.php');
