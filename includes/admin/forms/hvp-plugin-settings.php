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

$cdn_customerid = get_option('hvp-cdn-customerid');
wp_add_inline_script('hvp_ga_script', "ga('hvp.set', 'page', 'hvp-plugin-settings'); ga('hvp.send', 'pageview');");
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
      <?php if ($cdn_customerid) { ?>
          <p>HolaCDN analytics account activated!!</p>
      <?php } else { ?>
        <a href="//holacdn.com?need_signup=1&cam=wordpress" target="_blank"
        onclick="window.ga('hvp.send', 'event', 'hvp-cdn-signup', 'click')"
        class="button button-primary">Sign up</a> for HolaCDN.
      <?php } ?>
    </li>
    <li>
      <form method="post" name="hvp-cdn-customerid" action="options.php">
        <?php settings_fields('hvp-cdn-settings'); ?>
        <?php do_settings_sections('hvp-cdn-settings'); ?>
        <p>Insert your Customer ID. You can find your customer ID at <a
        href="https://holacdn.com/cp/account" target="_blank">your HolaCDN
        account page</a>.</p>
        <input type="text" class="hvp-input"
          id="hvp-cdn-customerid" name="hvp-cdn-customerid"
          onchange="window.ga('hvp.send', 'event', 'hvp-cdn-customerid', 'change')"
          value="<?php echo esc_attr(get_option('hvp-cdn-customerid')); ?>" />
        <?php submit_button(); ?>
      </form>
    </li>
    <li>
      <p>View video stats in your personal <a id="hvp-dashboard-link"
        onclick="window.ga('hvp.send', 'event', 'hvp-dashboard-link', 'click')"
        href="//holacdn.com/cp/stats/dashboard" target="_blank">Dashboard</a>.
      </p>
      <p><a href="mailto:sales@holacdn.com?subject=Help with HolaCDN on Wordpress&cc=or@hola.org">
        Contact us for help.</a>
      </p>
    </li>
  </ol>
</div><!-- .end of wrap -->
