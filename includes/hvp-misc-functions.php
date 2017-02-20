<?php

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

/**
 * Misc Functions
 *
 * All misc functions handles to
 * different functions
 *
 * @package Hola Video Player
 * @since 1.0.0
 */

/**
 * Return mime type from url
 *
 * @package Hola Video Player
 * @since 1.0.0
 */
function hvp_get_mimetype($file) {
    if(empty($file))
        return 'video/mp4';
    $replaces = array('https://', 'https://www.', 'http://', 'http://www.', 'www.');
    $file = str_replace($replaces, '', $file);
    $file = str_replace('/', '.', $file);

    $file = strtolower($file);
    $extension = explode('.', $file);
    $mimes = hvp_mimelist();

    foreach ($extension as $value) {
        if(isset($mimes[$value]))
            return $mimes[$value];
    }

    $youtube = array('youtube', 'com');
    $vimio = array('vimeo', 'com');

    // Check if youtube url
    if(count(array_intersect($extension, $youtube)) == count($youtube))
        return 'video/youtube';

    // Check if vimio url
    if(count(array_intersect($extension, $vimio)) == count($vimio))
        return 'video/vimeo';

    return 'video/mp4';
}

function hvp_mimelist() {
    return array(
        'flv' => 'video/x-flv',
        'mp4' => 'video/mp4',
        'm3u8' => 'application/x-mpegurl',
        'ts' => 'video/MP2T',
        '3gp' => 'video/3gpp',
        'mov' => 'video/quicktime',
        'avi' => 'video/x-msvideo',
        'wmv' => 'video/x-ms-wmv',
        'avs' => 'video/avs-video',
        'm3u' => 'audio/x-mpegurl',
        'f4m' => 'application/adobe-f4m'
    );
}

function hvp_user_details() {
    $user = wp_get_current_user();
    $url = get_bloginfo('url');
    return array(
        'email' => $user->user_email,
        'name' => $user->display_name,
        'site' => $url,
    );
}

function hvp_build_video_tag($attr) {
    $url = $attr['url'];
    $adtagurl = $attr['adtagurl'];
    $poster = $attr['poster'];
    $video_type = $attr['video_type'];
    $width = $attr['width'];
    $height = $attr['height'];
    $controls = $attr['controls'];
    $autoplay = $attr['autoplay'];
    $loop = $attr['loop'];
    $muted = $attr['muted'];
    $preload = $attr['preload'];
    $ytcontrol = $attr['ytcontrol'];
    $class = $attr['class'];
    $template = $attr['template'];

    // Get file MIME type
    $mime_type = hvp_get_mimetype($url);
    $res_class = 'hvp-responsive-video-'.rand(1,1000);
    $inited_player = false;

    wp_enqueue_script('hvp_video_script');

    $skin = 'default-skin';
    if (!empty($width) && strpos($width, '%') == false 
        && strpos($width, 'px') == false) {
        $width = $width.'px';
    }
    if($template != 'basic-skin') {
        wp_enqueue_style('hvp_hola_style');
        $skin = 'hola-skin';
    }

    $muted = ($muted === true || $muted === 'true') ? 'muted' : '';
    $autoplay = ($autoplay === true || $autoplay === 'true') ? 'autoplay' : '';
    $loop = ($loop === true || $loop === 'true') ? 'loop' : '';
    $controls = ($controls === true || $controls === 'true') ? 'controls' : '';

    $opts = "player: jQuery('#$res_class')";
    if ($muted) {
        $opts = "$opts, muted: true, volume: false";
    }

    // Check if youtube url added
    if($mime_type == 'video/youtube') {
        // Include youtube support js
        wp_enqueue_script('hvp_youtube_video_script');
        $techorder = '"techOrder": ["youtube"],'; // Videojs attrib
        $adtagurl = '';

        // Check for display youtube control or not
        if($ytcontrol === true || $ytcontrol === 'true') {
            $controls = '';
            $techorder .= '"youtube": { "ytControls": 2 },';
        }
        wp_add_inline_script('hvp_youtube_video_script',
            "videojs('$res_class', { $techorder });");
        $inited_player = true;
    } elseif ($mime_type == 'video/vimeo') {
        // Include vimeo support js
        wp_enqueue_script('hvp_vimeo_video_script');
        $techorder = '"techOrder": ["vimeo"],'; // Videojs attrib
        $adtagurl = '';

        // Check for display vimeo control or not
        if($ytcontrol === true || $ytcontrol === 'true') {
            $controls = '';
            $techorder .= '"vimeo": { "ytControls": 2 },';
        }
        wp_add_inline_script('hvp_vimeo_video_script',
            "videojs('$res_class', { $techorder });");
        $inited_player = true;
    }
    if ($adtagurl) {
        // IMA ADS SDK
        wp_enqueue_script('hvp_ima_ads_sdk_script');
        // urls are stored html-encoded
        $adtagurl = html_entity_decode($adtagurl);
        wp_add_inline_script('hvp_ima_ads_sdk_script',
            "window.hola_player({ $opts, ads: { adTagUrl: '$adtagurl' } });");
        $inited_player = true;
    }
    if (!$inited_player) {
        wp_add_inline_script('hvp_video_script', 
            "window.hola_player({ $opts });");
    }

    ob_start();
    ?>
    <style type="text/css">
    .<?php echo $res_class; ?> {
        width: 100% !important;
        max-width: <?php echo $width; ?>;
    }
    </style>
    <div class="hvp-video hvp-content-video">
      <video id="<?php print $res_class?>" data-id="<?php print $res_class?>"
        class="video-js <?php print $skin.' '.$res_class ?> <?php print $class?>"
        preload="<?php print $preload; ?>" width="<?php print $width?>" height="<?php print $height?>" poster="<?php print $poster;?>"
        <?php print "$autoplay $muted $loop $controls "; ?>>
            <source src="<?php print $url?>" type="<?php print $mime_type?>" />
            <p class="vjs-no-js"><?php _e('To view this video please enable JavaScript, and consider upgrading to a web browser that', HVP_TEXTDOMAIN) ?> <a href="http://videojs.com/html5-video-support/" target="_blank"><?php _e('supports HTML5 video', HVP_TEXTDOMAIN) ?></a></p>
      </video>
    </div>
    <?php
    $content = ob_get_clean();
    return $content;
}
