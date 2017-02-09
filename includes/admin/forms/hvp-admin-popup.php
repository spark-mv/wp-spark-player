<?php

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

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
$type_arr = array('simple'=> 'Simple', 'hls' => 'HLS', 'osmf' => 'OSMF');
$template_arr = array('hola-skin'=> 'Hola', 'basic-skin'=> 'Basic-skin');
?>

<div class="hvp-popup-content" id="hvp-popup-shortcode">
    
    <div class="hvp-header">
        <div class="hvp-header-title"><?php _e('Add Hola Video Player Shortcode', HVP_TEXTDOMAIN);?></div>
        <div class="hvp-popup-close"><a href="javascript:void(0);" class="hvp-close-button"><img src="<?php echo HVP_INC_URL;?>/images/close.svg" alt="<?php _e('Close', HVP_TEXTDOMAIN);?>" /></a></div>
    </div>
    
    <div class="hvp-popup">
        <div class="hvp-popup-2col">
            <div class="hvp-popup-col">
                <div class="hvp-input-row">
                    <label for="hvp-video-url"><?php _e('Choose video', HVP_TEXTDOMAIN);?></label>
                    <input type="url" name="hvp-video-url" id="hvp-video-url" placeholder="URL">
                    <p>or</p>
                    <button class="hvp-video-upload button button-primary"><?php _e('Upload', HVP_TEXTDOMAIN);?></button>
                </div>
                <div class="hvp-input-row">
                    <label for="hvp-poster"><?php _e('Choose poster', HVP_TEXTDOMAIN);?></label>
                    <input type="url" name="hvp-poster" id="hvp-poster" placeholder="URL">
                    <p>or</p>
                    <button class="hvp-poster-upload button button-primary"><?php _e('Upload', HVP_TEXTDOMAIN);?></button>
                </div>
                <div class="hvp-input-row">
                    <div>
                        <label for="hvp-width"><?php _e('Player width');?></label>
                        <input type="number" name="hvp-width" id="hvp-width" placeholder="<?php _e('Width');?>">
                    </div>
                    <div>
                        <label for="hvp-height"><?php _e('Player height');?></label>
                        <input type="number" name="hvp-height" id="hvp-height" placeholder="<?php _e('Height');?>">
                    </div>
                </div>
                <div class="hvp-input-row">
                    <label for="hvp-class"><?php _e('Modifier class'); ?>
                        <div class="hvp-help">
                            <div class="hvp-help-tip">
                                <?php _e('Enter a CSS class to customize the video player design.', HVP_TEXTDOMAIN);?>
                            </div>
                        </div>
                    </label>
                    <input type="text" id="hvp-class" name="hvp-class">
                </div>
                <div class="hvp-input-row">
                    <div>
                        <label for="hvp-template">
                            <?php _e('Template'); ?>
                            <div class="hvp-help">
                                <div class="hvp-help-tip">
                                    <?php _e('Select the template for video player. ', HVP_TEXTDOMAIN);?>
                                </div>
                            </div>
                        </label>
                        <select id="hvp-template" name="hvp-template">
                            <?php $first_opt = true; foreach($template_arr as $key => $value) { ?>
                                <option <?php if ($first_opt) { print 'selected="selected"'; } $first_opt = false; ?> 
                                    value="<?php print $key ?>"><?php print $value ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div>
                        <label for="hvp-type">
                            <?php _e('Advanced Video Type Picker'); ?>
                            <div class="hvp-help">
                                <div class="hvp-help-tip">
                                    <?php _e('Keep it simple. Change this field only if you know you need HLS/OSMF support. '.
                                        'HLS support is required for M3U8 video sources, and OSMF support for F4M video sources.', HVP_TEXTDOMAIN);?>
                                </div>
                            </div>
                        </label>
                        <select id="hvp-type" name="hvp-type">
                            <?php $first_opt = true; foreach($type_arr as $key => $value) { ?>
                                <option <?php if ($first_opt) { print 'selected="selected"'; } $first_opt = false; ?> 
                                    value="<?php print $key ?>"><?php print $value ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="hvp-popup-col">
                <div class="hvp-input-row">
                    <div class="hvp-chk">
                        <input type="checkbox" checked id="hvp-video-control" name="hvp-video-control">
                        <label for="hvp-video-control"><?php _e('Show controls'); ?></label>
                    </div>
                    <div class="hvp-chk">
                        <input type="checkbox" id="hvp-ytcontrol" name="hvp-ytcontrol">
                        <label for="hvp-ytcontrol"><?php _e('YouTube or Vimeo controls'); ?>
                            <div class="hvp-help">
                                <div class="hvp-help-tip">
                                    <?php _e('Select whether to show or hide the native YouTube or Vimeo controls.', HVP_TEXTDOMAIN);?>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="hvp-chk">
                        <input type="checkbox" id="hvp-loop" name="hvp-loop">
                        <label for="hvp-loop"><?php _e('Loop video'); ?></label>
                    </div>
                    <div class="hvp-chk">
                        <input type="checkbox" id="hvp-mute" name="hvp-mute">
                        <label for="hvp-mute"><?php _e('Mute video'); ?></label>
                    </div>
                    <div class="hvp-chk">
                        <input type="checkbox" id="hvp-autoplay" name="hvp-autoplay">
                        <label for="hvp-autoplay"><?php _e('Autoplay (desktop only)'); ?></label>
                    </div>
                </div>
                <div class="hvp-input-row">
                    <div class="hvp-chk">
                        <input type="checkbox" id="hvp-video-ads" name="hvp-video-ads">
                        <label for="hvp-video-ads"><?php _e('Display ads in video:'); ?></label>
                    </div>
                    <input type="text" disabled id="hvp-ads-url" name="hvp-ads-url" 
                        placeholder="<?php _e('Ad tag url (IMA/VAST/VPAID/VMAP)', HVP_TEXTDOMAIN);?>">
                </div>
                <div class="hvp-input-row">
                    <div class="hvp-chk">
                        <input type="checkbox" id="hvp-analytics-optin" name="hvp-analytics-optin"
                            onChange='hvp.set_user_info(<?php _e(json_encode(hvp_user_details())); ?>)'>
                        <label for="hvp-analytics-optin"><?php _e('Activate free video analytics'); ?></label>
                    </div>
                    <p id="hvp-analytics-info">You will be contacted by a member of the HolaCDN team.</p>
                </div>
            </div>
        </div>
        <div id="hvp-insert-container">
            <input type="button" class="button-secondary" id="hvp-insert-shortcode" value="<?php _e('Insert Shortcode', 'wpwfp'); ?>">
        </div>
    </div><!--.hvp-fp-popup-->
</div><!--.hvp-popup-content-->
<div class="hvp-popup-overlay"></div>
