<?php
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.', 'glow') );
	} else {
	$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'welcome';
?>


<div class="wrap about-wrap">

	<h1><?php _e( 'Welcome to GLOW', 'glow' ); ?></h1>


<div class="dash-head">

	<div class="about-text">
		<?php _e('GLOW works automatically box.<br /> You can find some tools and information here.', 'glow' ); ?>
	</div>

	<a target="GLOW_CLICK" href="<?php echo get_home_url(); ?>" class="admin-button" style="background: #DC3022 ;border-color: transparent;"><span>Visit <?php echo bloginfo( 'name' ); ?> </span></a>

</div>


    <!-- Output for Options Page -->

        	<h2 class="nav-tab-wrapper">
				<a href="?page=dashboard" class="nav-tab <?php echo $active_tab == 'welcome'  ? 'nav-tab-active' : ''; ?>">
				<?php _e( 'Home', 'glow' ); ?></a>
				
				<a href="<? echo home_url();?>/bbstyle/" target="_blank" class="nav-tab">
				<?php _e( 'Style Page', 'glow' ); ?></a>

				<a href="?page=dashboard&tab=tab3" class="nav-tab <?php echo $active_tab == 'tab3'  ? 'nav-tab-active' : ''; ?>">
				<?php _e( 'Error Log', 'glow' ); ?></a>

				<a href="?page=dashboard&tab=tab4" class="nav-tab <?php echo $active_tab == 'tab4'  ? 'nav-tab-active' : ''; ?>">
				<?php _e( 'PHP Info', 'glow' ); ?></a>
				
				<a href="<?php echo admin_url(); ?>" class="nav-tab">
				<?php _e( 'Visit DashBoard', 'glow' ); ?></a>
				

			</h2>


<div class="wrap glow-general">

			<?php

			if( $active_tab == 'welcome' ) {

				require_once(G1T_PLUGIN_DIR . '/includes/inserts/site-info.php');




				}

				elseif ( $active_tab == 'tab2' )  {
					require_once('dashboard-stats.php');
				}


				

				elseif ( $active_tab == 'tab3' )  {
					//require_once('dashboard-logs.php');
					//echo nl2br( $file );

				
				}


				elseif ( $active_tab == 'tab4' )  {
				
				 echo '<style>a:link, body {background-color:initial!important;}</style>';

					phpinfo();

				
				}
				
				





				}

// blog posts

				require_once('dashboard_news.php');


?>



</div>
</div><!-- // wrap -->
