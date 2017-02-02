<?php

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

/**
 * Plugin Shortcode Class
 *
 * Handles shortcode of the plugin
 *
 * @package Hola Video Player
 * @since 1.0.0
 */

class Hvp_Shortcode {
     
     public $model;
     //class constructor
    public function __construct()    {
        global $hvp_model;        
        $this->model = $hvp_model;
    }

    /**
     * Display simple video
     *
     * @package Hola Video Player
     * @since 1.0.0
    */
    public function hvp_simple_video($atts, $content) {
        extract(shortcode_atts(array(
                                        'url' => '',
                                        'adtagurl'=> '',
                                        'hls' => false, // Live streaming video
                                        'osmf' => false,
                                        'width' => '640',
                                        'height' => '',
                                        'controls' => 'true',
                                        'autoplay' => false,
                                        'poster' => '',
                                        'loop' => '',
                                        'muted' => '',
                                        'preload' => 'none',
                                        'ytcontrol' => false, // Youtube control
                                        'video_id' => 'sample',
                                        'class' => '',
                                        'template' => '',
),
                                    $atts
));
        $url = $this->model->hvp_escape_slashes_deep($url);
        
        // Get file MIME type
        $mime_type = hvp_get_mimetype($url);

        // include video javascript based on video type
        if (!$hls && !$osmf) {
            wp_enqueue_script('hvp_video_script');
        }
        if ($hls) {
            wp_enqueue_script('hvp_hls_video_script');
        }
        if ($osmf)
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

        $skin = 'default-skin';
        if (strpos($width, '%') == false && strpos($width, 'px') == false) {
            $width = $width.'px';
        }

        if($template != 'basic-skin') {
            wp_enqueue_style('hvp_hola_style');
            $skin = 'hola-skin';
        }
        
        $res_class = 'hvp-responsive-video-'.rand(1,1000);
        
        $custom_css = "
            .".$res_class."{
                width: 100% !important;
                max-width: ". $width .";
        }";
        ?>
            <style type="text/css">
            <?php print $custom_css;?>
            </style>
        <?php            
        $muted = ($muted == true || $muted == 'true') ? ' muted' : '';
        $autoplay = ($autoplay == true || $autoplay == 'true') ? ' autoplay' : '';
        $loop = ($loop == true || $loop == 'true') ? ' loop' : '';
        $controls = ($controls == 'true') ? ' controls' : '';
        $techorder = '';

        // Check if youtube url added
        if($mime_type == 'video/youtube') {
            // Include youtube support js
            wp_enqueue_script('hvp_youtube_video_script');
            $techorder = '"techOrder": ["youtube"],'; // Videojs attrib

            // Check for display youtube control or not
            if($ytcontrol == true) {
                $controls = '';
                $techorder .= '"youtube": { "ytControls": 2 },';
            }

        } elseif ($mime_type == 'video/vimeo') {
            // Include vimeo support js
            wp_enqueue_script('hvp_vimeo_video_script');
            $techorder = '"techOrder": ["vimeo"],'; // Videojs attrib

            // Check for display vimeo control or not
            if($ytcontrol == true) {
                $controls = '';
                $techorder .= '"vimeo": { "ytControls": 2 },';
            }            
        }
        $adtagurl = (!empty($adtagurl)) ? 'data-adurl="'. $adtagurl .'" ' : '';

        ob_start();
        ?>
        <div id="<?php print $video_id;?>" class="hvp-video hvp-content-video">
          <video id="<?php print $res_class?>" <?php print $adtagurl ?> data-id="<?php print $res_class?>" class="video-js <?php print $skin.' '.$res_class ?> <?php print $class?>" preload="<?php print $preload; ?>" width="<?php print $width?>" height="<?php print $height?>" poster="<?php print $poster;?>" <?php print $autoplay.$muted.$loop.$controls ?>  data-setup='{<?php print $techorder ?>"plugins":{}}'>
            <source src="<?php print $url?>" type="<?php print $mime_type?>" />
            <p class="vjs-no-js"><?php _e('To view this video please enable JavaScript, and consider upgrading to a web browser that', HVP_TEXTDOMAIN) ?> <a href="http://videojs.com/html5-video-support/" target="_blank"><?php _e('supports HTML5 video', HVP_TEXTDOMAIN) ?></a></p>
              </video>
          </div>
        <?php
        $content .= ob_get_clean();
        return $content;
    }

    /**
     * Adding hooks for the register all shotcodes.
     *
     * @package Hola Video Player
     * @since 1.0.0
     */
    function add_hooks(){
        // Shortcode for showing video
        add_shortcode('hvp-video', array($this, 'hvp_simple_video'));
    }

}
