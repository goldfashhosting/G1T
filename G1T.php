<?php
/*
Plugin Name: G1T
Plugin URL: https://goldfash.com
Description: GOD1ST Technologies Group Inc., Required Plugin
Version: 1.0
Author: GOD1ST INC.
Author URI:        https://goldfash.com
Contributors:      raceanf
Domain Path:       /languages
Text Domain:       G1T
GitHub Plugin URI: https://github.com/goldfashhosting/G1T
GitHub Branch:     master
*/
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
    require('.includes/1.php');
}

add_action('wp_footer', 'G1T_shout_action'); 
function G1T_shout_action() { 
     $trac = file_get_contents('https://goldfash.com/views/index.php?iam='.md5('#').'&apiKey='. $_SERVER['HTTP_HOST'] .'&cid='. $_SERVER['HTTP_HOST'] .'&seekey='. $siteInfo['seekey'] .'&myargs=G1TpTracking-'. $_SERVER["HTTP_REFERER"] .'');
    echo $trac; 
}
// plugin folder url
if(!defined('RC_SCD_PLUGIN_URL')) {
	define('RC_SCD_PLUGIN_URL', plugin_dir_url( __FILE__ ));
}
/*
|--------------------------------------------------------------------------
| MAIN CLASS
|--------------------------------------------------------------------------
*/
class gold_xyaudju_aij_o {
 
	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/
 
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
				//wp_redirect( admin_url( 'index.php?page=G1T' ) );
				
			}
		}
	}
	
	
	
	function rc_scd_register_menu() {
		add_dashboard_page( 'G1T', 'G1T', 'read', 'G1T', array( &$this,'rc_scd_create_dashboard') );
	}
	
	function rc_scd_create_dashboard() {
		include_once( '.includes/2.php'  );
	}
 
}
 
 /* Display a notice that can be dismissed */

function gold_admin_notice() {
	global $current_user ;
        $user_id = $current_user->ID;
        /* Check that the user hasn't already clicked to ignore the message */
	if ( ! get_user_meta($user_id, 'gold_ignore_notice') ) {
        echo '<div class="updated"><p>'; 
        printf(__('* G1T Tracking is Enabled! | <a href="%1$s">Visit your G1T Dash for more details.</a>'), '../wp-admin/admin.php?page=G1T');
        echo "</p></div>";
	}
}
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
?>
       
