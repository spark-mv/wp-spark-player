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
            <p>Click below to activate free analytics for your video provided through Hola Networks.</p>
            <div class='hvp-chk'>
                <input type='checkbox' id='hvp-analytics-optin' name='hvp-analytics-optin'
                    onChange='hvp.set_user_info("<?php echo wp_get_current_user()->user_email; ?>")'>
                <label for='hvp-analytics-optin'></label>
            </div>
            <p>Get my Hola VPN Analytics</p>
            <p class="hvp-details">You will be contacted by a member of the Hola team. This free service 
                is not required to use the Hola Free Video Player. This message will only appear once.</p>
        </div>
    </div>
</div>
<div id="hvp-firstrun-overlay" class="hvp-popup-overlay"></div>
