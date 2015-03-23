<?php

/**
 * Author: Alin Marcu
 * Author URI: https://deconf.com
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
class GADASH_Uninstall
{

  static function uninstall()
  {
    global $wpdb;
    if (is_multisite()) { // Cleanup Network install
      foreach (wp_get_sites(array(
        'limit' => apply_filters('gadwp_sites_limit', 100)
      )) as $blog) {
        switch_to_blog($blog['blog_id']);
        $sqlquery = $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_gadash%%'");
        $sqlquery = $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_timeout_gadash%%'");
        $sqlquery = $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_ga_dash%%'");
        $sqlquery = $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_timeout_ga_dash%%'");
        delete_option('gadash_options');
        delete_transient('ga_dash_lasterror');
        delete_transient('ga_dash_refresh_token');
        delete_transient('ga_dash_gapi_errors');
        restore_current_blog();
      }
      delete_site_option('gadash_network_options');
      delete_site_transient('ga_dash_refresh_token');
    } else { // Cleanup Single install
      $sqlquery = $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_gadash%%'");
      $sqlquery = $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_timeout_gadash%%'");
      $sqlquery = $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_ga_dash%%'");
      $sqlquery = $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_timeout_ga_dash%%'");
      delete_option('gadash_options');
      delete_transient('ga_dash_lasterror');
      delete_transient('ga_dash_refresh_token');
      delete_transient('ga_dash_gapi_errors');
    }
  }
}
