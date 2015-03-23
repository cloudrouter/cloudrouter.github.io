<?php
/**
 * Author: Alin Marcu
 * Author URI: https://deconf.com
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
if (! class_exists('GADASH_Tracking')) {

  class GADASH_Tracking
  {

    function __construct()
    {
      add_action('wp_head', array(
        $this,
        'ga_dash_tracking'
      ));
      add_action('wp_enqueue_scripts', array(
        $this,
        'ga_dash_enqueue_scripts'
      ));
    }

    function ga_dash_enqueue_scripts()
    {
      global $GADASH_Config;
      if ($GADASH_Config->options['ga_event_tracking'] and ! wp_script_is('jquery')) {
        wp_enqueue_script('jquery');
      }
    }

    function ga_dash_tracking()
    {
      global $GADASH_Config;
      /*
       * Include Tools
       */
      include_once ($GADASH_Config->plugin_path . '/tools/tools.php');
      $tools = new GADASH_Tools();
      if ($tools->check_roles($GADASH_Config->options['ga_track_exclude'], true) or ($GADASH_Config->options['ga_dash_excludesa'] and current_user_can('manage_network'))) {
        return;
      }
      $traking_mode = $GADASH_Config->options['ga_dash_tracking'];
      $traking_type = $GADASH_Config->options['ga_dash_tracking_type'];
      if ($traking_mode > 0) {
        if (! $GADASH_Config->options['ga_dash_tableid_jail']) {
          return;
        }
        if ($traking_type == "classic") {
          echo "\n<!-- BEGIN GADWP v" . GADWP_CURRENT_VERSION . " Classic Tracking - https://deconf.com/google-analytics-dashboard-wordpress/ -->\n";
          if ($GADASH_Config->options['ga_event_tracking']) {
            require_once 'tracking/events-classic.php';
          }
          require_once 'tracking/code-classic.php';
          echo "\n<!-- END GADWP Classic Tracking -->\n\n";
        } else {
          echo "\n<!-- BEGIN GADWP v" . GADWP_CURRENT_VERSION . " Universal Tracking - https://deconf.com/google-analytics-dashboard-wordpress/ -->\n";
          if ($GADASH_Config->options['ga_event_tracking'] or $GADASH_Config->options['ga_aff_tracking'] or $GADASH_Config->options['ga_hash_tracking']) {
            require_once 'tracking/events-universal.php';
          }
          require_once 'tracking/code-universal.php';
          echo "\n<!-- END GADWP Universal Tracking -->\n\n";
        }
      }
    }
  }
}
if (! is_admin()) {
  $GADASH_Tracking = new GADASH_Tracking();
}
