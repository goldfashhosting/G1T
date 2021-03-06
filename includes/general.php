<?php

// define hooks

function switch_menu_start() {
	do_action('switch_menu_start');
}

function switch_menu_end() {
	do_action('switch_menu_end');
}

function switch_menu_items_start() {
	do_action('switch_menu_items_start');
}

function bb_settings_end() {
    do_action('bb_settings_end');
}




// Remove Header Meta

function removeHeadLinks() {

	remove_action( 'wp_head', 'rsd_link');
	remove_action( 'wp_head', 'wlwmanifest_link');
	remove_action( 'wp_head', 'wp_generator');
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	remove_action('wp_head', 'index_rel_link'); // Removes the index page link
	remove_action('wp_head', 'start_post_rel_link', 10, 0); // Removes the random post link
	remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Removes the parent post link
	remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Removes the next and previous post links
}

add_action('init', 'removeHeadLinks');
remove_action('wp_head', 'wp_generator');



// custom admin login header logo



function my_custom_login_logo()
{
	echo '<style  type="text/css">body.login h1 a {  background-image:url("' .plugins_url( '../assets/img/logo_admin.png' , __FILE__ ) . '")!important; height: 80px!important; } </style>';
}
add_action('login_head',  'my_custom_login_logo');




// admin footer modification

function remove_footer_admin ()
{
	echo '<span>G1T Version: ' . G1T_VERSION_NUM .' | </span><span>Developed by <a href="http://goldfash.com" target="_blank">GOD1ST TECHNOLOGIES GROUP INC. - PenHubs Group & GoldFash Developers</a></span>';
}
add_filter('admin_footer_text', 'remove_footer_admin');




// Hide WordPress Update Notice To All But Admins

function hide_update_notice_to_all_but_admin_users()
{
	if (!current_user_can('update_core')) {
		remove_action( 'admin_notices', 'update_nag', 3 );
		remove_action( 'admin_notices', 'woothemes_updater_notice' );
	}
}

add_action( 'admin_notices', 'hide_update_notice_to_all_but_admin_users', 1 );




// change default woocommerce placeholder image

add_action( 'init', 'custom_fix_thumbnail' );

function custom_fix_thumbnail() {
	add_filter('woocommerce_placeholder_img_src', 'custom_woocommerce_placeholder_img_src');

	function custom_woocommerce_placeholder_img_src( $src ) {
		$child_placeholder = get_stylesheet_directory() .'/G1T/placeholder.jpg';
		$child_placeholder_uri = get_stylesheet_directory_uri() .'/G1T/placeholder.jpg';

	if (file_exists($child_placeholder)) :
		$src = $child_placeholder_uri;
	else :
		$src = plugins_url( '../assets/img/placeholder.jpg' , __FILE__ );
	endif;
		return $src;
	}
}






// always show admin bar
function G1T_login_adminbar( $wp_admin_bar) {
	if ( current_user_can('edit_posts') ) {
		return true;
	}

}

add_filter( 'show_admin_bar', 'G1T_login_adminbar' , 1000 );



// remove admin bar pushdown

add_action('get_header', 'my_filter_head');

function my_filter_head() {
	remove_action('wp_head', '_admin_bar_bump_cb', 10);
}


// canvas specifics //////////////////////////////////////////////////////////////////////

if (PARENT_THEME == 'canvas') {


	// remove canvas actions


	function remove_canvas_actions() {
		global $G1TGLOWPlugin;

		// remove woo inline styling
		if ( $G1TGLOWPlugin->get_setting('enable_woo_custom_css') != "yes") {
			remove_action( 'woothemes_wp_head_before', 'woo_enqueue_custom_styling', 9 );
		}

		// remove woo nav
		if ( $G1TGLOWPlugin->get_setting('remove_woo_nav') == "yes") {
			remove_action( 'woo_header_after','woo_nav', 10 );
		}

	}

	add_action('init','remove_canvas_actions');



	// canvas title - removes duplicate

	function bb_canvas_title( $text ) {

		$sep = '|';
		$text = wp_title( $sep, false, 'right' );
		return $text;

	}
	if (get_template() == 'canvas') {

		add_filter( 'woo_title', 'bb_canvas_title' );
	}

	// change archive template H1
	add_filter( 'woo_archive_title', 'new_woo_archive_title' );
	function new_woo_archive_title () {
		$category = single_cat_title("", false);
		$new_title = '<h1 class="archive_header">'. $category .'</h1>' ;
		return $new_title;
	} // End filter






} // Canvas Specifics



// hooks debug - all

add_action ('wp_head','debug_all_hooks', 120);

function debug_all_hooks() {

	// all debug
	$hooks = "";
	if (isset($_GET['debug_hooks'])) {
		$hooks = $_GET['debug_hooks'];
	}

	if ($hooks == 'all' ) {

		$debug_tags = array();
		add_action( 'all', function ( $tag ) {
				global $debug_tags;
				if ( is_array($debug_tags) && in_array( $tag, $debug_tags ) ) {
					return;
				}
				echo '<div class="debug-hooks debug-hooks-all"><i class="fa fa-dot-circle-o"></i><pre>' . $tag . '</pre></div>';
				$debug_tags[] = $tag;
			} );

	} // all debug ends
}


// woo debug

add_action ('init','debug_woo_hooks');

function debug_woo_hooks() {
	if (isset($_GET['debug_hooks']) ) {


		$woo_comm_hooks = "get_product_search_form,woocommerce_after_cart,woocommerce_after_cart_contents,woocommerce_after_cart_table,woocommerce_after_cart_totals,woocommerce_after_checkout_billing_form,woocommerce_after_checkout_form,woocommerce_after_checkout_registration_form,woocommerce_after_checkout_shipping_form,woocommerce_after_customer_login_form,woocommerce_after_main_content,woocommerce_after_mini_cart,woocommerce_after_my_account,woocommerce_after_order_notes,woocommerce_after_shipping_calculator,woocommerce_after_shop_loop,woocommerce_after_shop_loop_item,woocommerce_after_shop_loop_item_title,woocommerce_after_single_product,woocommerce_after_single_product_summary,woocommerce_after_subcategory,woocommerce_after_subcategory_title,woocommerce_archive_description,woocommerce_available_download_end,woocommerce_available_download_start,woocommerce_before_cart,woocommerce_before_cart_contents,woocommerce_before_cart_table,woocommerce_before_cart_totals,woocommerce_before_checkout_billing_form,woocommerce_before_checkout_form,woocommerce_before_checkout_registration_form,woocommerce_before_checkout_shipping_form,woocommerce_before_customer_login_form,woocommerce_before_main_content,woocommerce_before_mini_cart,woocommerce_before_my_account,woocommerce_before_order_notes,woocommerce_before_shipping_calculator,woocommerce_before_shop_loop,woocommerce_before_shop_loop_item,woocommerce_before_shop_loop_item_title,woocommerce_before_single_product,woocommerce_before_single_product_summary,woocommerce_before_subcategory,woocommerce_before_subcategory_title,woocommerce_cart_collaterals,woocommerce_cart_contents,woocommerce_cart_coupon,woocommerce_cart_has_errors,woocommerce_cart_is_empty,woocommerce_cart_totals_after_order_total,woocommerce_cart_totals_after_shipping,woocommerce_cart_totals_before_order_total,woocommerce_cart_totals_before_shipping,woocommerce_checkout_after_customer_details,woocommerce_checkout_before_customer_details,woocommerce_checkout_billing,woocommerce_checkout_order_review,woocommerce_checkout_shipping,woocommerce_email_after_order_table,woocommerce_email_before_order_table,woocommerce_email_footer,woocommerce_email_header,woocommerce_email_order_meta,woocommerce_order_details_after_order_table,woocommerce_order_items_table,woocommerce_proceed_to_checkout,woocommerce_product_meta_end,woocommerce_product_meta_start,woocommerce_product_thumbnails,woocommerce_review_order_after_cart_contents,woocommerce_review_order_after_order_total,woocommerce_review_order_after_shipping,woocommerce_review_order_after_submit,woocommerce_review_order_before_cart_contents,woocommerce_review_order_before_order_total,woocommerce_review_order_before_shipping,woocommerce_review_order_before_submit,woocommerce_share,woocommerce_sidebar,woocommerce_single_product_summary,woocommerce_thankyou,woocommerce_view_order,woocommerce_widget_shopping_cart_before_buttons";

		$woo_canvas_hooks="wp_head,woo_header_before,woo_header_inside,woo_header_after,woo_content_before,woo_main_before,woo_loop_before,loop_start,loop_end,woo_loop_after,woo_main_after,woo_content_after,woo_post_before,woo_post_inside_before,woo_post_inside_after,woo_post_after,woo_sidebar_before,woo_sidebar_inside_before,woo_sidebar_inside_after,woo_sidebar_after,woo_footer_top,woo_footer_before,woo_footer_inside,woo_footer_left_before,woo_footer_left_after,woo_footer_right_before,woo_footer_right_after,woo_footer_after,wp_head,wp_footer";


		if ($_GET['debug_hooks'] == 'woo_framework' ) {

			$csv_hooks = $woo_canvas_hooks;

		}

		elseif ($_GET['debug_hooks'] == 'woo_commerce' ) {

			$csv_hooks = $woo_comm_hooks;

		}

		elseif ($_GET['debug_hooks'] == 'woo_all' ) {

			$csv_hooks = $woo_comm_hooks.$woo_canvas_hooks;
		}

		elseif ($_GET['debug_hooks'] == 'none') {
			return;
		}



		$woo_explode=explode(",",$csv_hooks);
		$hook_qty = 0;
		foreach ($woo_explode as $tag) {

			add_action ($tag, function () use ($tag) {


					echo '<div class="debug-hooks debug-hooks-woo"><i class="fa fa-dot-circle-o"></i><pre class="action"><strong>' . $tag . '</strong><div class="debugHookToggle"> <i class="hooks-advanced fa fa-angle-up"></i></div></pre>';

					echo '<div class="hook_functions">';
					list_hooked_functions($tag);
					echo '<input onClick="this.select();" type="text" value="add_action(\'' . $tag .'\',\'your_function\');" >';
					echo '</div>';



					echo '</div>';


				});
			$hook_qty++;


		} // foreach


	} // woo_debug end




} // debug_hooks end







// hook functions output



function list_hooked_functions($tag=false){
	//$tag = 'woocommerce_single_product_summary';
	global $wp_filter;
	if ($tag) {
		$hook[$tag]=$wp_filter[$tag];
		if (!is_array($hook[$tag])) {
			trigger_error("Nothing found for '$tag' hook", E_USER_WARNING);
			return;
		}
	}
	else {
		$hook=$wp_filter;
		ksort($hook);
	}
	echo '<pre>';
	foreach($hook as $tag => $priority){
		//echo "<br />&gt;&gt;&gt;&gt;&gt;\t<strong>$tag</strong><br />";
		ksort($priority);
		foreach($priority as $priority => $function){
			echo $priority;
			foreach($function as $name => $properties) echo "\t$name<br />";
		}
	}
	echo '</pre>';
	return;
}









// Redirect Subscribers to Front Page


function cm_redirect_users_by_role() {

	$current_user   = wp_get_current_user();
	$role_name      = $current_user->roles[0];

	if ( 'subscriber' === $role_name ) {
		wp_redirect( '/' );
	} // if

} // cm_redirect_users_by_role
add_action( 'admin_init', 'cm_redirect_users_by_role' );



// deactivates raison core

deactivate_plugins( '/raison-core/raison-core.php' );








// Hide H1 Title

add_filter( 'the_title', 'wpse145940_hide_hidden_title', 10, 2 );

function wpse145940_hide_hidden_title( $title, $postid ) {
    if ( get_post_meta( $postid, 'hide_h1_title', true ) == true ) {
        $title = '';
    }

    return $title;
}





// redirect to G1T Dash on Login

function bb_dash_default() {

	global $G1TGLOWPlugin;		
	if ( $G1TGLOWPlugin->get_setting('disable_dash_welcome') != "yes") {	
	   return  admin_url( 'index.php?page=dashboard' );
	   }
}

add_filter('login_redirect', 'bb_dash_default');
	



// Add Menu Items
function G1T_options_panel(){  
  add_options_page('G1T Settings', 'G1T', 'manage_options', 'G1T-settings', 'bb_func_settings');
}

add_action('admin_menu', 'G1T_options_panel');




// Define new menu page content
function G1T_options() {

				require_once(G1T_PLUGIN_DIR.'/templates/dashboard.php');

}; 

function bb_func_settings(){
                echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div>
                <h2>Settings</h2></div>';
				require_once('menu_settings.php');

}


?>
