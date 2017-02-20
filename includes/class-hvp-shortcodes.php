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
        $atts = shortcode_atts(array(
            'url' => '',
            'adtagurl'=> '',
            'poster' => '',
            'hls' => false,
            'osmf' => false,
            'width' => '640',
            'height' => '320',
            'controls' => true,
            'autoplay' => false,
            'loop' => false, 
            'muted' => false,
            'preload' => 'none',
            'ytcontrol' => false,
            'class' => '',
            'template' => ''), $atts);
        $atts['url'] = $this->model->hvp_escape_slashes_deep($atts['url']);
        return hvp_build_video_tag($atts);
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
