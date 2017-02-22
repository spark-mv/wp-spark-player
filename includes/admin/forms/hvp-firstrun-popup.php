<?php

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

/**
 * One-time activation UI
 *
 * This is the code for the popup that appears one time immediately after the
 * plugin is first activated, to give the user a chance to opt-in to analytics
 * and other services from Hola Networks.
 *
 * @package Hola Video Player
 * @since 1.1.0
 *
 **/

wp_add_inline_script('hvp_ga_script', "ga('hvp.set', 'page', 'hvp-firstrun-popup'); ga('hvp.send', 'pageview');");
?>

<div id="hvp-firstrun-content" class="hvp-popup-content">
    <div class="hvp-header">
        <div class="hvp-header-title"><?php _e('Activate Hola Analytics', HVP_TEXTDOMAIN);?></div>
        <div class="hvp-popup-close"><a href="javascript:void(0);" class="hvp-close-button"><img src="<?php echo HVP_INC_URL;?>/images/close.svg" alt="<?php _e('Close', HVP_TEXTDOMAIN);?>" /></a></div>
    </div>

    <div class="hvp-popup">
        <div id="hvp-activate-explanation">
            <img src="<?php echo HVP_INC_URL;?>/images/hola_player.svg" />
            <h1>Thanks for using the Hola Free Video Player!</h1>
            <p>Click below to activate free analytics for your videos, provided 
            by HolaCDN. You will be contacted by a member of the HolaCDN team.</p> 
            <p><a href="<?php echo 
            admin_url('admin.php?page=hvp_player_setting_page'); ?>"><?php 
            _e('Activate free video analytics'); ?></a></p>
        </div>
    </div>
</div>
<div id="hvp-firstrun-overlay" class="hvp-popup-overlay"></div>
