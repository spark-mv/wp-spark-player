<?php

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

add_action('widgets_init', 'hvp_widget');

/**
 * Register the hola video Widget
 *
 * @package Hola Video Player
 * @since 1.0.0
 */
function hvp_widget() {
    
    register_widget('Hvp_Widget');
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

    public $type_arr = array('simple'=> 'Simple', 'hls' => 'HLS', 'osmf' => 'OSMF');
    public $template_arr = array('hola-skin'=> 'Hola', 'basic-skin'=> 'Basic');
    
    public function __construct() {
        global $hvp_model;
        $widget_ops = array('classname' => 'widget_text', 'description' => __('Display video with Hola Free Video Player', HVP_TEXTDOMAIN));        
        WP_Widget::__construct('hvp-widget', __('Hola Free Video Player', HVP_TEXTDOMAIN), $widget_ops);
        $this->model = $hvp_model;
    }

    public function form($instance) {
        
        // outputs the options form on admin
        $default = array(
            'title' => '',
            'url' => '',
            'video_adurl' => '',
            'width' => '',
            'height' => '',
            'video_type' => $this->type_arr[0],
            'poster' => '',
            'class' => '',
            'template' => $this->template_arr[0],
        );

        $instance = wp_parse_args((array) $instance, $default);

        $title = $this->model->hvp_escape_attr($instance['title']);
        $url = $this->model->hvp_escape_attr($instance['url']);
        $video_adurl = $this->model->hvp_escape_attr($instance['video_adurl']);
        $width = $this->model->hvp_escape_attr($instance['width']);
        $height = $this->model->hvp_escape_attr($instance['height']);
        $video_type = $this->model->hvp_escape_attr($instance['video_type']);
        $poster = $this->model->hvp_escape_attr($instance['poster']);
        $ytcontrol = $this->model->hvp_escape_attr($instance['ytcontrol']);
        $class = $this->model->hvp_escape_attr($instance['class']);
        $template = $this->model->hvp_escape_attr($instance['template']);
        
        wp_nonce_field(HVP_PREFIX . '_noun');
        ?>
        
        <!-- Title: Text Box -->
        <p>
            <p class="hvp-title">
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', HVP_TEXTDOMAIN); ?></label>
            </p>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

        <!-- URL: Text Box -->
        <p>
            <p class="hvp-title">
                <label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('Video:', HVP_TEXTDOMAIN); ?></label>
            </p>
            <input class="widefat" placeholder="URL" id="<?php echo $this->get_field_id('url'); ?>" 
                name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo esc_attr($url); ?>" />
            or
            <button type="button" class="hvp-video-upload button button-primary"><?php _e('Upload', HVP_TEXTDOMAIN); ?></button>
        </p>

        <!-- Poster url: Text Box -->
        <p>
            <p class="hvp-title">
                <label for="<?php echo $this->get_field_id('poster'); ?>"><?php _e('Poster URL:', HVP_TEXTDOMAIN); ?></label>
            </p>
            
            <input class="widefat" placeholder="URL" id="<?php echo $this->get_field_id('poster'); ?>" 
                name="<?php echo $this->get_field_name('poster'); ?>" type="text" value="<?php echo esc_attr($poster); ?>" />
            or
            <button type="button" class="hvp-poster-upload button button-primary"><?php _e('Upload', HVP_TEXTDOMAIN); ?></button>
        </p>

        <!-- Width: Text Box -->
        <div class="hvp-widget-2col">
            <p class="hvp-popup-col">
                <label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Width:', HVP_TEXTDOMAIN); ?></label>
                <input id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo esc_attr($width); ?>" />
            </p>
            <p class="hvp-popup-col">
                <label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height:', HVP_TEXTDOMAIN); ?></label>
                <input id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo esc_attr($height); ?>" />
            </p>
        </div>

        <div class="hvp-chk widefat">
            <input type="checkbox" <?php checked($instance['controls'], 'on');?> id="<?php echo $this->get_field_id('controls'); ?>" 
                name="<?php echo $this->get_field_name('controls'); ?>">
            <label for="<?php _e($this->get_field_id('controls')); ?>"><?php _e('Show controls'); ?></label>
        </div>

        <div class="hvp-chk widefat">
            <input type="checkbox" <?php checked($instance['autoplay'], 'on');?> id="<?php echo $this->get_field_id('autoplay'); ?>" 
                name="<?php echo $this->get_field_name('autoplay'); ?>">
            <label for="<?php echo $this->get_field_id('autoplay'); ?>"><?php _e('Autoplay (desktop only)'); ?></label>
        </div>

        <div class="hvp-chk widefat">
            <input type="checkbox" <?php checked($instance['loop'], 'on');?> id="<?php echo $this->get_field_id('loop'); ?>" 
                name="<?php echo $this->get_field_name('loop'); ?>">
            <label for="<?php echo $this->get_field_id('loop'); ?>"><?php _e('Loop video'); ?></label>
        </div>

        <div class="hvp-chk widefat">
            <input type="checkbox" <?php checked($instance['muted'], 'on');?> id="<?php echo $this->get_field_id('muted'); ?>" 
                name="<?php echo $this->get_field_name('muted'); ?>">
            <label for="<?php echo $this->get_field_id('muted'); ?>"><?php _e('Mute video'); ?></label>
        </div>

        <!-- Youtube or Vimeo Control : Select Box -->
        <div class="hvp-chk widefat">
            <input type="checkbox" <?php checked($instance['ytcontrol'], 'on');?> id="<?php echo $this->get_field_id('ytcontrol'); ?>"
                name="<?php echo $this->get_field_name('ytcontrol'); ?>">
            <label for="<?php echo $this->get_field_id('ytcontrol'); ?>"><?php _e('YouTube or Vimeo controls'); ?></label>
        </div>

        <!-- Modifier Class : Text Box -->
        <p>
            <p class="hvp-title">
                <label for="<?php echo $this->get_field_id('class'); ?>"><?php _e('Modifier Class:', HVP_TEXTDOMAIN); ?></label>
            </p>
            
            <input class="widefat" id="<?php echo $this->get_field_id('class'); ?>" name="<?php echo $this->get_field_name('class'); ?>" type="text" value="<?php echo esc_attr($class); ?>" />
        </p>
        
        <!-- template : Select Box -->
        <p>
            <label for="<?php echo $this->get_field_id('template'); ?>"><?php _e('Template:', HVP_TEXTDOMAIN); ?></label>
            <select id="<?php echo $this->get_field_id('template'); ?>" name="<?php echo $this->get_field_name('template'); ?>" class="widefat">
                <?php foreach($this->template_arr as $key => $value) {?>
                    <option <?php selected($template, $key); ?> value="<?php print $key ?>"><?php print $value ?></option>
                <?php } ?>
            </select>
        </p>

        <!-- Video type Simple, HLS or OSMF : Select Box -->
        <p>
            <label for="<?php echo $this->get_field_id('video_type'); ?>"><?php _e('Advanced Video Type Picker:', HVP_TEXTDOMAIN); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('video_type'); ?>" name="<?php echo $this->get_field_name('video_type'); ?>">
                <?php foreach($this->type_arr as $key => $value) {?>
                    <option <?php selected($video_type, $key); ?> value="<?php print $key ?>"><?php print $value ?></option>
                <?php } ?>
            </select>
        </p>

        <div class="hvp-chk widefat">
            <input type="checkbox" <?php checked($instance['is_video_ads'], 'on');?> id="<?php echo $this->get_field_id('is_video_ads'); ?>"
                name="<?php echo $this->get_field_name('is_video_ads'); ?>">
            <label for="<?php echo $this->get_field_id('is_video_ads'); ?>"><?php _e('Display ads in video:'); ?></label>
        </div>
        <input class="widefat" type="text" id="<?php echo $this->get_field_id('video_adurl'); ?>" name="<?php echo $this->get_field_name('video_adurl'); ?>" 
            placeholder="<?php _e('Ad tag url (IMA/VAST/VPAID/VMAP)', HVP_TEXTDOMAIN);?>">

        <div class="hvp-chk widefat">
            <input type="checkbox" id="<?php echo $this->get_field_id('analytics_optin'); ?>" name="<?php echo $this->get_field_name('analytics_optin'); ?>"
                onChange='hvp.set_user_info(<?php _e(json_encode(hvp_user_details())); ?>); hvp.create_lead();'>
            <label for="<?php echo $this->get_field_id('analytics_optin'); ?>"><?php _e('Activate free video analytics'); ?></label>
        </div>
        <p>You will be contacted by a member of the HolaCDN team.</p>

        <?php
    }

    public function update($new_instance, $old_instance) {
        // processes widget options to be saved
        $instance = $old_instance;
        $formNonce = $_POST['_wpnonce'];

        if(wp_verify_nonce($formNonce, HVP_PREFIX.'_noun')) {
            $instance['title'] = $this->model->hvp_escape_slashes_deep($new_instance['title']);
            $instance['url'] = $this->model->hvp_escape_slashes_deep($new_instance['url']);
            $instance['is_video_ads'] = $new_instance['is_video_ads'];
            $instance['video_adurl'] = $this->model->hvp_escape_slashes_deep($new_instance['video_adurl']);
            $instance['width'] = $this->model->hvp_escape_slashes_deep($new_instance['width']);
            $instance['height'] = $this->model->hvp_escape_slashes_deep($new_instance['height']);
            $instance['video_type'] = $this->model->hvp_escape_slashes_deep($new_instance['video_type']);
            $instance['controls'] = $new_instance['controls'];
            $instance['autoplay'] = $new_instance['autoplay'];
            $instance['poster'] = $this->model->hvp_escape_slashes_deep($new_instance['poster']);
            $instance['loop'] = $new_instance['loop'];
            $instance['muted'] = $new_instance['muted'];
            $instance['ytcontrol'] = $new_instance['ytcontrol'];
            $instance['class'] = $this->model->hvp_escape_slashes_deep($new_instance['class']);
            $instance['template'] = $this->model->hvp_escape_slashes_deep($new_instance['template']);
        }

        return $new_instance;
    }

    public function widget($args, $instance) {
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
        $url= empty($instance['url']) ? '' : $instance['url'];
        $video_adurl = empty($instance['video_adurl']) ? '' : $instance['video_adurl'];
        $width = empty($instance['width']) ? '300' : $instance['width'];
        $height = empty($instance['height']) ? '' : $instance['height'];
        $video_type = empty($instance['video_type']) ? 'simple' : $instance['video_type'];
        $poster = empty($instance['poster']) ? '' : $instance['poster'];
        $class = empty($instance['class']) ? '' : $instance['class'];
        $template = empty($instance['template']) ? '' : $instance['template'];
        $preload = "auto";
        $url = $this->model->hvp_escape_slashes_deep($url);
        $skin = 'default-skin';
        if (strpos($width, '%') == false && strpos($width, 'px') == false) {
            $width = $width.'px';
        }
        
        // Get file MIME type
        $mime_type = hvp_get_mimetype($url);

        echo $args['before_widget'];
        
        if ($title)
            echo $args['before_title'], $title, $args['after_title'];

        if($template != 'basic') {
            wp_enqueue_style('hvp_hola_style');
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
        $muted = ($instance['muted'] == 'on') ? 'muted' : '';
        $autoplay = ($instance['autoplay'] == 'on') ? 'autoplay' : '';
        $loop = ($instance['loop'] == 'on') ? 'loop' : '';
        $controls = ($instance['controls'] == 'on') ? 'controls' : '';
        $techorder = '';

        // include video javascript based on video type
        if($video_type == 'simple') {
            wp_enqueue_script('hvp_video_script');
        }
        elseif($video_type == 'hls')
            wp_enqueue_script('hvp_hls_video_script');
        elseif($video_type == 'osmf')
            wp_enqueue_script('hvp_osmf_video_script');

        // Check if youtube url added
        if($mime_type == 'video/youtube') {
            // Include youtube support js
            wp_enqueue_script('hvp_youtube_video_script');
            $techorder = '"techOrder": ["youtube"],'; // Videojs attrib

            // Check for display youtube control or not
            if($ytcontrol == 'yes') {
                $controls = '';
                $techorder .= '"youtube": { "ytControls": 2 },';
            }

        } elseif ($mime_type == 'video/vimeo') {
            // Include vimeo support js
            wp_enqueue_script('hvp_vimeo_video_script');
            $techorder = '"techOrder": ["vimeo"],'; // Videojs attrib

            // Check for display vimeo control or not
            if($ytcontrol == 'yes') {
                $controls = '';
                $techorder .= '"vimeo": { "ytControls": 2 },';
            }            
        }

        // code to add ads to video
        $adtagurl = '';
        if($instance['is_video_ads'] == 'on' && $video_adurl != '')
            $adtagurl = 'data-adurl="'. $video_adurl .'" ';
        if ($adtagurl) {
            // IMA ADS SDK
            wp_enqueue_script('hvp_ima_ads_sdk_script');

            // Videojs ads script
            wp_enqueue_script('hvp_video_ads_script');

            // IMA ADS script
            wp_enqueue_script('hvp_ima_ads_script');

            // VAST-VAPID ADS script
            wp_enqueue_script('hvp-vast-vpaid-ads-script');

            // ADS init script
            wp_enqueue_script('hvp_public_ads_script');
        }
        
        ?>
                <?php if ($url) { ?>
        <div class="hvp-video hvp-widget-video">
          <video id="<?php print $res_class?>" <?php print $adtagurl ?> data-id="<?php print $res_class?>" 
            class="video-js <?php print $skin.' '. $res_class; ?> <?php print $class?>"
            width="<?php print $width?>" height="<?php print $height?>" poster="<?php print $poster;?>" <?php print "$autoplay $muted $loop $controls"; ?>
            data-setup='{<?php print $techorder ?>"plugins":{}}'>
                <source src="<?php print $url?>" type="<?php print $mime_type?>" />
                <p class="vjs-no-js"><?php _e('To view this video please enable JavaScript, and consider upgrading to a web browser that', HVP_TEXTDOMAIN) ?> <a href="http://videojs.com/html5-video-support/" target="_blank"><?php _e('supports HTML5 video', HVP_TEXTDOMAIN) ?></a></p>
          </video>
          </div>
                <?php } ?>
        <?php
        echo $args['after_widget'];
    }
}

?>
