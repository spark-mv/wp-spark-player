<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

add_action( 'widgets_init', 'hvp_widget' );

/**
 * Register the hola video Widget
 *
 * @package Hola Video Player
 * @since 1.0.0
 */
function hvp_widget() {
	
	register_widget( 'Hvp_Widget' );
}

/**
 * Widget Class
 *
 * Handles generic functionailties
 *
 * @package Hola Video Player
 * @since 1.0.0
 */

class Hvp_Widget extends WP_Widget {
	
	public $model;

	public $option_arr = array( 'no'=> 'No', 'yes' => 'Yes' );

	public $type_arr = array( 'simple'=> 'Simple', 'hls' => 'HLS', 'osmf' => 'OSMF' );
	public $template_arr = array( 'hola'=> 'Hola', 'basic'=> 'Basic');
	
	public function __construct() {
		global $hvp_model;
		$widget_ops = array('classname' => 'widget_text', 'description' => __('Display video with Free video player', HVP_TEXTDOMAIN ) );		
		WP_Widget::__construct( 'hvp-widget', __('Free video player', HVP_TEXTDOMAIN), $widget_ops);
		$this->model = $hvp_model;
	}

	public function form($instance) {
		
		// outputs the options form on admin
		$default = array( 'title' => '', 
						  'url' => '',
						  'is_video_ads' => '',
						  'video_adurl' => '',
						  'width' => '', 
						  'height' => '', 
						  'video_type' => '',
						  'controls' => '',
						  'autoplay' => '',
						  'poster' => '',
						  'loop' => '', 
						  'muted' => '',
						  'ytcontrol' => '',
						  'video_id' => '',
						  'class' => '',
						  'template' => '',
						);
		$instance = wp_parse_args( (array) $instance, $default );

		$title 			= $this->model->hvp_escape_attr( $instance['title'] );
		$url 			= $this->model->hvp_escape_attr( $instance['url'] );
		$is_video_ads	= $this->model->hvp_escape_attr( $instance['is_video_ads'] );
		$video_adurl	= $this->model->hvp_escape_attr( $instance['video_adurl'] );
		$width 			= $this->model->hvp_escape_attr( $instance['width'] );
		$height 		= $this->model->hvp_escape_attr( $instance['height'] );
		$video_type 	= $this->model->hvp_escape_attr( $instance['video_type'] );
		$controls 		= $this->model->hvp_escape_attr( $instance['controls'] );
		$autoplay 		= $this->model->hvp_escape_attr( $instance['autoplay'] );
		$poster 		= $this->model->hvp_escape_attr( $instance['poster'] );
		$loop 			= $this->model->hvp_escape_attr( $instance['loop'] );
		$muted 			= $this->model->hvp_escape_attr( $instance['muted'] );
		$ytcontrol 		= $this->model->hvp_escape_attr( $instance['ytcontrol'] );
		$video_id 		= $this->model->hvp_escape_attr( $instance['video_id'] );
		$class 			= $this->model->hvp_escape_attr( $instance['class'] );
		$template 		= $this->model->hvp_escape_attr( $instance['template'] );
		
		wp_nonce_field( HVP_PREFIX . '_noun' );
		?>
		
		<!-- Title: Text Box -->
		<p>
			<p class="hvp-title">
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', HVP_TEXTDOMAIN); ?></label>
			</p>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
			<div class="hvp-desc-container">
				<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Enter title for video.', HVP_TEXTDOMAIN );?></span>
			</div>
		</p>

		<!-- URL: Text Box -->
		<p>
			<p class="hvp-title">
				<label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('Video URL:', HVP_TEXTDOMAIN ); ?></label>
			</p>
			<input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo esc_attr($url); ?>" />
			<button type="button" class="hvp-video-upload button button-primary"><?php _e('Upload', HVP_TEXTDOMAIN ); ?></button>
			<div class="hvp-desc-container">
				<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Enter video url or upload video.', HVP_TEXTDOMAIN );?></span>
			</div>
		</p>

		<!-- Width: Text Box -->
		<p>
			<p class="hvp-title">
				<label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Width:', HVP_TEXTDOMAIN ); ?></label>
			</p>
			
			<input class="widefat" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo esc_attr($width); ?>" />
			
			<div class="hvp-desc-container">
				<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Enter width for video player.', HVP_TEXTDOMAIN );?></span>
			</div>
		</p>

		<!-- Height: Text Box -->
		<p>
			<p class="hvp-title">
				<label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height:', HVP_TEXTDOMAIN ); ?></label>
			</p>
			<input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo esc_attr($height); ?>" />
			<div class="hvp-desc-container">
				<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Enter height for video player.', HVP_TEXTDOMAIN );?></span>
			</div>
		</p>


		<!-- Show Video Control : Select Box -->
		<p>
			<p class="hvp-title">
				<label for="<?php echo $this->get_field_id('controls'); ?>"><?php _e('Show Video controls:', HVP_TEXTDOMAIN ); ?></label>
			</p>
			<select class="widefat" id="<?php echo $this->get_field_id('controls'); ?>" name="<?php echo $this->get_field_name('controls'); ?>">
				<option value=""><?php _e('Select', HVP_TEXTDOMAIN ) ?></option>
				<?php foreach( $this->option_arr as $key => $value ) {?>
					<option <?php selected( $controls, $key ); ?> value="<?php print $key ?>"><?php print $value ?></option>
				<?php } ?>
			</select>
			<div class="hvp-desc-container">
				<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Select for show/hide video controls.', HVP_TEXTDOMAIN );?></span>
			</div>
		</p>

		<!-- autoplay : Select Box -->
		<p>
			<p class="hvp-title">
				<label for="<?php echo $this->get_field_id('autoplay'); ?>"><?php _e('Autoplay (desktop only):', HVP_TEXTDOMAIN ); ?></label>
			</p>
			
			<select class="widefat" id="<?php echo $this->get_field_id('autoplay'); ?>" name="<?php echo $this->get_field_name('autoplay'); ?>">
				<option value=""><?php _e('Select', HVP_TEXTDOMAIN ) ?></option>
				<?php foreach( $this->option_arr as $key => $value ) {?>
					<option <?php selected( $autoplay, $key ); ?> value="<?php print $key ?>"><?php print $value ?></option>
				<?php } ?>
			</select>
			<div class="hvp-desc-container">
				<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Select yes/no for play video automatically or not .', HVP_TEXTDOMAIN );?></span>
			</div>
		</p>

		<!-- Poster url: Text Box -->
		<p>
			<p class="hvp-title">
				<label for="<?php echo $this->get_field_id('poster'); ?>"><?php _e('Poster URL:', HVP_TEXTDOMAIN ); ?></label>
			</p>
			
			<input class="widefat" id="<?php echo $this->get_field_id('poster'); ?>" name="<?php echo $this->get_field_name('poster'); ?>" type="text" value="<?php echo esc_attr($poster); ?>" />
			<button type="button" class="hvp-poster-upload button button-primary"><?php _e('Upload', HVP_TEXTDOMAIN ); ?></button>
			<div class="hvp-desc-container">
				<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Enter poster image url or upload poster image for video player.', HVP_TEXTDOMAIN );?></span>
			</div>
		</p>

		<!-- Loop : Select Box -->
		<p>
			<p class="hvp-title">
				<label for="<?php echo $this->get_field_id('loop'); ?>"><?php _e('Loop:', HVP_TEXTDOMAIN); ?></label>
			</p>
			
			<select class="widefat" id="<?php echo $this->get_field_id('loop'); ?>" name="<?php echo $this->get_field_name('loop'); ?>">
				<option value=""><?php _e('Select', HVP_TEXTDOMAIN ) ?></option>
				<?php foreach( $this->option_arr as $key => $value ) {?>
					<option <?php selected( $loop, $key ); ?> value="<?php print $key ?>"><?php print $value ?></option>
				<?php } ?>
			</select>
			<div class="hvp-desc-container">
				<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Select yes/no for play video in loop or not. ', HVP_TEXTDOMAIN );?></span>
			</div>
		</p>

		<!-- Muted : Select Box -->
		<p>
			<p class="hvp-title">
				<label for="<?php echo $this->get_field_id('muted'); ?>"><?php _e('Mute:', HVP_TEXTDOMAIN ); ?></label>
			</p>
			
			<select class="widefat" id="<?php echo $this->get_field_id('muted'); ?>" name="<?php echo $this->get_field_name('muted'); ?>">
				<option value=""><?php _e('Select', HVP_TEXTDOMAIN ) ?></option>
				<?php foreach( $this->option_arr as $key => $value ) {?>
					<option <?php selected( $muted, $key ); ?> value="<?php print $key ?>"><?php print $value ?></option>
				<?php } ?>
			</select>
			<div class="hvp-desc-container">
				<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Select yes/no for initially video sound on or off.', HVP_TEXTDOMAIN );?></span>
			</div>
		</p>

		<!-- Youtube or Vimeo Control : Select Box -->
		<p>
			<p class="hvp-title">
				<label for="<?php echo $this->get_field_id('muted'); ?>"><?php _e('Youtube or Viemo control:', HVP_TEXTDOMAIN ); ?></label>
			</p>
			
			<select class="widefat" id="<?php echo $this->get_field_id('ytcontrol'); ?>" name="<?php echo $this->get_field_name('ytcontrol'); ?>">
				<option value=""><?php _e('Select', HVP_TEXTDOMAIN ) ?></option>
				<?php foreach( $this->option_arr as $key => $value ) {?>
					<option <?php selected( $ytcontrol, $key ); ?> value="<?php print $key ?>"><?php print $value ?></option>
				<?php } ?>
			</select>
			<div class="hvp-desc-container">
				<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Select for show/hide controls for YouTube or Vimeo video.', HVP_TEXTDOMAIN );?></span>
			</div>
		</p>

		<!-- Video id : Text Box -->
		<p>
			<p class="hvp-title">
				<label for="<?php echo $this->get_field_id('video_id'); ?>"><?php _e('Id:', HVP_TEXTDOMAIN ); ?></label>
			</p>
			
			<input class="widefat" id="<?php echo $this->get_field_id('video_id'); ?>" name="<?php echo $this->get_field_name('video_id'); ?>" type="text" value="<?php echo esc_attr($video_id); ?>" />
			<div class="hvp-desc-container">
				<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Enter YouTube or Vimeo video id', HVP_TEXTDOMAIN );?></span>
			</div>
		</p>

		<!-- Modifier Class : Text Box -->
		<p>
			<p class="hvp-title">
				<label for="<?php echo $this->get_field_id('class'); ?>"><?php _e('Modifier Class:', HVP_TEXTDOMAIN ); ?></label>
			</p>
			
			<input class="widefat" id="<?php echo $this->get_field_id('class'); ?>" name="<?php echo $this->get_field_name('class'); ?>" type="text" value="<?php echo esc_attr($class); ?>" />
			<div class="hvp-desc-container">
				<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Enter class for customize video player design. ', HVP_TEXTDOMAIN );?></span>
			</div>
		</p>
		
		<!-- template : Select Box -->
		<p>
			<p class="hvp-title">
				<label for="<?php echo $this->get_field_id( 'template' ); ?>"><?php _e('Template:', HVP_TEXTDOMAIN ); ?></label>
			</p> 
			
			<select id="<?php echo $this->get_field_id( 'template' ); ?>" name="<?php echo $this->get_field_name( 'template' ); ?>" class="widefat" style="width:100%;">
				<option value=""><?php _e('Select', HVP_TEXTDOMAIN ) ?></option>
				<?php foreach( $this->template_arr as $key => $value ) {?>
					<option <?php selected( $template, $key ); ?> value="<?php print $key ?>"><?php print $value ?></option>
				<?php } ?>
			</select>
			<div class="hvp-desc-container">
				<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Select template for video player. ', HVP_TEXTDOMAIN );?></span>
			</div>
		</p>
		<!-- Video type Simple, HLS or OSMF : Select Box -->
		<p>
			<p class="hvp-title">
				<label for="<?php echo $this->get_field_id('video_type'); ?>"><?php _e('Advanced Video Type Picker:', HVP_TEXTDOMAIN ); ?></label>
			</p>
			<select class="widefat" id="<?php echo $this->get_field_id('video_type'); ?>" name="<?php echo $this->get_field_name('video_type'); ?>">
				<option value=""><?php _e('Select', HVP_TEXTDOMAIN ) ?></option>
				<?php foreach( $this->type_arr as $key => $value ) {?>
					<option <?php selected( $video_type, $key ); ?> value="<?php print $key ?>"><?php print $value ?></option>
				<?php } ?>
			</select>
			<div class="hvp-desc-container">
				<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Keep it Simple. change this field only if you know you need HLS/OSMF support', HVP_TEXTDOMAIN );?></span>
			</div>
		</p>
		<!-- Ad tag URL: Text Box -->
		<p>
			<p class="hvp-title">
				<label for="<?php echo $this->get_field_id('is_video_ads'); ?>"><?php _e('Ads in video?:', HVP_TEXTDOMAIN ); ?></label>
			</p>
			<input class="widefat is_video_ads" id="<?php echo $this->get_field_id('is_video_ads'); ?>" name="<?php echo $this->get_field_name('is_video_ads'); ?>" type="checkbox" value="yes" <?php checked( $is_video_ads, 'yes' ); ?> />
			<?php $hide = ''; if( $is_video_ads != 'yes' ) { $hide = 'display:none;';}?>
			<p>
			<div class="hvp-ads-container" style="<?php print $hide?>">
				<input class="widefat" id="<?php echo $this->get_field_id('video_adurl'); ?>" name="<?php echo $this->get_field_name('video_adurl'); ?>" type="text" value="<?php echo esc_attr($video_adurl); ?>" />
			</div>
			<div class="hvp-ads-container hvp-desc-container" style="<?php print $hide?>">
				<span class="hvp-help-tip"></span><span class="hvp-desc"><?php _e( 'Ad tag url for advertisement.(IMA/VAST/VPAID/VMAP)', HVP_TEXTDOMAIN );?></span>
			</div>
			</p>
		</p>
		<p>
			<p class="hvp-title">
				<label><?php _e( 'Activate analytics:', HVP_TEXTDOMAIN );?></label>
			</p> 
			
			<label for="hvp_activate_analytics"> <a href="mailto:or@hola.org?subject=Activate free video player analytics" id="hvp_activate_analytics_link"><?php _e('To activate free video player analytics, click here', HVP_TEXTDOMAIN ); ?></a></label>
		</p>

		<?php
	}

	public function update( $new_instance, $old_instance) {
		// processes widget options to be saved
		$instance = $old_instance;
		$formNonce = $_POST['_wpnonce'];

		if( wp_verify_nonce( $formNonce, HVP_PREFIX.'_noun' ) ) {

			$instance['title'] = $this->model->hvp_escape_slashes_deep($new_instance['title']);
			$instance['url'] = $this->model->hvp_escape_slashes_deep($new_instance['url']);
			$instance['is_video_ads'] = $this->model->hvp_escape_slashes_deep($new_instance['is_video_ads']);
			$instance['video_adurl'] = $this->model->hvp_escape_slashes_deep($new_instance['video_adurl']);
			$instance['width'] = $this->model->hvp_escape_slashes_deep($new_instance['width']);
			$instance['height'] = $this->model->hvp_escape_slashes_deep($new_instance['height']);
			$instance['video_type'] = $this->model->hvp_escape_slashes_deep($new_instance['video_type']);
			$instance['controls'] = $this->model->hvp_escape_slashes_deep($new_instance['controls']);
			$instance['autoplay'] = $this->model->hvp_escape_slashes_deep($new_instance['autoplay']);
			$instance['poster'] = $this->model->hvp_escape_slashes_deep($new_instance['poster']);
			$instance['loop'] = $this->model->hvp_escape_slashes_deep($new_instance['loop']);
			$instance['muted'] = $this->model->hvp_escape_slashes_deep($new_instance['muted']);
			$instance['ytcontrol'] = $this->model->hvp_escape_slashes_deep($new_instance['ytcontrol']);
			$instance['video_id'] = $this->model->hvp_escape_slashes_deep($new_instance['video_id']);
			$instance['class'] = $this->model->hvp_escape_slashes_deep($new_instance['class']);
			$instance['template'] = $this->model->hvp_escape_slashes_deep($new_instance['template']);
		}

		return $new_instance;
	}

	public function widget($args, $instance) {
		// outputs the content of the widget
		extract($args);
		
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$url= empty( $instance['url'] ) ? '' : $instance['url'];
		$is_video_ads	= empty( $instance['is_video_ads'] ) ? '' : $instance['is_video_ads'];
		$video_adurl	= empty( $instance['video_adurl'] ) ? '' : $instance['video_adurl'];
		$width = empty( $instance['width'] ) ? '300' : $instance['width'];
		$height = empty( $instance['height'] ) ? '' : $instance['height'];
		$video_type = empty( $instance['video_type'] ) ? 'simple' : $instance['video_type'];
		$controls = empty( $instance['controls'] ) ? 'yes' : $instance['controls'];
		$autoplay = empty( $instance['autoplay'] ) ? 'no' : $instance['autoplay'];
		$poster = empty( $instance['poster'] ) ? '' : $instance['poster'];
		$loop = empty( $instance['loop'] ) ? 'no' : $instance['loop'];
		$muted = empty( $instance['muted'] ) ? 'no' : $instance['muted'];
		$ytcontrol = empty( $instance['ytcontrol'] ) ? 'no' : $instance['ytcontrol'];
		$video_id = empty( $instance['video_id'] ) ? '' : $instance['video_id'];
		$class = empty( $instance['class'] ) ? '' : $instance['class'];
		$template = empty( $instance['template'] ) ? '' : $instance['template'];
		$preload = "auto";
		$url = $this->model->hvp_escape_slashes_deep($url);
		$skin = 'default-skin';
		if ( strpos( $width, '%') == false && strpos( $width, 'px') == false) {
    		$width = $width.'px';
    	}

		
		// Get file MIME type
		$mime_type = hvp_get_mimetype($url);

		echo $before_widget;
		
		if ( $title )
			echo $before_title . $title . $after_title;

		/** Remove wordpress default template from 1.0.0
		if( $template == 'mediaelement' ) {
    		$attr = array();
	        $attr['src'] = $url;
	        if( is_numeric( $width ) ){
	            $attr['width'] = $width;
	        }
	        if(is_numeric($height)){
	            $attr['height'] = $height;
	        }
	        if ( $autoplay == 'yes' ){
	            $attr['autoplay'] = 'on';
	        }
	        if ( $loop == 'yes' ){
	            $attr['loop'] = 'on';
	        }
	        if (!empty($poster)){
	            $attr['poster'] = $poster;
	        }
	        if (!empty($preload)){
	            $attr['preload'] = $preload;
	        }

	        echo wp_video_shortcode($attr);
	        echo $after_widget;
	        return '';
    	}*/
    	if( $template != 'basic' ) {
    		wp_enqueue_style( 'hvp_hola_style' );
    		$skin = 'hola-skin';
    	}

		$res_class = 'hvp-responsive-video-'.rand(1,1000);
		$custom_css = "
            .".$res_class."{
                width: 100% !important;
                max-width: ". $width ."px;
        }";
		?>
    		<style type="text/css">
    		<?php print $custom_css;?>
    		</style>
		<?php
    	        $muted = ( $muted == 'yes' ) ? ' muted' : '';
		$autoplay = ( $autoplay == 'yes' ) ? ' autoplay' : '';
		$loop = ( $loop == 'yes' ) ? ' loop' : '';
		$controls = ( $controls == 'yes' ) ? ' controls' : '';
		$techorder = '';

		// include video javascript based on video type
		if( $video_type == 'simple') {
			wp_enqueue_script('hvp_video_script');
		}
		elseif( $video_type == 'hls')
			wp_enqueue_script('hvp_hls_video_script');
		elseif( $video_type == 'osmf' )
			wp_enqueue_script('hvp_osmf_video_script');

		// IMA ADS SDK
		wp_enqueue_script('hvp_ima_ads_sdk_script');
		//wp_enqueue_script('hvp_video_player_script');

		// Videojs ads script
		wp_enqueue_script('hvp_video_ads_script');

		// IMA ADS script
		wp_enqueue_script('hvp_ima_ads_script');

		// VAST-VAPID ADS script
		wp_enqueue_script('hvp-vast-vpaid-ads-script');

		// ADS init script
		wp_enqueue_script('hvp_public_ads_script');
		
		// Check if youtube url added
		if( $mime_type == 'video/youtube' ) {
			// Include youtube support js
			wp_enqueue_script('hvp_youtube_video_script');
			$techorder = '"techOrder": ["youtube"],'; // Videojs attrib

			// Check for display youtube control or not
			if( $ytcontrol == 'yes' ) {
				$controls = '';
				$techorder .= '"youtube": { "ytControls": 2 },';
			}

		} elseif ( $mime_type == 'video/vimeo' ) {
			// Include vimeo support js
			wp_enqueue_script('hvp_vimeo_video_script');
			$techorder = '"techOrder": ["vimeo"],'; // Videojs attrib

			// Check for display vimeo control or not
			if( $ytcontrol == 'yes' ) {
				$controls = '';
				$techorder .= '"vimeo": { "ytControls": 2 },';
			}			
		}

		// code to add ads to video
		$adtagurl = '';
		if( $is_video_ads == 'yes' && $video_adurl != '' )
			$adtagurl = 'data-adurl="'. $video_adurl .'" ';

		?>
                <?php if ($url) { <?php>
		<div id="<?php print $video_id;?>" class="hvp-video hvp-widget-video">
		  <video id="<?php print $res_class?>" <?php print $adtagurl ?> data-id="<?php print $res_class?>" class="video-js <?php print $skin.' '. $res_class; ?> <?php print $class?>" width="<?php print $width?>" height="<?php print $height?>" poster="<?php print $poster;?>" <?php print $autoplay.$muted.$loop.$controls ?>
      		data-setup='{<?php print $techorder ?>"plugins":{}}'>
    		<source src="<?php print $url?>" type="<?php print $mime_type?>" />
    		<p class="vjs-no-js"><?php _e('To view this video please enable JavaScript, and consider upgrading to a web browser that', HVP_TEXTDOMAIN ) ?> <a href="http://videojs.com/html5-video-support/" target="_blank"><?php _e( 'supports HTML5 video', HVP_TEXTDOMAIN ) ?></a></p>
  			</video>
  		</div>
                <?php } ?>
		<?php
		
		echo $after_widget;
	}

}

?>
