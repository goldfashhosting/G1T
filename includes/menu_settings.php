<?php

// Settings

global $G1TGLOWPlugin; // we'll need this below


$default_plugins = $G1TGLOWPlugin->get_setting('req_plugins_arr','multiarray');


// reset settings

if (isset($_GET["reset"])) { reset_settings(); exit; }

function reset_settings() {
global $G1TGLOWPlugin; // we'll need this below

echo '<p>Settings Have Been Reset</p><p><a href="'. admin_url( '/admin.php?page=G1T-settings' ) .'">Return to Settings</a>';

		$G1TGLOWPlugin->update_setting('enable_woo_custom_css', 'no');
		$G1TGLOWPlugin->update_setting('disallow_unauth', 'no');
		$G1TGLOWPlugin->update_setting('disallow_emails_enable', 'no');
		$G1TGLOWPlugin->update_setting('disallow_emails_address', get_bloginfo( 'admin_email' ));
		$G1TGLOWPlugin->update_setting('disallow_count', '0');
		$G1TGLOWPlugin->update_setting('disable_prettyphoto', 'no');
		$G1TGLOWPlugin->update_setting('disable_flex', 'no');
		$G1TGLOWPlugin->update_setting('disable_modernizr', 'no');
		$G1TGLOWPlugin->update_setting('disable_fontawe', 'no');
		$G1TGLOWPlugin->update_setting('disable_dash_welcome', 'no');
		$G1TGLOWPlugin->update_setting('remove_woo_nav', 'no');
		$G1TGLOWPlugin->update_setting('G1T_FB_ProfileID_Data', 'no');
		$G1TGLOWPlugin->update_setting('G1T_FB_ProfileID', '724860207531530');
		$G1TGLOWPlugin->update_setting('G1T_FB_Profile_URL', 'https://www.facebook.com/GoldFashHosting/');
		$G1TGLOWPlugin->update_setting('G1T_FB_Profile_Image', 'https://goldfash.com/god1st.cloud/static.imgs/.logos/G1xCxFAMArtboard@1.5x-8.png');
		$G1TGLOWPlugin->update_setting('G1T_FB_Profile_SiteName', '');
		$G1TGLOWPlugin->update_setting('G1T_FB_Profile_SiteDescription', '');
		

	}



?>

    <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
    	<?php $G1TGLOWPlugin->the_nonce(); ?>
    	<table class="form-table">
		<tbody>


			<th colspan="2" ><h3>General</h3></th>


			<tr>
				<th scope="row" valign="top">Disable G1T Welcome Dashboard on Login</th>
				<td>
					<label>
						<input type="hidden" name="<?php echo $G1TGLOWPlugin->get_field_name('disable_dash_welcome'); ?>" value="no" />
						<input type="checkbox" name="<?php echo $G1TGLOWPlugin->get_field_name('disable_dash_welcome'); ?>" value="yes" <?php if ( $G1TGLOWPlugin->get_setting('disable_dash_welcome') == "yes") echo 'checked="checked"'; ?> />	Disable redirect to G1T Welcome Dashboard on login					</label>
				</td>
			</tr>
			
			
			<th colspan="2" ><h3>Meta Properties</h3></th>


			<tr>
				<th scope="row" valign="top">Enable Facebook META</th>
				<td>
					<label>
						<input type="hidden" name="<?php echo $G1TGLOWPlugin->get_field_name('G1T_FB_ProfileID_Data'); ?>" value="no" />
						<input type="checkbox" name="<?php echo $G1TGLOWPlugin->get_field_name('G1T_FB_ProfileID_Data'); ?>" value="yes" <?php if ( $G1TGLOWPlugin->get_setting('G1T_FB_ProfileID_Data') == "yes") echo 'checked="checked"'; ?> />	Enabled Global Facebook OG Properties.</label>
				</td>
			</tr>
			
			<?php if ( $G1TGLOWPlugin->get_setting('G1T_FB_ProfileID_Data') == "yes") echo '<tr>
				<th scope="row" valign="top">Facebook Profile ID</th>
				<td>
					<label>
						<input type="text" name="'. $G1TGLOWPlugin->get_field_name('G1T_FB_ProfileID') .'" value="'. $G1TGLOWPlugin->get_setting('G1T_FB_ProfileID') .'" />
						<label>Your Facebook PAGE ID</label>
				</td>
			</tr>
			<tr>
				<th scope="row" valign="top">Facebook Profile URL</th>
				<td>
					<label>
						<input type="text" name="'. $G1TGLOWPlugin->get_field_name('G1T_FB_Profile_URL') .'" value="'. $G1TGLOWPlugin->get_setting('G1T_FB_Profile_URL') .'" />
						<label>Your Facebook PAGE URL</label>
				</td>
			</tr>
			<tr>
				<th scope="row" valign="top">Facebook Feed Image</th>
				<td>
					<label>
						<input type="text" name="'. $G1TGLOWPlugin->get_field_name('G1T_FB_Profile_Image') .'" value="'. $G1TGLOWPlugin->get_setting('G1T_FB_Profile_Image') .'" />
						<label>Your Facebook New Feed Default Image</label> <img src="'. $G1TGLOWPlugin->get_setting('G1T_FB_Profile_Image') .'" width="250" />
				</td>
			</tr>
			<tr>
				<th scope="row" valign="top">Site Name</th>
				<td>
					<label>
						<input type="text" name="'. $G1TGLOWPlugin->get_field_name('G1T_FB_Profile_SiteName') .'" value="'. $G1TGLOWPlugin->get_setting('G1T_FB_Profile_SiteName') .'" required/>
						<label>Your Current Site Name</label>
				</td>
			</tr>
			<tr>
				<th scope="row" valign="top">Site Description</th>
				<td>
					<label>
						<input type="text" name="'. $G1TGLOWPlugin->get_field_name('G1T_FB_Profile_SiteDescription') .'" value="'. $G1TGLOWPlugin->get_setting('G1T_FB_Profile_SiteDescription') .'" required/>
						<label>Your Current Site Description</label>
				</td>
			</tr>'; ?>
			
			

			<th colspan="2" ><h3>Libraries and Scripts</h3><p>Disables force enqueue. Libraries may be added by other plugins on specific areas of the site (eg. WooCommerce loads scripts on WooCommerce pages)</p></th>


			<tr>
				<th scope="row" valign="top">Disable Force PrettyPhoto</th>
				<td>
					<label>
						<input type="hidden" name="<?php echo $G1TGLOWPlugin->get_field_name('disable_prettyphoto'); ?>" value="no" />
						<input type="checkbox" name="<?php echo $G1TGLOWPlugin->get_field_name('disable_prettyphoto'); ?>" value="yes" <?php if ( $G1TGLOWPlugin->get_setting('disable_prettyphoto') == "yes") echo 'checked="checked"'; ?> />
					</label>
				</td>
			</tr>


			<tr>
				<th scope="row" valign="top">Disable Force Flexslider</th>
				<td>
					<label>
						<input type="hidden" name="<?php echo $G1TGLOWPlugin->get_field_name('disable_flex'); ?>" value="no" />
						<input type="checkbox" name="<?php echo $G1TGLOWPlugin->get_field_name('disable_flex'); ?>" value="yes" <?php if ( $G1TGLOWPlugin->get_setting('disable_flex') == "yes") echo 'checked="checked"'; ?> />
					</label>
				</td>
			</tr>

			<tr>
				<th scope="row" valign="top">Disable Force Modernizr</th>
				<td>
					<label>
						<input type="hidden" name="<?php echo $G1TGLOWPlugin->get_field_name('disable_modernizr'); ?>" value="no" />
						<input type="checkbox" name="<?php echo $G1TGLOWPlugin->get_field_name('disable_modernizr'); ?>" value="yes" <?php if ( $G1TGLOWPlugin->get_setting('disable_modernizr') == "yes") echo 'checked="checked"'; ?> />
					</label>
				</td>
			</tr>

			<tr>
				<th scope="row" valign="top">Disable Force FontAwesome</th>
				<td>
					<label>
						<input type="hidden" name="<?php echo $G1TGLOWPlugin->get_field_name('disable_fontawe'); ?>" value="no" />
						<input type="checkbox" name="<?php echo $G1TGLOWPlugin->get_field_name('disable_fontawe'); ?>" value="yes" <?php if ( $G1TGLOWPlugin->get_setting('disable_fontawe') == "yes") echo 'checked="checked"'; ?> />Not Recommended as G1T uses Font Awesome.
					</label>
				</td>
			</tr>
			
			
<?php if (PARENT_THEME == 'canvas') { ?>

		<th colspan="2" ><h3>Canvas Settings</h3></th>


			<tr>
				<th scope="row" valign="top">Add Woo Custom CSS</th>
				<td>
					<label>
						<input type="hidden" name="<?php echo $G1TGLOWPlugin->get_field_name('enable_woo_custom_css'); ?>" value="no" />
						<input type="checkbox" name="<?php echo $G1TGLOWPlugin->get_field_name('enable_woo_custom_css'); ?>" value="yes" <?php if ( $G1TGLOWPlugin->get_setting('enable_woo_custom_css') == "yes") echo 'checked="checked"'; ?> />Check this to add the WooFramework custom css
					</label>
				</td>
			</tr>



			<tr>
				<th scope="row" valign="top">Remove Woo Nav</th>
				<td>
					<label>
						<input type="hidden" name="<?php echo $G1TGLOWPlugin->get_field_name('remove_woo_nav'); ?>" value="no" />
						<input type="checkbox" name="<?php echo $G1TGLOWPlugin->get_field_name('remove_woo_nav'); ?>" value="yes" <?php if ( $G1TGLOWPlugin->get_setting('remove_woo_nav') == "yes") echo 'checked="checked"'; ?> />	Check this to remove the Woo Navigation
					</label>
				</td>
			</tr>


<?php } // if canvas ?>
			
		
		
<?php bb_settings_end(); ?>		
		
		
		
		
		
		
		
		
		
		
		
	</tbody>
</table>
<input class="button-primary" type="submit" value="Save Settings" />
</form>
<p><a href="<?php echo admin_url( '/admin.php?page=G1T-settings&reset' ); ?>">RESET</a></p>