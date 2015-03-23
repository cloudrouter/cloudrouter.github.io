<?php
/**
 * Author: Alin Marcu
 * Author URI: http://deconf.com
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
if (! class_exists('GADASH_Frontend_Ajax')) {

  final class GADASH_Frontend_Ajax
  {

    function __construct()
    {
      // Frontend Reports/Page action
      add_action('wp_ajax_gadash_get_frontend_pagereports', array(
        $this,
        'ajax_afterpost_reports'
      ));
      // Frontend Widget actions
      add_action('wp_ajax_gadash_get_frontendwidget_data', array(
        $this,
        'ajax_frontend_widget'
      ));
      add_action('wp_ajax_nopriv_gadash_get_frontendwidget_data', array(
        $this,
        'ajax_frontend_widget'
      ));
    }

    function send_json($response)
    {
      @header('Content-Type: application/json; charset=' . get_option('blog_charset'));
      echo json_encode($response);
      if (defined('DOING_AJAX') && DOING_AJAX)
        wp_die();
      else
        die();
    }    

    /**
     * Ajax handler for getting analytics data for frontend Views vs UniqueViews
     *
     * @return string|int
     */
    function ajax_afterpost_reports()
    {
      global $GADASH_Config;
      if (! isset($_REQUEST['gadash_security_pagereports']) or ! wp_verify_nonce($_REQUEST['gadash_security_pagereports'], 'gadash_get_frontend_pagereports')) {
        wp_die(- 30);
      }
      $page_url = esc_url($_REQUEST['gadash_pageurl']);
      $post_id = (int) $_REQUEST['gadash_postid'];
      $query = $_REQUEST['query'];
      if (ob_get_length()) {
        ob_clean();
      }
      /*
       * Include Tools
       */
      include_once ($GADASH_Config->plugin_path . '/tools/tools.php');
      $tools = new GADASH_Tools();
      if (! $tools->check_roles($GADASH_Config->options['ga_dash_access_front']) or ! ($GADASH_Config->options['ga_dash_frontend_stats'] or $GADASH_Config->options['ga_dash_frontend_keywords'])) {
        wp_die(- 31);
      }
      if ($GADASH_Config->options['ga_dash_token'] and $GADASH_Config->options['ga_dash_tableid_jail']) {
        include_once ($GADASH_Config->plugin_path . '/tools/gapi.php');
        global $GADASH_GAPI;
      } else {
        wp_die(- 24);
      }
      $projectId = $GADASH_Config->options['ga_dash_tableid_jail'];
      $profile_info = $tools->get_selected_profile($GADASH_Config->options['ga_dash_profile_list'], $projectId);
      if (isset($profile_info[4])) {
        $GADASH_GAPI->timeshift = $profile_info[4];
      } else {
        $GADASH_GAPI->timeshift = (int) current_time('timestamp') - time();
      }
      if (! $GADASH_GAPI->client->getAccessToken()) {
        wp_die(- 25);
      }
      switch ($query) {
        case 'pageviews':
          $this->send_json($GADASH_GAPI->frontend_afterpost_pageviews($projectId, $page_url, $post_id));
          break;
        default:
          $this->send_json($GADASH_GAPI->frontend_afterpost_searches($projectId, $page_url, $post_id));
          break;
      }
    }
    // Frontend Widget Reports
    /**
     * Ajax handler for getting analytics data for frontend Widget
     *
     * @return string|int
     */
    function ajax_frontend_widget()
    {
      global $GADASH_Config;
      if (! isset($_REQUEST['gadash_number']) or ! isset($_REQUEST['gadash_optionname']) or ! is_active_widget(false, false, 'gadash_frontend_widget')) {
        wp_die(- 30);
      }
      $widget_index = $_REQUEST['gadash_number'];
      $option_name = $_REQUEST['gadash_optionname'];
      $options = get_option($option_name);
      if (isset($options[$widget_index])) {
        $instance = $options[$widget_index];
      } else {
        wp_die(- 32);
      }
      switch ($instance['period']) { // make sure we have a valid request
        case '7daysAgo':
          $period = '7daysAgo';
          break;
        case '14daysAgo':
          $period = '14daysAgo';
          break;
        default:
          $period = '30daysAgo';
          break;
      }
      if (ob_get_length()) {
        ob_clean();
      }
      if ($GADASH_Config->options['ga_dash_token'] and $GADASH_Config->options['ga_dash_tableid_jail']) {
        include_once ($GADASH_Config->plugin_path . '/tools/gapi.php');
        global $GADASH_GAPI;
        include_once ($GADASH_Config->plugin_path . '/tools/tools.php');
        $tools = new GADASH_Tools();
      } else {
        wp_die(- 24);
      }
      $projectId = $GADASH_Config->options['ga_dash_tableid_jail'];
      $profile_info = $tools->get_selected_profile($GADASH_Config->options['ga_dash_profile_list'], $projectId);
      if (isset($profile_info[4])) {
        $GADASH_GAPI->timeshift = $profile_info[4];
      } else {
        $GADASH_GAPI->timeshift = (int) current_time('timestamp') - time();
      }
      if (! $GADASH_GAPI->client->getAccessToken()) {
        wp_die(- 25);
      }
      $this->send_json($GADASH_GAPI->frontend_widget_stats($projectId, $period, (int) $instance['anonim']));
    }
  }
}
$GADASH_Frontend_Ajax = new GADASH_Frontend_Ajax();
