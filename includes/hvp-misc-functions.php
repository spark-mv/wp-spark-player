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
            'm3u' => 'audio/x-mpequrl',
            'f4m' => 'application/adobe-f4m'
);
}
