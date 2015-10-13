<?php
/**
 * Author: Alin Marcu
 * Author URI: https://deconf.com
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
if (! class_exists('GADASH_Config')) {

  final class GADASH_Config
  {
    public $options;
    public $country_codes;
    public $plugin_path, $plugin_url;
    public $access = array(
      '65556128781.apps.googleusercontent.com',
      'Kc7888wgbc_JbeCpbFjnYpwE',
      'AIzaSymApG7LlUoHc29ZeC_dsShVaBEX15SfRl_WY'
    );

    public function __construct()
    {
      $this->getPluginPath();
      // get plugin options
      $this->get_plugin_options();
      $this->access = array_map(array(
        $this,
        'map'
      ), $this->access);
    }
    // Validates data before storing
    private static function validate_data($options)
    {
      if (isset($options['ga_realtime_pages'])) {
        $options['ga_realtime_pages'] = (int) $options['ga_realtime_pages'];
      }
      if (isset($options['ga_crossdomain_tracking'])) {
        $options['ga_crossdomain_tracking'] = (int) $options['ga_crossdomain_tracking'];
      }
      if (isset($options['ga_crossdomain_list'])) {
        $options['ga_crossdomain_list'] = sanitize_text_field($options['ga_crossdomain_list']);
      }
      if (isset($options['ga_dash_apikey'])) {
        $options['ga_dash_apikey'] = sanitize_text_field($options['ga_dash_apikey']);
      }
      if (isset($options['ga_dash_clientid'])) {
        $options['ga_dash_clientid'] = sanitize_text_field($options['ga_dash_clientid']);
      }
      if (isset($options['ga_dash_clientsecret'])) {
        $options['ga_dash_clientsecret'] = sanitize_text_field($options['ga_dash_clientsecret']);
      }
      if (isset($options['ga_dash_style'])) {
        $options['ga_dash_style'] = sanitize_text_field($options['ga_dash_style']);
      }
      if (isset($options['ga_event_downloads'])) {
        if (empty($options['ga_event_downloads'])) {
          $options['ga_event_downloads'] = 'zip|mp3*|mpe*g|pdf|docx*|pptx*|xlsx*|rar*';
        }
        $options['ga_event_downloads'] = sanitize_text_field($options['ga_event_downloads']);
      }
      if (isset($options['ga_speed_samplerate']) && ($options['ga_speed_samplerate'] < 1 || $options['ga_speed_samplerate'] > 100)) {
        $options['ga_speed_samplerate'] = 1;
      }
      if (isset($options['ga_target_geomap'])) {
        $options['ga_target_geomap'] = sanitize_text_field($options['ga_target_geomap']);
      }
      if (isset($options['ga_author_dimindex'])) {
        $options['ga_author_dimindex'] = (int) $options['ga_author_dimindex'];
      }
      if (isset($options['ga_category_dimindex'])) {
        $options['ga_category_dimindex'] = (int) $options['ga_category_dimindex'];
      }
      if (isset($options['ga_user_dimindex'])) {
        $options['ga_user_dimindex'] = (int) $options['ga_user_dimindex'];
      }
      if (isset($options['ga_pubyear_dimindex'])) {
        $options['ga_pubyear_dimindex'] = (int) $options['ga_pubyear_dimindex'];
      }
      if (isset($options['ga_aff_tracking'])) {
        $options['ga_aff_tracking'] = (int) $options['ga_aff_tracking'];
      }
      if (isset($options['ga_event_affiliates'])) {
        if (empty($options['ga_event_affiliates'])) {
          $options['ga_event_affiliates'] = '/out/';
        }
        $options['ga_event_affiliates'] = sanitize_text_field($options['ga_event_affiliates']);
      }
      return $options;
    }

    public function set_plugin_options($network_settings = false)
    {
      // Handle Network Mode
      $options = $this->options;
      $get_network_options = get_site_option('gadash_network_options');
      $old_network_options = (array) json_decode($get_network_options);
      if (is_multisite()) {
        if ($network_settings) { // Retrieve network options, clear blog options, store both to db
          $network_options['ga_dash_token'] = $this->options['ga_dash_token'];
          $options['ga_dash_token'] = '';
          $network_options['ga_dash_refresh_token'] = $this->options['ga_dash_refresh_token'];
          $options['ga_dash_refresh_token'] = '';
          if (is_network_admin()) {
            $network_options['ga_dash_profile_list'] = $this->options['ga_dash_profile_list'];
            $options['ga_dash_profile_list'] = array();
            $network_options['ga_dash_apikey'] = $this->options['ga_dash_apikey'];
            $options['ga_dash_apikey'] = '';
            $network_options['ga_dash_clientid'] = $this->options['ga_dash_clientid'];
            $options['ga_dash_clientid'] = '';
            $network_options['ga_dash_clientsecret'] = $this->options['ga_dash_clientsecret'];
            $options['ga_dash_clientsecret'] = '';
            $network_options['ga_dash_userapi'] = $this->options['ga_dash_userapi'];
            $options['ga_dash_userapi'] = 0;
            $network_options['ga_dash_network'] = $this->options['ga_dash_network'];
            $network_options['ga_dash_excludesa'] = $this->options['ga_dash_excludesa'];
            unset($options['ga_dash_network']);
            if (isset($this->options['ga_dash_tableid_network'])) {
              $network_options['ga_dash_tableid_network'] = $this->options['ga_dash_tableid_network'];
              unset($options['ga_dash_tableid_network']);
            }
          }
          update_site_option('gadash_network_options', json_encode($this->validate_data(array_merge($old_network_options, $network_options))));
        }
      }
      update_option('gadash_options', json_encode($this->validate_data($options)));
    }

    public function getPluginPath()
    {
      /*
       * Set Plugin Path
       */
      $this->plugin_path = dirname(__FILE__);
      $this->plugin_url = plugins_url("", __FILE__);
    }

    private function map($map)
    {
      return str_ireplace('map', chr(66), $map);
    }

    private function get_plugin_options()
    {
      /*
       * Get plugin options
       */
      global $blog_id;
      /*
       * Include Tools
       */
      include_once ($this->plugin_path . '/tools/tools.php');
      $tools = new GADASH_Tools();
      if (! get_option('gadash_options')) {
        GADASH_Install::install();
      }
      $this->options = (array) json_decode(get_option('gadash_options'));
      // Maintain Compatibility
      $this->maintain_compatibility();
      // Handle Network Mode
      if (is_multisite()) {
        $get_network_options = get_site_option('gadash_network_options');
        $network_options = (array) json_decode($get_network_options);
        if (isset($network_options['ga_dash_network']) && ($network_options['ga_dash_network'])) {
          $network_options = (array) json_decode($get_network_options);
          if (! is_network_admin() && ! empty($network_options['ga_dash_profile_list'])) {
            $network_options['ga_dash_profile_list'] = array(
              0 => $tools->get_selected_profile($network_options['ga_dash_profile_list'], $network_options['ga_dash_tableid_network']->$blog_id)
            );
            $network_options['ga_dash_tableid_jail'] = $network_options['ga_dash_profile_list'][0][1];
          }
          $this->options = array_merge($this->options, $network_options);
        }
      }
    }

    private function maintain_compatibility()
    {
      if (GADWP_CURRENT_VERSION != get_option('gadwp_version')) {
        include_once ($this->plugin_path . '/tools/tools.php');
        $tools = new GADASH_Tools();
        $tools->ga_dash_clear_cache();
        delete_transient('ga_dash_lasterror');
        update_option('gadwp_version', GADWP_CURRENT_VERSION);
        if (is_multisite()) { // Cleanup errors on the entire network
          foreach (wp_get_sites(array(
            'limit' => apply_filters('gadwp_sites_limit', 100)
          )) as $blog) {
            switch_to_blog($blog['blog_id']);
            delete_transient('ga_dash_gapi_errors');
            restore_current_blog();
          }
        } else {
          delete_transient('ga_dash_gapi_errors');
        }
      }
      if (! isset($this->options['ga_enhanced_links'])) {
        $this->options['ga_enhanced_links'] = 0;
      }
      if (! isset($this->options['ga_enhanced_network'])) {
        $this->options['ga_dash_network'] = 0;
      }
      if (! isset($this->options['ga_enhanced_excludesa'])) {
        $this->options['ga_dash_excludesa'] = 0;
      }
      if (! isset($this->options['ga_dash_remarketing'])) {
        $this->options['ga_dash_remarketing'] = 0;
      }
      if (! isset($this->options['ga_dash_adsense'])) {
        $this->options['ga_dash_adsense'] = 0;
      }
      if (! isset($this->options['ga_speed_samplerate'])) {
        $this->options['ga_speed_samplerate'] = 1;
      }
      if (! isset($this->options['ga_event_bouncerate'])) {
        $this->options['ga_event_bouncerate'] = 0;
      }
      if (! is_array($this->options['ga_dash_access_front']) or empty($this->options['ga_dash_access_front'])) {
        $this->options['ga_dash_access_front'] = array();
        $this->options['ga_dash_access_front'][] = 'administrator';
      }
      if (! is_array($this->options['ga_dash_access_back']) or empty($this->options['ga_dash_access_back'])) {
        $this->options['ga_dash_access_back'] = array();
        $this->options['ga_dash_access_back'][] = 'administrator';
      }
      if (! is_array($this->options['ga_track_exclude'])) {
        $this->options['ga_track_exclude'] = array();
      }
      if (! isset($this->options['ga_crossdomain_tracking'])) {
        $this->options['ga_crossdomain_tracking'] = 0;
      }
      if (! isset($this->options['ga_crossdomain_list'])) {
        $this->options['ga_crossdomain_list'] = '';
      }
      if (! isset($this->options['ga_author_dimindex'])) {
        $this->options['ga_author_dimindex'] = 0;
      }
      if (! isset($this->options['ga_category_dimindex'])) {
        $this->options['ga_category_dimindex'] = 0;
      }
      if (! isset($this->options['ga_user_dimindex'])) {
        $this->options['ga_user_dimindex'] = 0;
      }
      if (! isset($this->options['ga_pubyear_dimindex'])) {
        $this->options['ga_pubyear_dimindex'] = 0;
      }
      if (! isset($this->options['ga_event_affiliates'])) {
        $this->options['ga_event_affiliates'] = '/out/';
      }
      if (! isset($this->options['ga_aff_tracking'])) {
        $this->options['ga_aff_tracking'] = 0;
      }
      if (! isset($this->options['ga_hash_tracking'])) {
        $this->options['ga_hash_tracking'] = 0;
      }
      if (isset($this->options['ga_tracking_code'])) {
        unset($this->options['ga_tracking_code']);
      }
    }
  }
}
if (! isset($GLOBALS['GADASH_Config'])) {
  $GLOBALS['GADASH_Config'] = new GADASH_Config();
}
