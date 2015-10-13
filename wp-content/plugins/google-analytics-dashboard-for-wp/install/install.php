<?php

/**
 * Author: Alin Marcu
 * Author URI: https://deconf.com
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */
class GADASH_Install
{

  static function install()
  {
    if (! get_option('ga_dash_token')) {
      $options = array();
      $options['ga_dash_apikey'] = '';
      $options['ga_dash_clientid'] = '';
      $options['ga_dash_clientsecret'] = '';
      $options['ga_dash_access_front'][] = 'administrator';
      $options['ga_dash_access_back'][] = 'administrator';
      $options['ga_dash_tableid_jail'] = '';
      $options['ga_dash_style'] = '#1e73be';
      $options['ga_dash_jailadmins'] = 1;
      $options['ga_dash_cachetime'] = 3600;
      $options['ga_dash_tracking'] = 1;
      $options['ga_dash_tracking_type'] = 'universal';
      $options['ga_dash_default_ua'] = '';
      $options['ga_dash_anonim'] = 0;
      $options['ga_dash_userapi'] = 0;
      $options['ga_event_tracking'] = 0;
      $options['ga_event_downloads'] = 'zip|mp3*|mpe*g|pdf|docx*|pptx*|xlsx*|rar*';
      $options['ga_track_exclude'] = array();
      $options['ga_target_geomap'] = '';
      $options['ga_realtime_pages'] = 10;
      $options['ga_dash_token'] = '';
      $options['ga_dash_refresh_token'] = '';
      $options['ga_dash_profile_list'] = '';
      $options['ga_dash_tableid'] = '';
      $options['ga_dash_frontend_keywords'] = 0;
      $options['ga_tracking_code'] = '';
      $options['ga_enhanced_links'] = 0;
      $options['ga_dash_remarketing'] = 0;
      $options['ga_dash_default_metric'] = 'sessions';
      $options['ga_dash_default_dimension'] = '30daysAgo';
      $options['ga_dash_frontend_stats'] = 0;
      $options['ga_dash_network'] = 0;
      $options['ga_dash_adsense'] = 0;
      $options['ga_speed_samplerate'] = 1;
      $options['ga_event_bouncerate'] = 0;
      $options['ga_crossdomain_tracking'] = 0;
      $options['ga_crossdomain_list'] = '';
      $options['ga_author_dimindex'] = 0;
      $options['ga_category_dimindex'] = 0;
      $options['ga_user_dimindex'] = 0;
      $options['ga_pubyear_dimindex'] = 0;
      $options['ga_aff_tracking'] = 0;
      $options['ga_event_affiliates'] = '/out/';
    } else {
      $options = array();
      $options['ga_dash_apikey'] = get_option('ga_dash_apikey');
      $options['ga_dash_clientid'] = get_option('ga_dash_clientid');
      $options['ga_dash_clientsecret'] = get_option('ga_dash_clientsecret');
      $options['ga_dash_access'] = get_option('ga_dash_access');
      $options['ga_dash_access_front'][] = 'administrator';
      $options['ga_dash_access_back'][] = 'administrator';
      $options['ga_dash_tableid_jail'] = get_option('ga_dash_tableid_jail');
      $options['ga_dash_frontend_stats'] = get_option('ga_dash_frontend');
      $options['ga_dash_style'] = '#1e73be';
      $options['ga_dash_jailadmins'] = get_option('ga_dash_jailadmins');
      $options['ga_dash_cachetime'] = get_option('ga_dash_cachetime');
      if (get_option('ga_dash_tracking') == 4) {
        $options['ga_dash_tracking'] = 0;
      } else {
        $options['ga_dash_tracking'] = 1;
      }
      $options['ga_dash_tracking_type'] = get_option('ga_dash_tracking_type');
      $options['ga_dash_default_ua'] = get_option('ga_dash_default_ua');
      $options['ga_dash_anonim'] = get_option('ga_dash_anonim');
      $options['ga_dash_userapi'] = get_option('ga_dash_userapi');
      $options['ga_event_tracking'] = get_option('ga_event_tracking');
      $options['ga_event_downloads'] = get_option('ga_event_downloads');
      $options['ga_track_exclude'] = array();
      $options['ga_target_geomap'] = get_option('ga_target_geomap');
      $options['ga_realtime_pages'] = get_option('ga_realtime_pages');
      $options['ga_dash_token'] = get_option('ga_dash_token');
      $options['ga_dash_refresh_token'] = get_option('ga_dash_refresh_token');
      $options['ga_dash_profile_list'] = get_option('ga_dash_profile_list');
      $options['ga_dash_tableid'] = get_option('ga_dash_tableid');
      $options['ga_dash_frontend_keywords'] = 0;
      $options['ga_enhanced_links'] = 0;
      $options['ga_dash_remarketing'] = 0;
      $options['ga_dash_default_metric'] = 'sessions';
      $options['ga_dash_default_dimension'] = '30daysAgo';
      $options['ga_dash_network'] = 0;
      $options['ga_event_bouncerate'] = 0;
      $options['ga_crossdomain_tracking'] = 0;
      $options['ga_crossdomain_list'] = '';
      $options['ga_author_dimindex'] = 0;
      $options['ga_category_dimindex'] = 0;
      $options['ga_user_dimindex'] = 0;
      $options['ga_pubyear_dimindex'] = 0;
      $options['ga_event_affiliates'] = '/out/';
      $options['ga_aff_tracking'] = 0;
      delete_option('ga_dash_apikey');
      delete_option('ga_dash_clientid');
      delete_option('ga_dash_clientsecret');
      delete_option('ga_dash_access');
      delete_option('ga_dash_access_front');
      delete_option('ga_dash_access_back');
      delete_option('ga_dash_tableid_jail');
      delete_option('ga_dash_frontend');
      delete_option('ga_dash_style');
      delete_option('ga_dash_jailadmins');
      delete_option('ga_dash_cachetime');
      delete_option('ga_dash_tracking');
      delete_option('ga_dash_tracking_type');
      delete_option('ga_dash_default_ua');
      delete_option('ga_dash_anonim');
      delete_option('ga_dash_userapi');
      delete_option('ga_event_tracking');
      delete_option('ga_event_downloads');
      delete_option('ga_track_exclude');
      delete_option('ga_target_geomap');
      delete_option('ga_realtime_pages');
      delete_option('ga_dash_token');
      delete_option('ga_dash_refresh_token');
      delete_option('ga_dash_profile_list');
      delete_option('ga_dash_tableid');
    }
    add_option('gadash_options', json_encode($options));
  }
}
