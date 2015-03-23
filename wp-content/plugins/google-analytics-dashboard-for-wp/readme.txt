=== Google Analytics Dashboard for WP ===
Contributors: deconf
Donate link: https://deconf.com/donate/
Tags: google,analytics,google analytics,dashboard,analytics dashboard,google analytics dashboard,google analytics widget,tracking,realtime,wpmu,multisite
Requires at least: 3.0
Tested up to: 4.1
Stable tag: 4.4.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Displays Google Analytics reports and real-time statistics in your WordPress Dashboard. Inserts the latest tracking code in every page of your site.

== Description ==
Using a widget, [Google Analytics Dashboard](https://deconf.com/google-analytics-dashboard-wordpress/) displays detailed analytics info and statistics about: number of visits (sessions), number of visitors (users), bounce rates, organic searches, pages per visit directly on your WordPress Dashboard.

Authorized users can also view statistics like views, unique views and searches, on frontend, at the end of each article.

> <strong>Google Analytics Dashboard on GitHub</strong><br>
> You can submit pull requests, feature requests or bugs on [Google Analytics Dashboard](https://github.com/deconf/Google-Analytics-Dashboard-for-WP) repository.

= Google Analytics Real-Time =

Google Analytics reports, in real-time, on your dashboard screen:

- displays the total number of visitors in real-time 
- real-time statistics about your acquisition channels
- per page real-time reports with traffic sources details 

= Google Analytics Reports =

The reports you need, in your dashboard and on site's frontend:  

- you can access all websites statistics in a single widget (websites within same Google Account)
- option to choose a default color for your charts, graphs and maps
- visitors by pages, referrers and searches reports
- location reports, displaying visitors by country on a Geo Map and in a table chart
- local websites and business have an option to display cities, instead of countries, on a regional map and in a table chart
- traffic overview reports with details about acquisition channels, social networks, search engines, traffic mediums and visitor type 
- user access level settings for Backend statistics and analytics reports
- user access level settings for Frontend analytics data and reports
- option to display Google Analytics statistics on frontend, at the end of each article
- frontend widget with website's analytics stats and analytics data anonymization feature
- localization support, a POT file is available for translations.

= Google Analytics Tracking =

Install the Google Analytics tracking code in less than a minute and customize it as you wish:

- enable/disable google analytics tracking code
- switch between universal analytics and classic analytics tracking methods
- supports analytics.js tracking for compatibility with Universal Analytics web property  
- supports ga.js tracking for compatibility with Classic Analytics web property
- automatically generates and inserts the Google Analytics tracking code
- IP address anonymization feature
- enhanced link attribution feature
- remarketing, demographics and interests tracking
- Google AdSense account linking
- page speed sampling rate customization
- track events feature: track downloads, emails and outbound links
- exclude traffic based on user roles
- option to exclude event tracking from bounce-rate calculation
- multiple domains / cross domain tracking
- action hook for code customization
- track authors, publication year, categories and user engagement using Google Analytics custom dimensions
- affiliate links tracking using Google Analytics events
- track fragment identifiers, hash marks (#) in URI links

= WodrPress Multisite features =

* option to choose between three working modes:
	* <em>Mode 1:</em> network activated while allowing each site administrator to authorize the plugin using a different Google Analytics account
	* <em>Mode 2:</em> network activated while authorizing an entire WordPress Network using a single Google Analytics account. You'll be able to assign a property/view to each site, from your Network Admin screen
	* <em>Mode 3:</em> network deactivated allowing each site owner to activate and authorize the plugin
* option to exclude Super Admins from tracking 

= Translations =

Google Analytics Dashboard has been translated into the following languages: Arabic, English, French, German, Hungarian, Italian, Polish, Portuguese, Spanish

= Further reading and info =

* Homepage of [Google Analytics Dashboard](https://deconf.com/google-analytics-dashboard-wordpress/) for WordPress
* Other [WordPress Plugins](https://deconf.com/wordpress/) by same author
* You can also find this plugin on [Google Analytics | Partners](https://www.google.com/analytics/partners/company/5127525902581760/gadp/5629499534213120/app/5707702298738688/listing/5639274879778816) Gallery

== Installation ==

1. Upload the full directory into your wp-content/plugins directory
2. Activate the plugin at the plugin administration page
3. Open the plugin configuration page, which is located under "Google Analytics" menu (optionally enter your API Key, Client Secret and Client ID).
4. Authorize the plugin using the 'Authorize Plugin' button
5. Go back to the plugin configuration page, which is located under "Google Analytics" menu to update/set your settings.
6. Use Google Analytics Tracking options to configure/enable/disable tracking

The documentation, tutorials and a short demo is available here: [Google Analytics Dashboard video tutorial](https://deconf.com/google-analytics-dashboard-wordpress/)

== Frequently Asked Questions == 

= I have several WordPress websites, do I need an API Project for each one? =

No, you don't. You can use the same API Project (same API Key, Client Secret and Client ID) for all your websites.

= Some settings are missing in your video tutorial ... =

We are constantly improving our plugin, sometimes the video tutorial may be a little outdated.

= More Questions? =

A dedicated section for WordPress Plugins is available here: [Wordpress Plugins Support](https://deconf.com/ask/)

== Screenshots ==

1. Google Analytics Dashboard Blue Color
2. Google Analytics Dashboard Real-Time
3. Google Analytics Dashboard Settings
4. Google Analytics Dashboard Geo Map
5. Google Analytics Dashboard Top Pages, Top Referrers and Top Searches
6. Google Analytics Dashboard Traffic Overview
7. Google Analytics Dashboard statistics per page on Frontend
8. Google Analytics Dashboard cities on region map
9. Google Analytics Dashboard Widget

== License ==

This plugin it's released under the GPLv2, you can use it free of charge on your personal or commercial website.

== Changelog ==

= 4.4.6 =
- Bugfix: maintain compatibility with WordPress 3.0+

= 4.4.5 =
- Enhancement: GAPI requests optimization 
- Enhancement: server responses improvements
- Enhancement: filter data through query options
- Bugfix: additional checks before displaying an error
- Bugfix: wrong error displayed on IE
- Bugfix: set correct Content-Type before sending responses

= 4.4.4 =
- Bug Fix: end tag missing on error message
- Bug Fix: additional checks before making a View list request
- Bug Fix: avoid deleting errors while clearing the cache
- Bug Fix: PHP notices fix for some requests
- Bug Fix: PHP notices fix when calling ob_clean on an empty buffer
- Bug Fix: frontend stats not responsive 
- Enhancement: handle some additional API errors
- Enhancement: set totals to zero when anonymize stats is enabled
- Enhancement: auto-cleanup removed; all transients have static identifiers now
- Enhancement: dump error details to JavaScript Console and throw an alert on invalid responses
- Enhancement: Italian translation, updated by [Leo](https://www.facebook.com/leo.thestrategist)

= 4.4.3 =
- Enhancement: further optimization on queries
- Enhancement: less error prone while running JavaScript
- Enhancement: GAPI errors handling improvement
- Enhancement: added GADWP_IP_VERSION constant to force a particular Internet Protocol version when needed  
- Enhancement: run the clean-up method only in settings screen
- Enhancement: added tabs to Tracking Code page
- Enhancement: added a new menu item for errors and debugging
- Enhancement: error alerts for Error & Debug sub-menu
- Enhancement: disable file cache functionality in GAPI library
- Enhancement: if cURL is not available fall-back to HTTP streams; cURL is no longer a requirement
- Enhancement: wp_get_sites limit can now be adjusted through gadwp_sites_limit filter

= 4.4.2 =
- Bug Fix: additional check for frontend widget

= 4.4.1 =
- Bug Fix: frontend widget nonce issue while using a cache plugin, reported by [Rick](https://deconf.com/ask/author/rickbates/)
- Bug Fix: clear the buffer immediately before returning AJAX response
- Bug Fix: add full-path while loading autoload.php

= 4.4 =
- Bug Fix: frontend reports and widget are not responsive
- Bug Fix: random notices for today and yesterday reports
- Enhancement: Italian translation, updated by [Leo](https://www.facebook.com/leo.thestrategist)
- Enhancement: admin widget responsive design and optimizations
- Enhancement: added acquisition channel reports
- Enhancement: added acquisition social networks reports
- Enhancement: added acquisition search engines reports
- Enhancement: new location report and countries/cities list table
- Enhancement: new pages report (removed top 24 limit)
- Enhancement: new searches report (removed top 24 limit)
- Enhancement: new referrers report (removed top 24 limit)
- Enhancement: frontend, per page reports (removed top 24 limit)
- Enhancement: added campaigns in real-time report/screen
- Enhancement: asynchronous reports loading and speed improvements
- Enhancement: code optimization for all frontend and backend features
- Enhancement: finished the error standardization process; easier debugging
- Enhancement: GAPI library update

= 4.3.11 =
- Bug Fix: improvements on QPS management
- Bug Fix: fall-back to world map when a wrong country code is entered
- Bug Fix: removed double transient call on successful authorization
- Bug Fix: PHP warning when authorizing without a Google Analytics account
- Bug Fix: switch back to initial blog after completing an error clean up in multisite mode
- Enhancement: clear all errors on version change
- Enhancement: grid lines are now transparent
- Enhancement: responsive design improvements for admin widget
- Enhancement: add css and js version number

= 4.3.10 =
- Bug Fix: removed the PHP debugging log for frontend queries
- Enhancement: adding library conflict notice in General Settings
- Enhancement: better handling of API errors
- Enhancement: added an error when user enters the Tracking ID instead of an access code    
- Enhancement: improved error reporting for frontend stats and widgets

= 4.3.9 =
- Enhancement: marking classes as final
- Enhancement: re-design the frontend widget
- Enhancement: responsive design for frontend widget
- Enhancement: responsive design for page reports
- Enhancement: error codes standardization
- Enhancement: frontend stats are now able to display the error number
- Bug Fix: load jsapi only when the frontend widget is active
- Bug Fix: javascript errors while resizing window
- Bug Fix: real-time component not loading properly in certain conditions
- Bug Fix: stop retrying when a daily limit has exceeded

= 4.3.8 =
- Enhancement: frontend component re-design
- Enhancement: optimizing frontend component to improve page loading speed
- Enhancement: optimizing frontend component to minimize GAPI requests  
- Enhancement: loading jsapi using wp-enqueue-script
- Enhancement: better escaping to avoid javascript errors

= 4.3.7 =
- Enhancement: option to exclude Super Administrator tracking for the entire network, suggested by [Marie](https://wordpress.org/support/profile/yamaryam)
- Bug Fix: warning during Network Activate, reported by [JoelStickney](https://wordpress.org/support/profile/joelstickney)
- Bug Fix: track affiliates while downloads, mailto and outbound links tracking is disabled
- Bug Fix: avoid reload loops for realtime component
- Enhancement: track fragment identifiers, hashmarks (#) in URI links
- Enhancement: improving i18n
- Enhancement: moving bounce-rate option to Advanced Tracking 

= 4.3.6 =
- Bug Fix: clear cache not working properly
- Bug Fix: error correction in Spanish localization file

= 4.3.5 =
- Bug Fix: authors custom dimension not working for pages, reported by [tylerarnold23](https://wordpress.org/support/profile/tylerarnold23)
- Bug Fix: outbound detection
- Bug Fix: fixed unicode issue, reported by [Haruka_Suzuki](https://wordpress.org/support/profile/haruka_suzuki)
- Bug Fix: properly display cities with same name from different regions, reported by [matt6303](https://wordpress.org/support/profile/matt6303)
- Enhancement: removed image extensions from default download filter
- Enhancement: add day of week to dashboard dates, suggested by [nethrs](https://deconf.com/ask/author/timnethers/)
- Enhancement: Arabic translation, translated by [Ahmed Majed](https://deconf.com/ask/author/almobdaa/)
- Bug Fix: multiple fixes for real time reports

= 4.3.4 =
- Enhancement: ga_dash_addtrackingcode action hook
- Enhancement: French translation
- Enhancement: cross domain tracking support
- Enhancement: Google Analytics custom definitions, using custom dimensions to track authors, years, categories and engagement
- Enhancement: support for affiliate links tracking 
- Enhancement: never treat downloads as outbound links

= 4.3.3 =
- Enhancement: added Polish translation
- Bug Fix: missing icon and wrong link in GADWP settings
- Enhancement: moving Page Speed SR to top, to avoid some confusions
- Enhancement: added plugin version to debugging data

= v4.3.2 =
- Bug Fix: fixes for multisite with a single Google Account
- Bug Fix: notice while displaying searches report
- Bug Fix: downloads regex update
- Bug Fix: always exclude outbound links from bounce-rate calculation 
- Enhancement: Adsense account linking
- Enhancement: adjust page speed sample rate
- Enhancement: exclude event tracking from bounce-rate calculation for downloads and mailto
- Enhancement: reset downloads filters to default when empty
- deprecate: classic analytics

= v4.3.1 =
- Bug Fix: link on top referrers list not working
- allowing today as default stats
- Bug Fix: profiles refresh issue
- Enhancement: remove table borders on frontend widget
- Bug Fix: multiple fixes for network mode
- updated GAPI libarry
- using autloader for PHP 5.3.0 and greater
- security improvements
- tracking code update

= v4.3 =
- responsive Google Charts
- single authorization for multisite
- Bug Fix: SERVER_ADDR PHP notice
- Bug Fix: notices on admin dashboard
- additional data validation and sanitizing
- Bug Fix: realtime switching profile functionality
- multisite: blog's cleanup on uninstall
- deprecating custom tracking code

= v4.2.21 =
- added hungarian translation
- added italian translation
- Bug Fix: escaping characters in google charts
- new filter on frontend widget
- cache timeout adjustments
- description update
- Bug Fix: fatal error on invalid_grant
- added timestamp on last error  
 
= v4.2.20 =
- Bug Fix: russian country map is not working
- Bug Fix: only administrator can see stats while using a cache plugin
- Bug Fix: division by zero on frontend widget
- added german translation
- added spanish translation

= v4.2.19 =
- added portuguese translation
- frontend widget CSS fix
- added remarketing, demographics and interests tracking support
- universal analytics is now the default tracking method
- CSS fix for dashboard widgets

= v4.2.18 =
- translations bugfix
- menu display tweaks
- removed debugging log file
- permissions fix for WPMU
- URI fix for frontend filters (top pages and top searches)
- exclude frontend stats in preview mode
- updated download filters
- by default administrators are not excluded from tracking
- bugfix for refresh_profiles() method 

= v4.2.17 =
- fixed on/off toggle bug for frontend settings

= v4.2.16 =
- properly nonce verification

= v4.2.15 =
- force token reset procedure when failing to authenticate
- deleting refresh token transient on uninstall
- trying to catch all possible exceptions in gapi
- no token reset on network connection errors
- fixed screen options bug
- added capability to select each role for access levels and exclude tracking
- added links to top pages table
- added links to top referrers table
- added option to display Chart&Totals/Chart/Totals to frontend widget
- retrieving realtime analytics with wp ajax
- switching to default jquery-ui-tooltip wordpress library
- fixed settings link not displayed in plugins page

= v4.2.14 =
- bugfix for error reporting
- custom API credential are now saved before starting the authorization procedure
- hiding additional info in log data

= v4.2.13 =
- bugfix for I18n
- implemented a basic debugging log
- CURL required error messages
- option to hide all other properties/views from Select Domain list
- added periodical _transient_timeout cleanup
- fixed bug in property refresh method
- disable hide option when none or a single property is available
- better handling errors when a user authorizes without actually having a Google Analytics account
- fixed bug in token revoke method
- fixed bug in token refresh method
- additional validations on frontend features


= v4.2.12 =
- refreshing charts when the time interval changes
- saving last selection
- minimizing requests by using same query serial for frontend and backend queries
- fixed bug in dashboard's switch options for non-admins
- fixed Notice: Undefined index: ga_dash_frontend_stats for new installs
- no more queries if there is no token
 
= v4.2.11 =
- added support for enhanced link attribution
- bugfix on classic tracking code

= v4.2.10 =
- using predefined color for pie charts 

= v4.2.9b =
- refresh token handles additional uncaught exceptions
- partially resolved conflicts with other analytics plugins

= v4.2.8b =
- checkboxes replaced with switch on/off buttons
- multiple bug fixes

= v4.2.7b =
- plugin code rewritten from scratch
- new enhanced, user friendly interface
- added custom tracking code
- added a new frontend widget
- cache improvements, loading speeds optimization, less GAPI queries
- responsive design

= v4.2.6 =
- google analytics api token refresh bugfix

= v4.2.5 =
- corrected wrong analytics stats reporting

= v4.2.4 =
- css fixes
- clear cache fixes

= v4.2.3 =
- time zone fixes
- hourly reports for yesterday and today
- small css fix on frontend

= v4.2.2 =
- small fixes and update

= v4.2.1 =
- fixed Domain and Subdomains tracking code for Universal Analytics 

= v4.2 =
- added google analytics real-time support
- new date ranges: Today, Yesterday, Last 30 Days and Last 90 Days 

= v4.1.5 =
- fixed "lightblack" color issue, on geomap, on light theme
- added cursor:pointer property to class .gabutton

= v4.1.4 =
- added access level option to Additional Backend Settings section 
- added access level option to Additional Frontend Settings section
- new feature for Geo Map allowing local websites to display cities, instead of countries, on a regional map
- fixed colors for Geo Chart containing world visits by country

= v4.1.3 =
- solved WooCommerce conflict using .note class
- added traffic exclusion based on user level access

= v4.1.1 =
- added missing files
- other minor fixes

= v4.1 =
- added event tracking feature: track downloads, track emails, track outbound links
- remove trailing comma for IE8 compatibility

= v4.0.4 =
- a better way to retrieve domains and subdomains from profiles
- remove escaping slashes generating errors on table display

= v4.0.3 =
- improvements on tracking code
- redundant variable for default domain name
- fix for "cannot redeclare class URI_Template_Parser" error
- added Settings to plugins page
- modified Google Profiles timeouts

= v4.0.2 =
- minimize Google Analytics API requests
- new warnings available on Admin Option Page
- avoid any unnecessary profile list update
- avoid errors output for regular users while adding the tracking code

= v4.0.1 =
- fixed some 'Undefined index' notices
- cache fix to decrease number of API requests

= v4.0 =

* simplified authorization process for beginners
* advanced users can use their own API Project

= v3.5.3 =

* translation fix, textdomain ga-dash everywhere

= v3.5.2 =

* some small javascript fixes for google tracking code

= v3.5.1 =

* renamed function get_main_domain() to ga_dash_get_main_domain

= v3.5 =

* small bug fix for multiple TLD domains tracking and domain with subdomains tracking
* added universal analytics support (you can track visits using analytics.js or using ga.js)

= v3.4.1 =

* switch to domain names instead of profile names on select lists
* added is_front_page() check to avoid problems in Woocommerce

= v3.4 =

* i8n improvements
* RTL improvements
* usability and accessibility improvements
* added google analytics tracking features

= v3.3.3 =

* a better way to determine temp dir for google api cache

= v3.3.3 =

* added error handles 
* added quick support buttons
* added Sticky Notes
* switched from Visits to Views vs UniqueViews on frontpage
* fixed select lists issues after implementing translation, fixed frontend default google analytics profile
* added frontpage per article statistics

= v3.2 =

* added multilingual support
* small bug fix when locking admins to a single google analytics profile

= v3.1 =

* added Traffic Overview in Pie Charts
* added lock google analytics profile feature for Admins
* code optimization

= v3.0 =

* added Geo Map, sortable tables
* minor fixes

= v2.5 =

* added cache feature
* simplifying google analytics api authorizing process

= v2.0 =

* added light theme
* added top pages tab
* added top searches tab
* added top referrers tab
* added display settings

= v1.6 =

* admins can jail access level to a single google analytics profile

= v1.5 =

* added multi-website support
* table ids and profile names are now automatically retrived from google analytics

= v1.4 =

* added View access levels (be caution, ex: if level is set to "Authors" than all editors and authors will have view access)
* fixed menu display issue

= v1.3 =

* switch to Google API PHP Client 0.6.1
* resolved some Google Analytics Dashboard conflicts

= v1.2.1 =

* minor fixes on google analytics api
* added video tutorials

= v1.2 =

* minor fixes

= v1.0 =

* first release
