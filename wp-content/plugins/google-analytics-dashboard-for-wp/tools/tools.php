<?php
/**
 * Author: Alin Marcu
 * Author URI: https://deconf.com
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
if (! class_exists('GADASH_Tools')) {

  class GADASH_Tools
  {

    function guess_default_domain($profiles)
    {
      $domain = get_option('siteurl');
      $domain = str_ireplace(array(
        'http://',
        'https://'
      ), '', $domain);
      if (is_array($profiles)) {
        foreach ($profiles as $items) {
          if (strpos($items[3], $domain)) {
            return $items[1];
          }
        }
        return $profiles[0][1];
      } else {
        return '';
      }
    }

    function get_selected_profile($profiles, $profile)
    {
      if (is_array($profiles)) {
        foreach ($profiles as $item) {
          if ($item[1] == $profile) {
            return $item;
          }
        }
      }
    }

    function get_root_domain($domain)
    {
      $root = explode('/', $domain);
      preg_match("/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i", str_ireplace('www', '', isset($root[2]) ? $root[2] : $domain), $root);
      return $root;
    }

    function ga_dash_get_profile_domain($domain)
    {
      return str_replace(array(
        "https://",
        "http://",
        " "
      ), "", $domain);
    }

    function ga_dash_clear_cache()
    {
      global $wpdb;
      $sqlquery = $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_gadash%%'");
      $sqlquery = $wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_timeout_gadash%%'");
    }

    function ga_dash_safe_get($key)
    {
      if (array_key_exists($key, $_POST)) {
        return $_POST[$key];
      }
      return false;
    }

    function colourVariator($colour, $per)
    {
      $colour = substr($colour, 1);
      $rgb = '';
      $per = $per / 100 * 255;
      if ($per < 0) {
        // Darker
        $per = abs($per);
        for ($x = 0; $x < 3; $x ++) {
          $c = hexdec(substr($colour, (2 * $x), 2)) - $per;
          $c = ($c < 0) ? 0 : dechex($c);
          $rgb .= (strlen($c) < 2) ? '0' . $c : $c;
        }
      } else {
        // Lighter
        for ($x = 0; $x < 3; $x ++) {
          $c = hexdec(substr($colour, (2 * $x), 2)) + $per;
          $c = ($c > 255) ? 'ff' : dechex($c);
          $rgb .= (strlen($c) < 2) ? '0' . $c : $c;
        }
      }
      return '#' . $rgb;
    }

    function check_roles($access_level, $tracking = false)
    {
      if (is_user_logged_in() && isset($access_level)) {
        global $current_user;
        $roles = (array) $current_user->roles;
        if ((current_user_can('manage_options')) and ! $tracking) {
          return true;
        }
        if (count(array_intersect($roles, $access_level)) > 0) {
          return true;
        } else {
          return false;
        }
      }
    }
  }
}
