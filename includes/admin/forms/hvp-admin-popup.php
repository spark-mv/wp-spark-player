<?php 

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Shortocde UI
 * 
 * This is the code for the pop up editor, which shows up when an user clicks
 * on the HVP video icon within the WordPress editor.
 * 
 * @package Hola Video Player
 * @since 1.0.0
 * 
 **/

// Get all post types
$post_types = get_post_types( array( 'public' => true ), 'objects' );

$option_arr = array( '' => 'Select', 'false'=> 'No', 'true' => 'Yes' );
$type_arr = array( '' => 'Select','simple'=> 'Simple', 'hls' => 'HLS', 'osmf' => 'OSMF' );
$template_arr = array( '' => 'Select','hola-skin'=> 'Hola', 'basic-skin'=> 'Basic-skin');
?>

<div class="hvp-popup-content">
	
	<div class="hvp-header">
		<div class="hvp-header-title"><?php _e( 'Add Free Video Player Shortcode', HVP_TEXTDOMAIN );?></div>
		<div class="hvp-popup-close"><a href="javascript:void(0);" class="hvp-close-button"><img src="<?php echo HVP_INC_URL;?>/images/tb-close.png" alt="<?php _e( 'Close', HVP_TEXTDOMAIN );?>" /></a></div>
	</div>
	
	<div class="hvp-popup">
		<table class="form-table hvp_form">
			<tbody>
				<tr>
					<th scope="row">
						<p class="hvp-title">
							<label><?php _e( 'Video URL', HVP_TEXTDOMAIN );?></label>
						</p>
						
					</th>
					<td>
						<input type="text" name="hvp_video_url" id="hvp_video_url">
						<button class="hvp-video-upload button button-primary"><?php _e( 'Upload', HVP_TEXTDOMAIN );?></button>
						<div class="hvp-desc-container">
							<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Enter video url or upload video.', HVP_TEXTDOMAIN );?></span>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<p class="hvp-title">
							<label><?php _e( 'Width', HVP_TEXTDOMAIN );?></label>
						</p>
						
					</th>
					<td>
						<input type="text" name="hvp_width" id="hvp_width" placeholder="Width">
						<div class="hvp-desc-container">
							<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Enter width for video player.', HVP_TEXTDOMAIN );?></span>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<p class="hvp-title">
							<label><?php _e( 'Height', HVP_TEXTDOMAIN );?></label>
						</p>
					
					</th>
					<td>
						<input type="text" name="hvp_height" id="hvp_height" placeholder="Height">
						<div class="hvp-desc-container">
							<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Enter height for video player.', HVP_TEXTDOMAIN );?></span>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<p class="hvp-title">
							<label><?php _e( 'Show control', HVP_TEXTDOMAIN );?></label>
						</p>
						
					</th>
					<td>
						<select class="chosen-select" id="hvp_video_control" name="hvp_video_control">
							<?php foreach( $option_arr as $key => $value ) {?>
								<option value="<?php print $key ?>"><?php print $value ?></option>
							<?php } ?>
						</select>
						<div class="hvp-desc-container">
							<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Select for show/hide video controls.', HVP_TEXTDOMAIN );?></span>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<p class="hvp-title">
							<label><?php _e( 'Autoplay (desktop only)', HVP_TEXTDOMAIN );?></label>
						</p>
						
					</th>
					<td>
						<select class="chosen-select" id="hvp_autoplay" name="hvp_autoplay">
							<?php foreach( $option_arr as $key => $value ) {?>
								<option value="<?php print $key ?>"><?php print $value ?></option>
							<?php } ?>
						</select>
						<div class="hvp-desc-container">
							<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Select yes/no for play video automatically or not .', HVP_TEXTDOMAIN );?></span>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<p class="hvp-title">
							<label><?php _e( 'Poster URL', HVP_TEXTDOMAIN );?></label>
						</p>
						
					</th>
					<td>
						<input type="text" id="hvp_poster" name="hvp_poster" >
						<button class="hvp-poster-upload button button-primary"><?php _e( 'Upload', HVP_TEXTDOMAIN );?></button>
						<div class="hvp-desc-container">
							<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Enter poster image url or upload poster image for video player.', HVP_TEXTDOMAIN );?></span>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<p class="hvp-title">
							<label><?php _e( 'Loop', HVP_TEXTDOMAIN );?></label>
						</p>
					
					</th>
					<td>
						<select class="chosen-select" id="hvp_loop" name="hvp_loop">
							<?php foreach( $option_arr as $key => $value ) {?>
								<option value="<?php print $key ?>"><?php print $value ?></option>
							<?php } ?>
						</select>
							<div class="hvp-desc-container">
							<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Select yes/no for play video in loop or not.', HVP_TEXTDOMAIN );?></span>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<p class="hvp-title">
							<label><?php _e( 'Mute', HVP_TEXTDOMAIN );?></label>
						</p>
						
					</th>
					<td>
						<select class="chosen-select" id="hvp_mute" name="hvp_mute">
							<?php foreach( $option_arr as $key => $value ) {?>
								<option value="<?php print $key ?>"><?php print $value ?></option>
							<?php } ?>
						</select>
						<div class="hvp-desc-container">
							<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Select yes/no for initially video sound on or off.', HVP_TEXTDOMAIN );?></span>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<p class="hvp-title">
							<label><?php _e( 'Youtube or Vimeo control', HVP_TEXTDOMAIN );?></label>
						</p>
						
					</th>
					<td>
						<select class="chosen-select" id="hvp_ytcontrol" name="hvp_ytcontrol">
							<?php foreach( $option_arr as $key => $value ) {?>
								<option value="<?php print $key ?>"><?php print $value ?></option>
							<?php } ?>
						</select>
						<div class="hvp-desc-container">
							<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Select for show/hide controls for YouTube or Vimeo video.', HVP_TEXTDOMAIN );?></span>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<p class="hvp-title">
							<label><?php _e( 'Id', HVP_TEXTDOMAIN );?></label>
						</p>
						
					</th>
					<td>
						<input type="text" id="hvp_id" name="hvp_id" >
						<div class="hvp-desc-container">
							<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Enter YouTube or Vimeo video id', HVP_TEXTDOMAIN );?></span>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<p class="hvp-title">
							<label><?php _e( 'Modifier Class', HVP_TEXTDOMAIN );?></label>
						</p>
						
					</th>
					<td>
						<input type="text" id="hvp_class" name="hvp_class">
						<div class="hvp-desc-container">
							<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Enter class for customize video player design. ', HVP_TEXTDOMAIN );?></span>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<p class="hvp-title">
							<label><?php _e( 'Template', HVP_TEXTDOMAIN );?></label>
						</p>
						
					</th>
					<td>
						<select class="chosen-select" id="hvp_template" name="hvp_template">
							<?php foreach( $template_arr as $key => $value ) {?>
								<option value="<?php print $key ?>"><?php print $value ?></option>
							<?php } ?>
						</select>
						<div class="hvp-desc-container">
							<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Select template for video player. ', HVP_TEXTDOMAIN );?></span>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<p class="hvp-title">
							<label><?php _e( 'Advanced Video Type Picker', HVP_TEXTDOMAIN );?></label>
						</p>
						
					</th>
					<td>
						<select class="chosen-select" id="hvp_type" name="hvp_type">
							<?php foreach( $type_arr as $key => $value ) {?>
								<option value="<?php print $key ?>"><?php print $value ?></option>
							<?php } ?>
						</select>
						<div class="hvp-desc-container">
							<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Keep it Simple. change this field only if you know you need HLS/OSMF support.', HVP_TEXTDOMAIN );?></span>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<p class="hvp-title">
							<label><?php _e( 'Ads in video?', HVP_TEXTDOMAIN );?></label>
						</p>
					</th>
					<td>
						<input type="checkbox" name="hvp_video_ads" id="hvp_video_ads">
						<label for="hvp_video_ads"><?php _e( 'Display ads', HVP_TEXTDOMAIN );?></label>
						<div class="hvp-ads-container hvp-desc-container" style="display: none;">
							<input type="text" name="hvp_ads_url" id="hvp_ads_url">
							<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Ad tag url for advertisement.(IMA/VAST/VPAID/VMAP)', HVP_TEXTDOMAIN );?></span>
						</div>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<p class="hvp-title">
							<label><?php _e( 'Activate analytics', HVP_TEXTDOMAIN );?></label>
						</p>
						
					</th>
					<td>
						 <label for="hvp_activate_analytics"> <a href="mailto:or@hola.org?subject=Activate free video player analytics" id="hvp_activate_analytics_link"><?php _e('To activate free video player analytics, click here', HVP_TEXTDOMAIN ); ?></a></label>
					</td>
				</tr>
			</tbody>
		</table>
			
		<div id="hvp_insert_container" >
			<input type="button" class="button-secondary" id="hvp_insert_shortcode" value="<?php _e( 'Insert Shortcode', 'wpwfp' ); ?>">
		</div>
		
	</div><!--.hvp-fp-popup-->
	
</div><!--.hvp-popup-content-->
<div class="hvp-popup-overlay"></div>
