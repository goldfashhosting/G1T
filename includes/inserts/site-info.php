<?php

// get woocommerce version

$woo_version = 'not installed';

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	function wpbo_get_woo_version_number() {
	        // If get_plugins() isn't available, require it
		if ( ! function_exists( 'get_plugins' ) )
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	
	        // Create the plugins folder and file variables
		$plugin_folder = get_plugins( '/' . 'woocommerce' );
		$plugin_file = 'woocommerce.php';
	
		// If the plugin version number is set, return it
		if ( isset( $plugin_folder[$plugin_file]['Version'] ) ) {
			return $plugin_folder[$plugin_file]['Version'];
	
		} else {
		// Otherwise return null
			return NULL;
		}
	}
	
		
	$woo_version = wpbo_get_woo_version_number();


}

function G1TViews(){
		//Gets Views from api Json
		$url = 'https://goldfash.com/views/wp.api?url='.$_SERVER['HTTP_HOST'];
		$args = array( 'timeout' => 7, 'httpversion' => '1.1' ) ;
		$response = wp_remote_get( $url, $args );
		return $response;	
	}

// get WP version

global $wp_version;

// get theme information

	$views = G1TViews();
	$thisView = json_decode($views['body']);
	$child_theme = wp_get_theme('');
	$childVersion = $child_theme->get( 'Version' );
	//$childAuthor = $child_theme->get( 'Author' );

	if ($childVersion == 0) $childVersion = 'No Version Number';
	global $parent_theme_name;

	?>

<div class="scroll">
	<h3>G1T Analytic Info</h3>

	<table id="site-info">
		<tr>
			<th></th>
			<th>All</th>
			<th>Unique</th>
			<th>Source</th>
		</tr>
		<tr>
			<td>Views</td>
			<td><a><? echo $thisView->a1; ?></a></td>
			<td><a><?php echo $thisView->a2; ?></a></td>
			<td><?php echo $thisView->Source; ?></td>
		</tr>

		

	</table>

	<br />
	<hr>

<?php

$notavailable = 'Not Available';

	if (!function_exists('phpversion')) {
		$php = $notavailable;
	} else {
		$php = phpversion();
	}

	if (!function_exists('getMySqlVersion')) {
		$mysql = $notavailable;
	} else {
		$mysql = getMySqlVersion();
	}

	if (!function_exists('apache_get_version')) {
		$apache = $notavailable;
	} else {
		$apache = apache_get_version();
	}

		$plugins = get_option('active_plugins', array());

		$n = 0;
		foreach ( $plugins as $plugin ) {
			$n++;
		}


	echo '<h3>Site Info</h3>';


echo '<table><tbody>';
if ( WP_DEBUG ) { echo '<tr><td>Debug</td><td>Enabled - Site in Development <i class="fa fa-wrench"></i></td></tr>'; } else { echo '<tr><td>Debug</td><tr><i class="fa fa-globe"></i> WP Debug Not Enabled: Site Live</td></tr>'; }
echo '<tr><td>G1T Version</td><td>' . G1T_VERSION_NUM .'</td></tr>';
echo '<tr><td>Wordpress Version</td><td>'. $wp_version . '</td></tr>';
if ($woo_version) echo '<tr><td>WooCommerce Version</td><td>'. $woo_version . '</td></tr>';
echo '<tr><td>Active Plugins</td><td>' . $n . '</td></tr>';
echo '<tr><td>Language</td><td>'. get_locale() . '</td></tr>';
echo '<tr><td>PHP Version</td><td>'. $php . '</td></tr>';
echo '<tr><td>MySQL Version</td><td>'. $mysql . '</td></tr>';
echo '<tr><td>Apache Version</td><td>'. $apache . '</td></tr>';
echo '<tr><td>WP Memory Limit</td><td>' . WP_MEMORY_LIMIT . '</td></tr>';



echo '</tbody></table>';

?>

	<hr>


<h3>Image Sizes</h3>

<?php

 function list_thumbnail_sizes(){
     global $_wp_additional_image_sizes;
     	$sizes = array();
 		foreach( get_intermediate_image_sizes() as $s ){
 			$sizes[ $s ] = array( 0, 0 );
 			if( in_array( $s, array( 'thumbnail', 'medium', 'large' ) ) ){
 				$sizes[ $s ][0] = get_option( $s . '_size_w' );
 				$sizes[ $s ][1] = get_option( $s . '_size_h' );
 			}else{
 				if( isset( $_wp_additional_image_sizes ) && isset( $_wp_additional_image_sizes[ $s ] ) )
 					$sizes[ $s ] = array( $_wp_additional_image_sizes[ $s ]['width'], $_wp_additional_image_sizes[ $s ]['height'], );
 			}
 		}
 
 		echo '<table><tbody>';
 		foreach( $sizes as $size => $atts ){
 			echo '<tr><td>';
 			echo $size . '</td><td>' . implode( 'x', $atts ) . "\n";
 			echo '</td></tr>';
 			
 		}
 		echo '</table></tbody>';

 }
 
    
    list_thumbnail_sizes();
    
    
  
  ?>


<?php do_action('info_panel_items'); ?>

</div>