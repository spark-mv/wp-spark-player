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
$template_arr = array('vjs-default-skin'=> 'Default');
$cdn_customerid = get_option('hvp-cdn-customerid');
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
                    &nbsp;or&nbsp;
                    <button class="hvp-video-upload button button-primary"><?php _e('Upload', HVP_TEXTDOMAIN);?></button>
                </div>
                <div class="hvp-input-row">
                    <label for="hvp-poster"><?php _e('Choose poster', HVP_TEXTDOMAIN);?></label>
                    <input type="url" name="hvp-poster" id="hvp-poster" placeholder="URL">
                    &nbsp;or&nbsp;
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
                        <input type="checkbox" id="hvp-video-ads" class="hvp-video-ads" name="hvp-video-ads">
                        <label for="hvp-video-ads"><?php _e('Display ads in video:'); ?></label>
                    </div>
                    <input type="text" id="hvp-ads-url" class="hvp-ads-container" name="hvp-ads-url"
                        placeholder="<?php _e('Ad tag url (IMA/VAST/VPAID/VMAP)', HVP_TEXTDOMAIN);?>">
                </div>
                <div class="hvp-input-row">
                <?php if ($cdn_customerid) { ?>
                    <p>HolaCDN analytics activated for account <?php _e($cdn_customerid); ?>!</p>
                <?php } else { ?>
                    <a target="_blank" 
                      onclick="window.ga('hvp.send', 'event', 'wp-plugin', 'click', 'shortcode-analytics-link')"
                      href="<?php echo admin_url('admin.php?page=hvp_player_setting_page'); ?>">
                        <?php _e('Player requires a HolaCDN account. Sign up for free.'); ?>
                    </a>
                <?php } ?>
                </div>
            </div>
        </div>
        <div id="hvp-insert-container">
            <input type="button" class="button-secondary" id="hvp-insert-shortcode" value="<?php _e('Insert Shortcode', 'wpwfp'); ?>">
        </div>
    </div><!--.hvp-fp-popup-->
</div><!--.hvp-popup-content-->
<div class="hvp-popup-overlay"></div>
