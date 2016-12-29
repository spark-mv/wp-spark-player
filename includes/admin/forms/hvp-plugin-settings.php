<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Settings Page
 *
 * Handle settings
 * 
 * @package Hola Video Player
 * @since 1.0.0
 */

global $hvp_model , $hvp_options;;

$model = $hvp_model;

	//all settings will reset as per default
	if(isset($_POST['hvp_reset_settings']) && !empty($_POST['hvp_reset_settings']) && $_POST['hvp_reset_settings'] == __( 'Reset All Settings', HVP_TEXTDOMAIN )) { //check click of reset button
		
		hvp_default_settings(); // set default settings
		
		echo '<div class="updated" id="message">
			<p><strong>'. __("All Settings Reset Successfully.",HVP_TEXTDOMAIN) .'</strong></p>
		</div>';
		
	}
	//check settings updated or not
	if(isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true') {
		
		echo '<div class="updated" id="message">
			<p><strong>'. __("Changes Saved Successfully.",HVP_TEXTDOMAIN) .'</strong></p>
		</div>';
	}	
?>
	<!-- . begining of wrap -->
	<div class="wrap">
		<?php 
			echo screen_icon('options-general');	
			echo "<h2>" . __('Free video player setting', HVP_TEXTDOMAIN) . "</h2>";
		?>	
			
		<!-- beginning of the plugin options form -->
		<form  method="post" action="options.php">		
		
			<?php
				settings_fields( 'hvp_plugin_options' );
				$hvp_options = get_option( 'hvp_options' );
				$hvp_options['hvp_activate_analytics'] = isset($hvp_options['hvp_activate_analytics']) ? $hvp_options['hvp_activate_analytics'] : '';
			?>
		<!-- beginning of the settings meta box -->	
			<div id="hvp-settings" class="post-box-container">
			
				<div class="metabox-holder">	
			
					<div class="meta-box-sortables ui-sortable">
			
						<div id="settings" class="postbox">	
			
							<div class="handlediv" title="<?php echo __( 'Click to toggle', HVP_TEXTDOMAIN ) ?>"><br /></div>
			
								<!-- settings box title -->					
								<h3 class="hndle">					
									<span style="vertical-align: top;"><?php echo __( 'Free video player setting', HVP_TEXTDOMAIN ) ?></span>					
								</h3>
			
								<div class="inside">			

									<table class="form-table hvp-settings-box"> 
										<tbody>
											<tr>
												<th scope="row">
													<label><strong><?php echo __( 'Activate analytics:', HVP_TEXTDOMAIN ) ?></strong></label>
												</th>
												<td>
										
												<?php 
												/*$activate_analytics = $hvp_options['hvp_activate_analytics'];
												if( $activate_analytics == '1' ){
													$display = "display:block";
												}else {
													$display = "display:none";
												}*/
											?>
											    <!--<input name="hvp_options[hvp_activate_analytics]" type="checkbox" id="hvp_activate_analytics" value="1" <?php //checked('1', $activate_analytics); ?> />-->
											    <label for="hvp_activate_analytics"> <a href="mailto:or@hola.org?subject=Activate free video player analytics" id="hvp_activate_analytics_link"><?php _e('To activate free video player analytics, click here', HVP_TEXTDOMAIN ); ?></a></label>
											   
												</td>
											</tr>
												
											<!--<tr>
												<td colspan="2">
													<input type="submit" class="button-primary hvp-settings-save" name="hvp_settings_save" class="" value="<?php //echo __( 'Save Changes', HVP_TEXTDOMAIN ) ?>" />
												</td>
											</tr>-->
									
							
										</tbody>
									</table>
						
							</div><!-- .inside -->
				
						</div><!-- #settings -->
			
					</div><!-- .meta-box-sortables ui-sortable -->
			
				</div><!-- .metabox-holder -->
			
			</div><!-- #wps-settings-general -->
			
		<!-- end of the settings meta box -->		

		</form><!-- end of the plugin options form -->
	
	</div><!-- .end of wrap -->