<?php
/**
 * Plugin Name: Google Analytics Dashboard for WP
 * Plugin URI: https://deconf.com
 * Description: Displays Google Analytics Reports and Real-Time Statistics in your Dashboard. Automatically inserts the tracking code in every page of your website.
 * Author: Alin Marcu
 * Version: 4.4.6
 * Author URI: https://deconf.com
 */
define('GADWP_CURRENT_VERSION', '4.4.6');
/*
 * Include Install
 */
include_once (dirname(__FILE__) . '/install/install.php');
register_activation_hook(__FILE__, array(
  'GADASH_Install',
  'install'
));
/*
 * Include Uninstall
 */
include_once (dirname(__FILE__) . '/install/uninstall.php');
register_uninstall_hook(__FILE__, array(
  'GADASH_Uninstall',
  'uninstall'
));
include_once (dirname(__FILE__) . '/config.php');
// Plugin i18n
add_action('plugins_loaded', 'ga_dash_load_i18n');

function ga_dash_load_i18n()
{
  load_plugin_textdomain('ga-dash', false, basename(dirname(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'gadash_init');

function gadash_init()
{
  global $GADASH_Config;
  /*
   * Include Tools
   */
  include_once ($GADASH_Config->plugin_path . '/tools/tools.php');
  $tools = new GADASH_Tools();
  if (is_admin()) {
    /*
     * Include backend widgets
     */
    if ($tools->check_roles($GADASH_Config->options['ga_dash_access_back'])) {
      include_once (dirname(__FILE__) . '/admin/dashboard_widgets.php');
    }
  } else {
    /*
     * Include frontend stats
     */
    if ($tools->check_roles($GADASH_Config->options['ga_dash_access_front']) and ($GADASH_Config->options['ga_dash_frontend_stats'] or $GADASH_Config->options['ga_dash_frontend_keywords'])) {
      include_once (dirname(__FILE__) . '/front/frontend.php');
    }
    /*
     * Include tracking
     */
    if (! $tools->check_roles($GADASH_Config->options['ga_track_exclude'], true) and $GADASH_Config->options['ga_dash_tracking']) {
      include_once (dirname(__FILE__) . '/front/tracking.php');
    }
  }
  /*
   * Include frontend widgets
   */
  include_once (dirname(__FILE__) . '/front/widgets.php');
  /*
   * Include Frontend Ajax actions
   */
  include_once ($GADASH_Config->plugin_path . '/front/ajax-actions.php');
  /*
   * Include Backend Ajax actions
   */
  include_once ($GADASH_Config->plugin_path . '/admin/ajax-actions.php');
}
