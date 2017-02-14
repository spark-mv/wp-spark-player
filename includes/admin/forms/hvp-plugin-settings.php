<?php
// Exit if accessed directly
if (!defined('ABSPATH')) exit;

/**
 * Settings Page
 *
 * Handle HolaCDN integration settings
 *
 * @package Hola Free Video Player
 * @since 1.3
 */

?>
<!-- . begining of wrap -->
<div class="wrap">
  <?php
    echo screen_icon('options-general');  
    echo "<h1>" . __('Hola Free Video Player', HVP_TEXTDOMAIN) . "</h1>";
  ?>  

  <h2>Activate free video analytics</h2>
  <ul class="hvp-cdn-signup-steps">
    <li>
      <form>
        <button id="hvp-cdn-signup-btn" class="button button-primary">Sign 
        up</button> for HolaCDN. If you already have a HolaCDN account, 
        continue to step 2.
        <div id="hvp-cdn-signup-step1">
            <div class="hvp-input-row">
              <label for="hvp-cdn-email">Email</label>
              <input name="hvp-cdn-email" id="hvp-cdn-email" type="email" 
                value="<?php echo wp_get_current_user()->user_email; ?>" />
            </div>
            <div class="hvp-input-row">
              <label for="hvp-cdn-passwd">Password</label>
              <input name="hvp-cdn-passwd" id="hvp-cdn-passwd" type="password" />
            </div>
            <button id="hvp-cdn-step1-submit" class="button button-primary">
              Submit
            </button>
            <div id="hvp-cdn-signup-inprogress">
              Creating your HolaCDN account...
            </div>
            <div id="hvp-cdn-signup-error" class="hvp-error">
              There was an error creating your HolaCDN account. Please go to <a 
              href="//holacdn.com">http://holacdn.com</a> and complete your 
              signup there.
            </div>
            <div id="hvp-cdn-signup-used" class="hvp-error">
              There is already a user account for that email address. Please sign 
              in at <a href="//holacdn.com">http://holacdn.com</a> to get your 
              account ID.
            </div>
        </div>
      </form>
      <div id="hvp-cdn-signup-step2">
        <form>
          <div class="hvp-input-row">
            <label for="hvp-cdn-name">Your name</label>
            <input type="text" name="hvp-cdn-name" id="hvp-cdn-name"
              value="<?php echo wp_get_current_user()->display_name; ?>" />
          </div>
          <div class="hvp-input-row">
            <label for="hvp-cdn-site">Your website</label>
            <input type="text" site="hvp-cdn-site" id="hvp-cdn-site"
              value="<?php echo get_bloginfo('url'); ?>" />
          </div>
          <div class="hvp-input-row">
            <label for="hvp-cdn-company">Your company</label>
            <input type="text" company="hvp-cdn-company" id="hvp-cdn-company" />
          </div>
          <div class="hvp-input-row">
            <label for="hvp-cdn-skype">Your Skype ID (optional)</label>
            <input type="text" skype="hvp-cdn-skype" id="hvp-cdn-skype" />
          </div>
          <div class="hvp-input-row">
            <label for="hvp-cdn-phone">Your phone number (optional)</label>
            <input type="text" phone="hvp-cdn-phone" id="hvp-cdn-phone" />
          </div>
          <button id="hvp-cdn-step2-submit" class="button button-primary">Submit</button>
        </form>
      </div>
    </li>
    <li>
      <form>
        <p>Insert your Customer ID</p>
        <input type="text" class="hvp-input" 
          id="hvp-cdn-customerid" 
          name="hvp-cdn-customerid" 
          value="<?php echo esc_attr(get_option('hvp-cdn-customerid')); ?>" />
        <button class="button button-primary">Save</button>
      </form>
    </li>
    <li>
      <p>View video stats in your personal <a id="hvp-dashboard-link" 
        href="//holacdn.com/cp" target="_blank">Dashboard</a>. If prompted, 
        provide the username and password you gave above.
      </p>
    </li>
  </ol>
</div><!-- .end of wrap -->
