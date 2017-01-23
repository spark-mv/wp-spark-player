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
        <div class="hvp-popup-close"><a href="javascript:void(0);" class="hvp-close-button"><img src="<?php echo HVP_INC_URL;?>/images/tb-close.png" alt="<?php _e('Close', HVP_TEXTDOMAIN);?>" /></a></div>
    </div>

    <div class="hvp-popup">
        <div id="hvp_activate_explanation">
            <p>Thanks for using the Hola Free Video Player!</p>
            <p>Click below to activate free analytics for your video provided through Hola Networks. (This message will only appear once.)</p>
            <input type="checkbox" id="hvp_analytics_optin">Get my HolaVPN Stuff.</input>
        </div>
    </div>
</div>
<div id="hvp-firstrun-overlay" class="hvp-popup-overlay"></div>
