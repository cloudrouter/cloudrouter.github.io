<?php
	class WpFastestCacheAdmin extends WpFastestCache{
		private $menuTitle = "WP Fastest Cache";
		private $pageTitle = "WP Fastest Cache Settings";
		private $adminPageUrl = "wp-fastest-cache/admin/index.php";
		private $systemMessage = array();
		private $options = array();
		private $cronJobSettings;
		private $startTime;
		private $blockCache = false;

		public function __construct(){
			$this->options = $this->getOptions();
			
			$this->optionsPageRequest();
			$this->iconUrl = plugins_url("wp-fastest-cache/images/icon-32x32.png");
			$this->setCronJobSettings();
			$this->addButtonOnEditor();
			add_action('admin_enqueue_scripts', array($this, 'addJavaScript'));
			$this->checkActivePlugins();

			if(file_exists(plugin_dir_path(__FILE__)."admin-toolbar.php")){
				add_action( 'wp_loaded', array($this, "load_admin_toolbar") );
			}
		}
		public function load_admin_toolbar(){
			if (current_user_can( 'manage_options' ) || current_user_can('edit_others_pages')) {
				include_once plugin_dir_path(__FILE__)."admin-toolbar.php";

				add_action('wp_ajax_wpfc_delete_cache', array($this, "deleteCacheToolbar"));
				add_action('wp_ajax_wpfc_delete_cache_and_minified', array($this, "deleteCssAndJsCacheToolbar"));
				
				$toolbar = new WpFastestCacheAdminToolbar();
				$toolbar->add();
			}
		}

		public function deleteCacheToolbar(){
			$this->deleteCache();
		}

		public function deleteCssAndJsCacheToolbar(){
			$this->deleteCssAndJsCache();
		}

		public function checkActivePlugins(){
			//for WP-Polls
			if($this->isPluginActive('wp-polls/wp-polls.php')){
				require_once "wp-polls.php";
				$wp_polls = new WpPollsForWpFc();
				$wp_polls->hook();
			}
		}

		public function addButtonOnEditor(){
			add_action('admin_print_footer_scripts', array($this, 'addButtonOnQuicktagsEditor'));
			add_action('init', array($this, 'myplugin_buttonhooks'));
		}

		public function checkShortCode($content){
			preg_match("/\[wpfcNOT\]/", $content, $wpfcNOT);
			if(count($wpfcNOT) > 0){
				if(is_single() || is_page()){
					$this->blockCache = true;
				}
				$content = str_replace("[wpfcNOT]", "", $content);
			}
			return $content;
		}

		public function myplugin_buttonhooks() {
		   // Only add hooks when the current user has permissions AND is in Rich Text editor mode
		   if ( ( current_user_can('edit_posts') || current_user_can('edit_pages') ) && get_user_option('rich_editing') ) {
		     add_filter("mce_external_plugins", array($this, "myplugin_register_tinymce_javascript"));
		     add_filter('mce_buttons', array($this, 'myplugin_register_buttons'));
		   }
		}
		// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
		public function myplugin_register_tinymce_javascript($plugin_array) {
		   $plugin_array['wpfc'] = plugins_url('../js/button.js?v='.time(),__file__);
		   return $plugin_array;
		}

		public function myplugin_register_buttons($buttons) {
		   array_push($buttons, 'wpfc');
		   return $buttons;
		}

		public function addButtonOnQuicktagsEditor(){
			if (wp_script_is('quicktags')){ ?>
				<script type="text/javascript">
				    QTags.addButton('wpfc_not', 'wpfcNOT', '<!--[wpfcNOT]-->', '', '', 'Block caching for this page');
			    </script>
		    <?php }
		}

		public function optionsPageRequest(){
			if(!empty($_POST)){
				if(isset($_POST["wpFastestCachePage"])){
					include_once ABSPATH."wp-includes/capabilities.php";
					include_once ABSPATH."wp-includes/pluggable.php";

					if(is_multisite()){
						$this->systemMessage = array("The plugin does not work with Multisite", "error");
						return 0;
					}

					if(current_user_can('manage_options')){
						if($_POST["wpFastestCachePage"] == "options"){
							$this->saveOption();
						}else if($_POST["wpFastestCachePage"] == "deleteCache"){
							$this->deleteCache();
						}else if($_POST["wpFastestCachePage"] == "deleteCssAndJsCache"){
							$this->deleteCssAndJsCache();
						}else if($_POST["wpFastestCachePage"] == "cacheTimeout"){
							$this->addCacheTimeout();
						}else if($_POST["wpFastestCachePage"] == "exclude"){
							$this->save_exclude_pages();
						}
					}else{
						die("Forbidden");
					}
				}
			}
		}

		public function save_exclude_pages(){
			$rules = array();

			for($i = 1; $i < count($_POST); $i++){
				$rule = array();

				if(isset($_POST["wpfc-exclude-rule-prefix-".$i]) && $_POST["wpfc-exclude-rule-prefix-".$i] && $_POST["wpfc-exclude-rule-content-".$i]){
					$rule["prefix"] = $_POST["wpfc-exclude-rule-prefix-".$i];
					$rule["content"] = $_POST["wpfc-exclude-rule-content-".$i];

					array_push($rules, $rule);
				}
			}

			$data = json_encode($rules);

			if(get_option("WpFastestCacheExclude")){
				update_option("WpFastestCacheExclude", $data);
			}else{
				add_option("WpFastestCacheExclude", $data, null, "yes");
			}

			$this->systemMessage = array("Options have been saved", "success");
		}

		public function addCacheTimeout(){
			if(isset($_POST["wpFastestCacheTimeOut"])){
				if($_POST["wpFastestCacheTimeOut"]){
					if(isset($_POST["wpFastestCacheTimeOutHour"]) && is_numeric($_POST["wpFastestCacheTimeOutHour"])){
						if(isset($_POST["wpFastestCacheTimeOutMinute"]) && is_numeric($_POST["wpFastestCacheTimeOutMinute"])){
							$selected = mktime($_POST["wpFastestCacheTimeOutHour"], $_POST["wpFastestCacheTimeOutMinute"], 0, date("n"), date("j"), date("Y"));

							if($selected > time()){
								$timestamp = $selected;
							}else{
								if(time() - $selected < 60){
									$timestamp = $selected + 60;
								}else{
									// if selected time is less than now, 24hours is added
									$timestamp = $selected + 24*60*60;
								}
							}

							wp_clear_scheduled_hook($this->slug());
							wp_schedule_event($timestamp, $_POST["wpFastestCacheTimeOut"], $this->slug());
						}else{
							echo "Minute was not set";
							exit;
						}
					}else{
						echo "Hour was not set";
						exit;
					}
				}else{
					wp_clear_scheduled_hook($this->slug());
				}
			}
		}

		public function deleteCssAndJsCache(){
			delete_option("WpFastestCacheCSS");
			delete_option("WpFastestCacheCSSSIZE");
			delete_option("WpFastestCacheJS");
			delete_option("WpFastestCacheJSSIZE");

			if(is_dir($this->getWpContentDir()."/cache/wpfc-minified")){
				$this->rm_folder_recursively($this->getWpContentDir()."/cache/wpfc-minified");
				$this->deleteCache(true);
			}else{
				$this->deleteCache();
				$this->systemMessage = array("Already deleted","success");
			}
		}

		public function setCronJobSettings(){
			if(wp_next_scheduled($this->slug())){
				$this->cronJobSettings["period"] = wp_get_schedule($this->slug());
				$this->cronJobSettings["time"] = wp_next_scheduled($this->slug());
			}
		}

		public function addMenuPage(){
			add_action('admin_menu', array($this, 'register_my_custom_menu_page'));
		}

		public function addJavaScript(){
			wp_enqueue_script("wpfc-language", plugins_url("wp-fastest-cache/js/language.js"), array(), time(), false);
			wp_enqueue_script("wpfc-info", plugins_url("wp-fastest-cache/js/info.js"), array(), time(), true);
			wp_enqueue_script("wpfc-schedule", plugins_url("wp-fastest-cache/js/schedule.js"), array(), time(), true);
			
			if(class_exists("WpFastestCacheImageOptimisation")){
				wp_enqueue_script("wpfc-statics", plugins_url("wp-fastest-cache/js/statics.js"), array(), time(), false);
			}
			
			if(isset($this->options->wpFastestCacheLanguage) && $this->options->wpFastestCacheLanguage != "eng"){
				wp_enqueue_script("wpfc-dictionary", plugins_url("wp-fastest-cache/js/lang/".$this->options->wpFastestCacheLanguage.".js"), array(), time(), false);
			}
		}

		public function register_my_custom_menu_page(){
			if(function_exists('add_menu_page')){ 
				add_menu_page($this->pageTitle, $this->menuTitle, 'manage_options', "WpFastestCacheOptions", array($this, 'optionsPage'), $this->iconUrl, "99.".time() );
				wp_enqueue_style("wp-fastest-cache", plugins_url("wp-fastest-cache/css/style.css"), array(), time(), "all");
			}
			
			wp_enqueue_style("wp-fastest-cache-toolbar", plugins_url("wp-fastest-cache/css/toolbar.css"), array(), time(), "all");
			
			if(isset($_GET["page"]) && $_GET["page"] == "WpFastestCacheOptions"){
				wp_enqueue_style("wp-fastest-cache-buycredit", plugins_url("wp-fastest-cache/css/buycredit.css"), array(), time(), "all");
				wp_enqueue_style("wp-fastest-cache-flaticon", plugins_url("wp-fastest-cache/css/flaticon.css"), array(), time(), "all");
			}
		}

		public function saveOption(){
			unset($_POST["wpFastestCachePage"]);
			$data = json_encode($_POST);
			//for optionsPage() $_POST is array and json_decode() converts to stdObj
			$this->options = json_decode($data);

			$this->systemMessage = $this->modifyHtaccess($_POST);

			if(isset($this->systemMessage[1]) && $this->systemMessage[1] != "error"){

				if($message = $this->checkCachePathWriteable()){


					if(is_array($message)){
						$this->systemMessage = $message;
					}else{
						if(get_option("WpFastestCache")){
							update_option("WpFastestCache", $data);
						}else{
							add_option("WpFastestCache", $data, null, "yes");
						}
					}
				}
			}
		}

		public function checkCachePathWriteable(){
			$message = array();

			if(!is_dir($this->getWpContentDir()."/cache/")){
				if (@mkdir($this->getWpContentDir()."/cache/", 0755, true)){
					//
				}else{
					array_push($message, "- /wp-content/cache/ is needed to be created");
				}
			}else{
				if (@mkdir($this->getWpContentDir()."/cache/testWpFc/", 0755, true)){
					rmdir($this->getWpContentDir()."/cache/testWpFc/");
				}else{
					array_push($message, "- /wp-content/cache/ permission has to be 755");
				}
			}

			if(!is_dir($this->getWpContentDir()."/cache/all/")){
				if (@mkdir($this->getWpContentDir()."/cache/all/", 0755, true)){
					//
				}else{
					array_push($message, "- /wp-content/cache/all/ is needed to be created");
				}
			}else{
				if (@mkdir($this->getWpContentDir()."/cache/all/testWpFc/", 0755, true)){
					rmdir($this->getWpContentDir()."/cache/all/testWpFc/");
				}else{
					array_push($message, "- /wp-content/cache/all/ permission has to be 755");
				}	
			}

			if(count($message) > 0){
				return array(implode("<br>", $message), "error");
			}else{
				return true;
			}
		}

		public function modifyHtaccess($post){
			$path = ABSPATH;
			if($this->is_subdirectory_install()){
				$path = $this->getABSPATH();
			}

			if(!file_exists($path.".htaccess")){
				return array("<label>.htaccess was not found</label> <a target='_blank' href='http://www.wpfastestcache.com/warnings/htaccess-was-not-found/'>Read More</a>", "error");
			}

			if(isset($_SERVER["SERVER_SOFTWARE"]) && $_SERVER["SERVER_SOFTWARE"] && preg_match("/iis/i", $_SERVER["SERVER_SOFTWARE"])){
				return array("The plugin does not work with Microsoft IIS only with Apache", "error");
			}

			if($this->isPluginActive('wp-postviews/wp-postviews.php')){
				$wp_postviews_options = get_option("views_options");
				$wp_postviews_options["use_ajax"] = true;
				update_option("views_options", $wp_postviews_options);

				if(!WP_CACHE){
					if($wp_config = @file_get_contents(ABSPATH."wp-config.php")){
						$wp_config = str_replace("\$table_prefix", "define('WP_CACHE', true);\n\$table_prefix", $wp_config);

						if(!@file_put_contents(ABSPATH."wp-config.php", $wp_config)){
							return array("define('WP_CACHE', true); is needed to be added into wp-config.php", "error");
						}
					}else{
						return array("define('WP_CACHE', true); is needed to be added into wp-config.php", "error");
					}
				}
			}

			$htaccess = file_get_contents($path.".htaccess");

			if(defined('DONOTCACHEPAGE')){
				return array("DONOTCACHEPAGE <label>constant is defined as TRUE. It must be FALSE</label>", "error");
			}else if(!get_option('permalink_structure')){
				return array("You have to set <strong><u><a href='".admin_url()."options-permalink.php"."'>permalinks</a></u></strong>", "error");
			}else if($res = $this->checkSuperCache($path, $htaccess)){
				return $res;
			}else if($this->isPluginActive('adrotate/adrotate.php')){
				return $this->warningIncompatible("AdRotate");
			}else if($this->isPluginActive('mobilepress/mobilepress.php')){
				return $this->warningIncompatible("MobilePress", array("name" => "WPtouch Mobile", "url" => "https://wordpress.org/plugins/wptouch/"));
			}else if($this->isPluginActive('bwp-minify/bwp-minify.php')){
				return array("Better WordPress Minify needs to be deactive<br>This plugin has aldready Minify feature", "error");
			}else if($this->isPluginActive('gzippy/gzippy.php')){
				return array("GZippy needs to be deactive<br>This plugin has aldready Gzip feature", "error");
			}else if($this->isPluginActive('gzip-ninja-speed-compression/gzip-ninja-speed.php')){
				return array("GZip Ninja Speed Compression needs to be deactive<br>This plugin has aldready Gzip feature", "error");
			}else if($this->isPluginActive('wordpress-gzip-compression/ezgz.php')){
				return array("WordPress Gzip Compression needs to be deactive<br>This plugin has aldready Gzip feature", "error");
			}else if($this->isPluginActive('filosofo-gzip-compression/filosofo-gzip-compression.php')){
				return array("GZIP Output needs to be deactive<br>This plugin has aldready Gzip feature", "error");
			}else if(is_writable($path.".htaccess")){
				$htaccess = $this->insertLBCRule($htaccess, $post);
				$htaccess = $this->insertGzipRule($htaccess, $post);
				$htaccess = $this->insertRewriteRule($htaccess, $post);
				$htaccess = preg_replace("/\n+/","\n", $htaccess);

				file_put_contents($path.".htaccess", $htaccess);
			}else{
				return array(".htaccess is not writable", "error");
			}
			return array("Options have been saved", "success");

		}

		public function warningIncompatible($incompatible, $alternative = false){
			if($alternative){
				return array($incompatible." <label>needs to be deactive</label><br><label>We advise</label> <a id='alternative-plugin' target='_blank' href='".$alternative["url"]."'>".$alternative["name"]."</a>", "error");
			}else{
				return array($incompatible." <label>needs to be deactive</label>", "error");
			}
		}

		public function insertLBCRule($htaccess, $post){
			if(isset($post["wpFastestCacheLBC"]) && $post["wpFastestCacheLBC"] == "on"){


			$data = "# BEGIN LBCWpFastestCache"."\n".
					'<FilesMatch "\.(ico|pdf|flv|jpg|jpeg|png|gif|js|css|swf|x-html|css|xml|js|woff|ttf|svg|eot)(\.gz)?$">'."\n".
					'<IfModule mod_expires.c>'."\n".
					'ExpiresActive On'."\n".
					'ExpiresDefault A0'."\n".
					'ExpiresByType image/gif A2592000'."\n".
					'ExpiresByType image/png A2592000'."\n".
					'ExpiresByType image/jpg A2592000'."\n".
					'ExpiresByType image/jpeg A2592000'."\n".
					'ExpiresByType image/ico A2592000'."\n".
					'ExpiresByType text/css A2592000'."\n".
					'ExpiresByType text/javascript A2592000'."\n".
					'ExpiresByType application/javascript A2592000'."\n".
					'</IfModule>'."\n".
					'<IfModule mod_headers.c>'."\n".
					'Header set Expires "max-age=2592000, public"'."\n".
					'Header unset ETag'."\n".
					'Header set Connection keep-alive'."\n".
					'</IfModule>'."\n".
					'FileETag None'."\n".
					'</FilesMatch>'."\n".
					"# END LBCWpFastestCache"."\n";

				preg_match("/BEGIN LBCWpFastestCache/", $htaccess, $check);
				if(count($check) === 0){
					return $data.$htaccess;
				}else{
					return $htaccess;
				}
			}else{
				//delete levere browser caching
				$htaccess = preg_replace("/#\s?BEGIN\s?LBCWpFastestCache.*?#\s?END\s?LBCWpFastestCache/s", "", $htaccess);
				return $htaccess;
			}
		}

		public function insertGzipRule($htaccess, $post){
			if(isset($post["wpFastestCacheGzip"]) && $post["wpFastestCacheGzip"] == "on"){
		    	$data = "# BEGIN GzipWpFastestCache"."\n".
		          		"<IfModule mod_deflate.c>"."\n".
		          		"AddOutputFilterByType DEFLATE image/svg+xml"."\n".
		  				"AddOutputFilterByType DEFLATE text/plain"."\n".
		  				"AddOutputFilterByType DEFLATE text/html"."\n".
		  				"AddOutputFilterByType DEFLATE text/xml"."\n".
		  				"AddOutputFilterByType DEFLATE text/css"."\n".
		  				"AddOutputFilterByType DEFLATE application/xml"."\n".
		  				"AddOutputFilterByType DEFLATE application/xhtml+xml"."\n".
		  				"AddOutputFilterByType DEFLATE application/rss+xml"."\n".
		  				"AddOutputFilterByType DEFLATE application/javascript"."\n".
		  				"AddOutputFilterByType DEFLATE application/x-javascript"."\n".
		  				"AddOutputFilterByType DEFLATE application/x-font-ttf"."\n".
						"AddOutputFilterByType DEFLATE application/vnd.ms-fontobject"."\n".
						"AddOutputFilterByType DEFLATE font/opentype font/ttf font/eot font/otf"."\n".
		  				"</IfModule>"."\n".
						"# END GzipWpFastestCache"."\n";


				$htaccess = preg_replace("/#\s?BEGIN\s?GzipWpFastestCache.*?#\s?END\s?GzipWpFastestCache/s", "", $htaccess);
				return $data.$htaccess;

			}else{
				//delete gzip rules
				$htaccess = preg_replace("/#\s?BEGIN\s?GzipWpFastestCache.*?#\s?END\s?GzipWpFastestCache/s", "", $htaccess);
				return $htaccess;
			}
		}

		public function insertRewriteRule($htaccess, $post){
			if(isset($post["wpFastestCacheStatus"]) && $post["wpFastestCacheStatus"] == "on"){
				$htaccess = preg_replace("/#\s?BEGIN\s?WpFastestCache.*?#\s?END\s?WpFastestCache/s", "", $htaccess);
				$htaccess = $this->getHtaccess().$htaccess;
			}else{
				$htaccess = preg_replace("/#\s?BEGIN\s?WpFastestCache.*?#\s?END\s?WpFastestCache/s", "", $htaccess);
				$this->deleteCache();
			}

			return $htaccess;
		}

		public function prefixRedirect(){
			$forceTo = "";

			if(preg_match("/^https:\/\//", home_url())){
				if(preg_match("/^https:\/\/www\./", home_url())){
					$forceTo = "\nRewriteCond %{HTTP_HOST} ^".str_replace("www.", "", $_SERVER["HTTP_HOST"])."\n".
							   "RewriteRule ^(.*)$ ".preg_quote(home_url(), "/")."\/$1 [R=301,L]"."\n".
							   "RewriteCond %{HTTPS} !=on"."\n".
							   "RewriteCond %{HTTP_HOST} ^www.".str_replace("www.", "", $_SERVER["HTTP_HOST"])."\n".
							   "RewriteRule ^(.*)$ ".preg_quote(home_url(), "/")."\/$1 [R=301,L]"."\n";
				}else{
					$forceTo = "\nRewriteCond %{HTTP_HOST} ^www.".str_replace("www.", "", $_SERVER["HTTP_HOST"])."\n".
							   "RewriteRule ^(.*)$ https://".str_replace("www.", "", $_SERVER["HTTP_HOST"])."/$1 [R=301,L]"."\n".
							   "RewriteCond %{HTTPS} !=on"."\n".
							   "RewriteCond %{HTTP_HOST} ^".str_replace("www.", "", $_SERVER["HTTP_HOST"])."\n".
							   "RewriteRule ^(.*)$ ".preg_quote(home_url(), "/")."\/$1 [R=301,L]"."\n";
				}
			}else{
				if(preg_match("/^http:\/\/www\./", home_url())){
					$forceTo = "\nRewriteCond %{HTTP_HOST} ^".str_replace("www.", "", $_SERVER["HTTP_HOST"])."\n".
							   "RewriteRule ^(.*)$ ".preg_quote(home_url(), "/")."\/$1 [R=301,L]"."\n";
				}else{
					$forceTo = "\nRewriteCond %{HTTP_HOST} ^www.".str_replace("www.", "", $_SERVER["HTTP_HOST"])." [NC]"."\n".
							   "RewriteRule ^(.*)$ ".preg_quote(home_url(), "/")."\/$1 [R=301,L]"."\n";
				}
			}
			return $forceTo;
		}

		public function getHtaccess(){
			$mobile = "";
			$loggedInUser = "";

			if(isset($_POST["wpFastestCacheMobile"]) && $_POST["wpFastestCacheMobile"] == "on"){
				$mobile = "RewriteCond %{HTTP_USER_AGENT} !^.*(".$this->getMobileUserAgents().").*$ [NC]"."\n";
			}

			if(isset($_POST["wpFastestCacheLoggedInUser"]) && $_POST["wpFastestCacheLoggedInUser"] == "on"){
				$loggedInUser = "RewriteCond %{HTTP:Cookie} !^.*(comment_author_|wordpress_logged_in|wp-postpass_|wp_woocommerce_session).*$"."\n";
			}

			$data = "# BEGIN WpFastestCache"."\n".
					"<IfModule mod_rewrite.c>"."\n".
					"RewriteEngine On"."\n".
					"RewriteBase /"."\n".
					"AddDefaultCharset UTF-8"."\n".$this->ruleForWpContent().
					$this->prefixRedirect().
					"RewriteCond %{REQUEST_METHOD} !POST"."\n".
					"RewriteCond %{QUERY_STRING} !.*=.*"."\n".$loggedInUser.
					'RewriteCond %{HTTP:X-Wap-Profile} !^[a-z0-9\"]+ [NC]'."\n".
					'RewriteCond %{HTTP:Profile} !^[a-z0-9\"]+ [NC]'."\n".$mobile;
			

			if(ABSPATH == "//"){
				$data = $data."RewriteCond %{DOCUMENT_ROOT}/".WPFC_WP_CONTENT_BASENAME."/cache/all/$1/index.html -f"."\n";
			}else{
				$data = $data."RewriteCond %{DOCUMENT_ROOT}/".WPFC_WP_CONTENT_BASENAME."/cache/all/$1/index.html -f [or]"."\n";
				$data = $data."RewriteCond ".WPFC_WP_CONTENT_DIR."/cache/all/".$this->getRewriteBase(true)."$1/index.html -f"."\n";
			}

			$data = $data.'RewriteRule ^(.*) "/'.$this->getRewriteBase().WPFC_WP_CONTENT_BASENAME.'/cache/all/'.$this->getRewriteBase(true).'$1/index.html" [L]'."\n";
			
			//RewriteRule !/  "/wp-content/cache/all/index.html" [L]


			if(class_exists("WpFcMobileCache") && $this->options->wpFastestCacheMobileTheme){
				$wpfc_mobile = new WpFcMobileCache();
				$wpfc_mobile->set_wptouch($this->isPluginActive('wptouch/wptouch.php'));
				$data = $data."\n\n\n".$wpfc_mobile->update_htaccess($data);
			}

			$data = $data."</IfModule>"."\n".
					"<FilesMatch \"\.(html|htm)$\">"."\n".
					"FileETag None"."\n".
					"<ifModule mod_headers.c>"."\n".
					"Header unset ETag"."\n".
					"Header set Cache-Control \"max-age=0, no-cache, no-store, must-revalidate\""."\n".
					"Header set Pragma \"no-cache\""."\n".
					"Header set Expires \"Mon, 29 Oct 1923 20:30:00 GMT\""."\n".
					"</ifModule>"."\n".
					"</FilesMatch>"."\n".
					"# END WpFastestCache"."\n";
			return $data;
		}

		public function ruleForWpContent(){
			$newContentPath = str_replace(home_url(), "", content_url());
			if(!preg_match("/wp-content/", $newContentPath)){
				$newContentPath = trim($newContentPath, "/");
				return "RewriteRule ^".$newContentPath."/cache/(.*) ".WPFC_WP_CONTENT_DIR."/cache/$1 [L]"."\n";
			}
			return "";
		}

		public function getRewriteBase($sub = ""){
			if($sub && $this->is_subdirectory_install()){
				$trimedProtocol = preg_replace("/http:\/\/|https:\/\//", "", trim(home_url(), "/"));
				$path = strstr($trimedProtocol, '/');

				if($path){
					return trim($path, "/")."/";
				}else{
					return "";
				}
			}
			
			$url = rtrim(site_url(), "/");
			preg_match("/https?:\/\/[^\/]+(.*)/", $url, $out);

			if(isset($out[1]) && $out[1]){
				return trim($out[1], "/")."/";
			}else{
				return "";
			}
		}



		public function checkSuperCache($path, $htaccess){
			if($this->isPluginActive('wp-super-cache/wp-cache.php')){
				return array("WP Super Cache needs to be deactive", "error");
			}else{
				@unlink($path."wp-content/wp-cache-config.php");

				$message = "";
				
				if(is_file($path."wp-content/wp-cache-config.php")){
					$message .= "<br>- be sure that you removed /wp-content/wp-cache-config.php";
				}

				if(preg_match("/supercache/", $htaccess)){
					$message .= "<br>- be sure that you removed the rules of super cache from the .htaccess";
				}

				return $message ? array("WP Super Cache cannot remove its own remnants so please follow the steps below".$message, "error") : "";
			}

			return "";
		}

		public function optionsPage(){
			$this->systemMessage = count($this->systemMessage) > 0 ? $this->systemMessage : $this->getSystemMessage();

			$wpFastestCacheCombineCss = isset($this->options->wpFastestCacheCombineCss) ? 'checked="checked"' : "";
			$wpFastestCacheGzip = isset($this->options->wpFastestCacheGzip) ? 'checked="checked"' : "";
			$wpFastestCacheCombineJs = isset($this->options->wpFastestCacheCombineJs) ? 'checked="checked"' : "";
			$wpFastestCacheCombineJsPowerFul = isset($this->options->wpFastestCacheCombineJsPowerFul) ? 'checked="checked"' : "";
			$wpFastestCacheLanguage = isset($this->options->wpFastestCacheLanguage) ? $this->options->wpFastestCacheLanguage : "eng";
			$wpFastestCacheLBC = isset($this->options->wpFastestCacheLBC) ? 'checked="checked"' : "";
			$wpFastestCacheLoggedInUser = isset($this->options->wpFastestCacheLoggedInUser) ? 'checked="checked"' : "";
			$wpFastestCacheMinifyCss = isset($this->options->wpFastestCacheMinifyCss) ? 'checked="checked"' : "";

			$wpFastestCacheMinifyCssPowerFul = isset($this->options->wpFastestCacheMinifyCssPowerFul) ? 'checked="checked"' : "";


			$wpFastestCacheMinifyHtml = isset($this->options->wpFastestCacheMinifyHtml) ? 'checked="checked"' : "";
			$wpFastestCacheMinifyHtmlPowerFul = isset($this->options->wpFastestCacheMinifyHtmlPowerFul) ? 'checked="checked"' : "";


			$wpFastestCacheMobile = isset($this->options->wpFastestCacheMobile) ? 'checked="checked"' : "";
			$wpFastestCacheMobileTheme = isset($this->options->wpFastestCacheMobileTheme) ? 'checked="checked"' : "";

			$wpFastestCacheNewPost = isset($this->options->wpFastestCacheNewPost) ? 'checked="checked"' : "";
			
			$wpFastestCacheRemoveComments = isset($this->options->wpFastestCacheRemoveComments) ? 'checked="checked"' : "";

			$wpFastestCacheStatus = isset($this->options->wpFastestCacheStatus) ? 'checked="checked"' : "";
			$wpFastestCacheTimeOut = isset($this->cronJobSettings["period"]) ? $this->cronJobSettings["period"] : "";
			?>
			<div class="wrap">
				<h2>WP Fastest Cache Options</h2>
				<?php if($this->systemMessage){ ?>
					<div class="updated <?php echo $this->systemMessage[1]."-wpfc"; ?>" id="message"><p><?php echo $this->systemMessage[0]; ?></p></div>
				<?php } ?>
				<div class="tabGroup">
					<?php
						$tabs = array(array("id"=>"wpfc-options","title"=>"Settings"),
									  array("id"=>"wpfc-deleteCache","title"=>"Delete Cache"),
									  array("id"=>"wpfc-cacheTimeout","title"=>"Cache Timeout"));

						if(class_exists("WpFastestCacheImageOptimisation")){
						}
							array_push($tabs, array("id"=>"wpfc-imageOptimisation","title"=>"Image Optimization"));
						
						array_push($tabs, array("id"=>"wpfc-premium","title"=>"Premium"));

						array_push($tabs, array("id"=>"wpfc-exclude","title"=>"Exclude"));

						foreach ($tabs as $key => $value){
							$checked = "";

							//tab of "delete css and js" has been removed so there is need to check it
							if(isset($_POST["wpFastestCachePage"]) && $_POST["wpFastestCachePage"] && $_POST["wpFastestCachePage"] == "deleteCssAndJsCache"){
								$_POST["wpFastestCachePage"] = "deleteCache";
							}

							if(!isset($_POST["wpFastestCachePage"]) && $value["id"] == "wpfc-options"){
								$checked = ' checked="checked" ';
							}else if((isset($_POST["wpFastestCachePage"])) && ("wpfc-".$_POST["wpFastestCachePage"] == $value["id"])){
								$checked = ' checked="checked" ';
							}
							echo '<input '.$checked.' type="radio" id="'.$value["id"].'" name="tabGroup1">'."\n";
							echo '<label for="'.$value["id"].'">'.$value["title"].'</label>'."\n";
						}
					?>
				    <br>
				    <div class="tab1" style="padding-left:10px;">
						<form method="post" name="wp_manager">
							<input type="hidden" value="options" name="wpFastestCachePage">
							<div class="questionCon">
								<div class="question">Cache System</div>
								<div class="inputCon"><input type="checkbox" <?php echo $wpFastestCacheStatus; ?> id="wpFastestCacheStatus" name="wpFastestCacheStatus"><label for="wpFastestCacheStatus">Enable</label></div>
							</div>

							<div class="questionCon">
								<div class="question">Logged-in Users</div>
								<div class="inputCon"><input type="checkbox" <?php echo $wpFastestCacheLoggedInUser; ?> id="wpFastestCacheLoggedInUser" name="wpFastestCacheLoggedInUser"><label for="wpFastestCacheLoggedInUser">Don't show the cached version for logged-in users</label></div>
							</div>

							<div class="questionCon">
								<div class="question">Mobile</div>
								<div class="inputCon"><input type="checkbox" <?php echo $wpFastestCacheMobile; ?> id="wpFastestCacheMobile" name="wpFastestCacheMobile"><label for="wpFastestCacheMobile">Don't show the cached version for desktop to mobile devices</label></div>
							</div>

							<?php if(class_exists("WpFastestCachePowerfulHtml")){ ?>
							<div class="questionCon">
								<div class="question">Mobile Theme</div>
								<div class="inputCon"><input type="checkbox" <?php echo $wpFastestCacheMobileTheme; ?> id="wpFastestCacheMobileTheme" name="wpFastestCacheMobileTheme"><label for="wpFastestCacheMobileTheme">Create cache for mobile theme</label></div>
							</div>
							<?php }else{ ?>
							<div class="questionCon disabled">
								<div class="question">Mobile Theme</div>
								<div class="inputCon"><input type="checkbox" id="wpFastestCacheMobileTheme"><label for="wpFastestCacheMobileTheme">Create cache for mobile theme</label></div>
							</div>
							<?php } ?>

							<div class="questionCon">
								<div class="question">New Post</div>
								<div class="inputCon"><input type="checkbox" <?php echo $wpFastestCacheNewPost; ?> id="wpFastestCacheNewPost" name="wpFastestCacheNewPost"><label for="wpFastestCacheNewPost">Clear all cache files when a post or page is published</label></div>
							</div>
							<div class="questionCon">
								<div class="question">Minify HTML</div>
								<div class="inputCon"><input type="checkbox" <?php echo $wpFastestCacheMinifyHtml; ?> id="wpFastestCacheMinifyHtml" name="wpFastestCacheMinifyHtml"><label for="wpFastestCacheMinifyHtml">You can decrease the size of page</label></div>
								<div class="get-info"><a target="_blank" href="http://www.wpfastestcache.com/optimization/minify-html/"><img src="<?php echo plugins_url("wp-fastest-cache/images/info.png"); ?>" /></a></div>
							</div>

							<?php if(class_exists("WpFastestCachePowerfulHtml")){ ?>
							<div class="questionCon">
								<div class="question">Minify HTML Plus</div>
								<div class="inputCon"><input type="checkbox" <?php echo $wpFastestCacheMinifyHtmlPowerFul; ?> id="wpFastestCacheMinifyHtmlPowerFul" name="wpFastestCacheMinifyHtmlPowerFul"><label for="wpFastestCacheMinifyHtmlPowerFul">More powerful minify html</label></div>
							</div>
							<?php }else{ ?>
							<div class="questionCon disabled">
								<div class="question">Minify HTML Plus</div>
								<div class="inputCon"><input type="checkbox" id="wpFastestCacheMinifyHtmlPowerFul"><label for="wpFastestCacheMinifyHtmlPowerFul">More powerful minify html</label></div>
							</div>
							<?php } ?>



							<div class="questionCon">
								<div class="question">Minify Css</div>
								<div class="inputCon"><input type="checkbox" <?php echo $wpFastestCacheMinifyCss; ?> id="wpFastestCacheMinifyCss" name="wpFastestCacheMinifyCss"><label for="wpFastestCacheMinifyCss">You can decrease the size of css files</label></div>
								<div class="get-info"><a target="_blank" href="http://www.wpfastestcache.com/optimization/minify-css/"><img src="<?php echo plugins_url("wp-fastest-cache/images/info.png"); ?>" /></a></div>
							</div>



							<?php if(class_exists("WpFastestCachePowerfulHtml") && method_exists("WpFastestCachePowerfulHtml", "minify_css")){ ?>
							<div class="questionCon">
								<div class="question">Minify Css Plus</div>
								<div class="inputCon"><input type="checkbox" <?php echo $wpFastestCacheMinifyCssPowerFul; ?> id="wpFastestCacheMinifyCssPowerFul" name="wpFastestCacheMinifyCssPowerFul"><label for="wpFastestCacheMinifyCssPowerFul">More powerful minify css</label></div>
							</div>
							<?php }else{ ?>
							<div class="questionCon disabled">
								<div class="question">Minify Css Plus</div>
								<div class="inputCon"><input type="checkbox" id="wpFastestCacheMinifyCssPowerFul"><label for="wpFastestCacheMinifyCssPowerFul">More powerful minify css</label></div>
							</div>
							<?php } ?>




							<div class="questionCon">
								<div class="question">Combine Css</div>
								<div class="inputCon"><input type="checkbox" <?php echo $wpFastestCacheCombineCss; ?> id="wpFastestCacheCombineCss" name="wpFastestCacheCombineCss"><label for="wpFastestCacheCombineCss">Reduce HTTP requests through combined css files</label></div>
								<div class="get-info"><a target="_blank" href="http://www.wpfastestcache.com/optimization/combine-js-css-files/"><img src="<?php echo plugins_url("wp-fastest-cache/images/info.png"); ?>" /></a></div>
							</div>
							<div class="questionCon">
								<div class="question">Combine Js</div>
								<div class="inputCon"><input type="checkbox" <?php echo $wpFastestCacheCombineJs; ?> id="wpFastestCacheCombineJs" name="wpFastestCacheCombineJs"><label for="wpFastestCacheCombineJs">Reduce HTTP requests through combined js files</label></div>
								<div class="get-info"><a target="_blank" href="http://www.wpfastestcache.com/optimization/combine-js-css-files/"><img src="<?php echo plugins_url("wp-fastest-cache/images/info.png"); ?>" /></a></div>
							</div>



							<?php if(class_exists("WpFastestCachePowerfulHtml")){ ?>
							<div class="questionCon">
								<div class="question">Combine Js Plus</div>
								<div class="inputCon"><input type="checkbox" <?php echo $wpFastestCacheCombineJsPowerFul; ?> id="wpFastestCacheCombineJsPowerFul" name="wpFastestCacheCombineJsPowerFul"><label for="wpFastestCacheCombineJsPowerFul">Minify the combined js files</label></div>
							</div>
							<?php }else{ ?>
							<div class="questionCon disabled">
								<div class="question">Combine Js Plus</div>
								<div class="inputCon"><input type="checkbox" id="wpFastestCacheCombineJsPowerFul"><label for="wpFastestCacheCombineJsPowerFul">Minify the combined js files</label></div>
							</div>
							<?php } ?>




							<?php if(class_exists("WpFastestCachePowerfulHtml")){ ?>
							<div class="questionCon">
								<div class="question">Remove Comments</div>
								<div class="inputCon"><input type="checkbox" <?php echo $wpFastestCacheRemoveComments; ?> id="wpFastestCacheRemoveComments" name="wpFastestCacheRemoveComments"><label for="wpFastestCacheRemoveComments">Remove the comment tags between &#60;head&#62;&#60;/head&#62;</label></div>
							</div>
							<?php }else{ ?>
							<div class="questionCon disabled">
								<div class="question">Remove Comments</div>
								<div class="inputCon"><input type="checkbox" id="wpFastestCacheRemoveComments"><label for="wpFastestCacheRemoveComments">Remove the comment tags between &#60;head&#62;&#60;/head&#62;</label></div>
							</div>
							<?php } ?>







							<div class="questionCon">
								<div class="question">Gzip</div>
								<div class="inputCon"><input type="checkbox" <?php echo $wpFastestCacheGzip; ?> id="wpFastestCacheGzip" name="wpFastestCacheGzip"><label for="wpFastestCacheGzip">Reduce the size of files sent from your server</label></div>
								<div class="get-info"><a target="_blank" href="http://www.wpfastestcache.com/optimization/enable-gzip-compression/"><img src="<?php echo plugins_url("wp-fastest-cache/images/info.png"); ?>" /></a></div>
							</div>

							<div class="questionCon">
								<div class="question">Browser Caching</div>
								<div class="inputCon"><input type="checkbox" <?php echo $wpFastestCacheLBC; ?> id="wpFastestCacheLBC" name="wpFastestCacheLBC"><label for="wpFastestCacheLBC">Reduce page load times for repeat visitors</label></div>
								<div class="get-info"><a target="_blank" href="http://www.wpfastestcache.com/optimization/leverage-browser-caching/"><img src="<?php echo plugins_url("wp-fastest-cache/images/info.png"); ?>" /></a></div>
							</div>

							<div class="questionCon">
								<div class="question">Language</div>
								<div class="inputCon">
									<select id="wpFastestCacheLanguage" name="wpFastestCacheLanguage">
									  <option value="de">Deutsch</option>
									  <option value="eng">English</option>
									  <option value="fr">Français</option>
									  <option value="es">Español</option>
									  <option value="it">Italiana</option>
									  <option value="ja">日本語</option>
									  <option value="pt">Português</option>
									  <option value="ru">Русский</option>
									  <!-- <option value="ro">Română</option> -->
									  <option value="tr">Türkçe</option>
									  <!-- <option value="ukr">Українська</option> -->
									</select> 
								</div>
							</div>
							<div class="questionCon qsubmit">
								<div class="submit"><input type="submit" value="Submit" class="button-primary"></div>
							</div>
						</form>
				    </div>
				    <div class="tab2">
				    	<div id="container-show-hide-logs" style="display:none; float:right; padding-right:20px; cursor:pointer;">
				    		<span id="show-delete-log">Show Logs</span>
				    		<span id="hide-delete-log" style="display:none;">Hide Logs</span>
				    	</div>

				    	<?php 
			   				if(class_exists("WpFastestCacheStatics")){
				   				$cache_statics = new WpFastestCacheStatics();
				   				$cache_statics->statics();
			   				}
				   		?>

				    	<form method="post" name="wp_manager" class="delete-line">
				    		<input type="hidden" value="deleteCache" name="wpFastestCachePage">
				    		<div class="questionCon qsubmit left">
				    			<div class="submit"><input type="submit" value="Delete Cache" class="button-primary"></div>
				    		</div>
				    		<div class="questionCon right">
				    			<div style="padding-left:11px;">
				    			<label>You can delete all cache files</label><br>
				    			<label>Target folder</label> <b><?php echo $this->getWpContentDir(); ?>/cache/all</b>
				    			</div>
				    		</div>
				   		</form>
				   		<form method="post" name="wp_manager" class="delete-line" style="height: 120px;">
				    		<input type="hidden" value="deleteCssAndJsCache" name="wpFastestCachePage">
				    		<div class="questionCon qsubmit left">
				    			<div class="submit"><input type="submit" value="Delete Cache and Minified CSS/JS" class="button-primary"></div>
				    		</div>
				    		<div class="questionCon right">
				    			<div style="padding-left:11px;">
				    			<label>If you modify any css file, you have to delete minified css files</label><br>
				    			<label>All cache files will be removed as well</label><br>
				    			<label>Target folder</label> <b><?php echo $this->getWpContentDir(); ?>/cache/all</b><br>
				    			<!-- <label>Target folder</label> <b><?php echo $this->getWpContentDir(); ?>/cache/wpfc-mobile-cache</b><br> -->
				    			<label>Target folder</label> <b><?php echo $this->getWpContentDir(); ?>/cache/wpfc-minified</b>
				    			</div>
				    		</div>
				   		</form>
				   		<?php 
				   				if(class_exists("WpFastestCacheLogs")){
					   				$logs = new WpFastestCacheLogs("delete");
					   				$logs->printLogs();
				   				}
				   		?>
				    </div>
				    <div class="tab3">
				    	<form method="post" name="wp_manager" id="wpfc-schedule-panel">
				    		<input type="hidden" value="cacheTimeout" name="wpFastestCachePage">
				    		<div class="questionCon">
				    			<label style="padding-left:11px;">All cached files are deleted at the determinated time.</label>
				    		</div>
				    		<div class="questionCon" style="text-align: center;padding-top: 10px;">

				    			<span>First Job Time:</span>
				    			<select id="wpFastestCacheTimeOutHour" name="wpFastestCacheTimeOutHour">
				    				<option selected="" value="">Hour</option>
				    				<?php
				    					for($i = 0; $i < 24; $i++){
				    						echo "<option value='".$i."'>".$i."</option>";
				    					}

				    				?>
				    			</select>
				    			<select id="wpFastestCacheTimeOutMinute" name="wpFastestCacheTimeOutMinute">
				    				<option selected="" value="">Minute</option>
				    				<?php
				    					for($i = 0; $i < 60; $i++){
				    						echo "<option value='".$i."'>".$i."</option>";
				    					}

				    				?>
				    			</select>&ensp;&ensp;&ensp;
				    			<span>Frequency: </span>
								<select id="wpFastestCacheTimeOut" name="wpFastestCacheTimeOut">
									<?php

										$schedules = wp_get_schedules();
										$first = true;
										foreach ($schedules as $key => $value) {
											if(isset($value["wpfc"]) && $value["wpfc"]){
												if($first){
													echo "<option value=''>Choose One</option>";
													$first = false;
												}
												echo "<option value='{$key}'>{$value["display"]}</option>";
											}
										}

										// $arrSettings = array(array("value" => "", "text" => "Choose One"),
										// 					array("value" => "everyfiveminute", "text" => "Once Every 5 Minutes"),
										// 					array("value" => "everyfifteenminute", "text" => "Once Every 15 Minutes"),
										// 					array("value" => "twiceanhour", "text" => "Twice an Hour"),
										// 					array("value" => "onceanhour", "text" => "Once an Hour"),
										// 					array("value" => "everysixhours", "text" => "Once Every 6 Hours"),
										// 					array("value" => "onceaday", "text" => "Once a Day"),
										// 					array("value" => "weekly", "text" => "Once a Week"),
										// 					array("value" => "montly", "text" => "Once a Month'")
										// 				);

										// foreach ($arrSettings as $key => $value) {
										// 	//$checked = $value["value"] == $wpFastestCacheTimeOut ? 'selected=""' : "";
										// 	echo "<option value='{$value["value"]}'>{$value["text"]}</option>";
										// }
									?>
								</select> 
							</div>
							<?php if($wpFastestCacheTimeOut){ ?>
								<div class="questionCon">
									<table class="widefat fixed" style="border:0;border-top:1px solid #DEDBD1;border-radius:0;margin: 5px 4% 0 4%;width: 92%;">
										<thead>
											<tr>
												<th scope="col" style="border-left:1px solid #DEDBD1;border-top-left-radius:0;">Next due</th>
												<th scope="col" style="border-right:1px solid #DEDBD1;border-top-right-radius:0;">Schedule</th>
											</tr>
										</thead>
											<tbody>
												<tr>
													<th scope="row" style="border-left:1px solid #DEDBD1;"><?php echo date("d-m-Y @ H:i", $this->cronJobSettings["time"]); ?></th>
													<td style="border-right:1px solid #DEDBD1;"><?php echo $this->cronJobSettings["period"]; ?>
														<label id="deleteCron">[ x ]</label>
													</td>
												</tr>
												<?php if($this->cronJobSettings["period"] == "twicedaily"){ ?>
													<tr>
														<th scope="row" style="border-left:1px solid #DEDBD1;"><?php echo date("d-m-Y @ H:i", $this->cronJobSettings["time"] + 12*60*60); ?></th>
														<td style="border-right:1px solid #DEDBD1;"><?php echo $this->cronJobSettings["period"]; ?></td>
													</tr>
												<?php } ?>
											</tbody>
									</table>
					    		</div>
				    		<?php } ?>
				    		<div class="questionCon" style="text-align: center;padding-top: 10px;">
				    			<strong><label>Server time</label>: <label id="wpfc-server-time"><?php echo date("Y/m/d H:i:s"); ?></label></strong>
				    		</div>
				    		<div class="questionCon qsubmit">
				    			<div class="submit"><input type="submit" value="Submit" class="button-primary"></div>
				    		</div>
				   		</form>
				    </div>
				    <?php if(class_exists("WpFastestCacheImageOptimisation")){ ?>
					    <div class="tab4">
					    	<h2 style="padding-left:20px;padding-bottom:10px;">Optimize Image Tool</h2>

					    		<?php $xxx = new WpFastestCacheImageOptimisation(); ?>
					    		<?php $xxx->statics(); ?>
						    	<?php $xxx->imageList(); ?>
					    </div>
				    <?php }else{ ?>
						<div class="tab4" style="">
							<div style="z-index:9999;width: 160px; height: 60px; position: absolute; margin-left: 254px; margin-top: 74px; color: white;">
								<div style="font-family:sans-serif;font-size:13px;text-align: center; border-radius: 5px; float: left; background-color: rgb(51, 51, 51); color: white; width: 147px; padding: 20px 50px;">
									<label>Only available in Premium version</label>
								</div>
							</div>
							<h2 style="opacity: 0.3;padding-left:20px;padding-bottom:10px;">Optimize Image Tool</h2>
							<div id="container-show-hide-image-list" style="opacity: 0.3;float: right; padding-right: 20px; cursor: pointer;">
								<span id="show-image-list">Show Images</span>
								<span id="hide-image-list" style="display:none;">Hide Images</span>
							</div>
							<div style="opacity: 0.3;width:100%;float:left;" id="wpfc-image-static-panel">
								<div style="float: left; width: 100%;">
									<div style="float:left;padding-left: 22px;padding-right:15px;">
										<div style="display: inline-block;">
											<div style="width: 150px; height: 150px; position: relative; border-top-left-radius: 150px; border-top-right-radius: 150px; border-bottom-right-radius: 150px; border-bottom-left-radius: 150px; background-color: #ffcc00;">
												

												<div style="position: absolute; top: 0px; left: 0px; width: 150px; height: 150px; border-top-left-radius: 150px; border-top-right-radius: 150px; border-bottom-right-radius: 150px; border-bottom-left-radius: 150px; clip: rect(0px 150px 150px 75px);">
													<div style="position: absolute; top: 0px; left: 0px; width: 150px; height: 150px; border-radius: 150px; clip: rect(0px, 75px, 150px, 0px); transform: rotate(109.62deg); background-color: rgb(255, 165, 0); border-spacing: 109.62px;" id="wpfc-pie-chart-little"></div>
												</div>


												<div style="display:none;position: absolute; top: 0px; left: 0px; width: 150px; height: 150px; border-top-left-radius: 150px; border-top-right-radius: 150px; border-bottom-right-radius: 150px; border-bottom-left-radius: 150px; clip: rect(0px 150px 150px 25px); -webkit-transform: rotate(0deg); transform: rotate(0deg);" id="wpfc-pie-chart-big-container-first">
													<div style="position: absolute; top: 0px; left: 0px; width: 150px; height: 150px; border-top-left-radius: 150px; border-top-right-radius: 150px; border-bottom-right-radius: 150px; border-bottom-left-radius: 150px; clip: rect(0px 75px 150px 0px); -webkit-transform: rotate(180deg); transform: rotate(180deg); background-color: #FFA500;"></div>
												</div>
												<div style="display:none;position: absolute; top: 0px; left: 0px; width: 150px; height: 150px; border-top-left-radius: 150px; border-top-right-radius: 150px; border-bottom-right-radius: 150px; border-bottom-left-radius: 150px; clip: rect(0px 150px 150px 75px); -webkit-transform: rotate(180deg); transform: rotate(180deg);" id="wpfc-pie-chart-big-container-second-right">
													<div style="position: absolute; top: 0px; left: 0px; width: 150px; height: 150px; border-top-left-radius: 150px; border-top-right-radius: 150px; border-bottom-right-radius: 150px; border-bottom-left-radius: 150px; clip: rect(0px 75px 150px 0px); -webkit-transform: rotate(90deg); transform: rotate(90deg); background-color: #FFA500;" id="wpfc-pie-chart-big-container-second-left"></div>
												</div>

											</div>
											<div style="width: 114px;height: 114px;margin-top: -133px;background-color: white;margin-left: 18px;position: absolute;border-radius: 150px;">
												<p style="text-align:center;margin:27px 0 0 0;color: black;">Succeed</p>
												<p style="text-align: center; font-size: 18px; font-weight: bold; font-family: verdana; margin: -2px 0px 0px; color: black;" id="wpfc-optimized-statics-percent" class="">30.45</p>
												<p style="text-align:center;margin:0;color: black;">%</p>
											</div>
										</div>
									</div>
									<div style="float: left;padding-left:12px;" id="wpfc-statics-right">
										<ul style="list-style: none outside none;float: left;">
											<li>
												<div style="background-color: rgb(29, 107, 157);width:15px;height:15px;float:left;margin-top:4px;border-radius:5px;"></div>
												<div style="float:left;padding-left:6px;">All JPEG</div>
												<div style="font-size: 14px; font-weight: bold; color: black; float: left; width: 65%; margin-left: 5px;" id="wpfc-optimized-statics-total_image_number" class="">7196</div>
											</li>
											<li>
												<div style="background-color: rgb(29, 107, 157);width:15px;height:15px;float:left;margin-top:4px;border-radius:5px;"></div>
												<div style="float:left;padding-left:6px;">Pending</div>
												<div style="font-size: 14px; font-weight: bold; color: black; float: left; width: 65%; margin-left: 5px;" id="wpfc-optimized-statics-pending" class="">5002</div>
											</li>
											<li>
												<div style="background-color: #FF0000;width:15px;height:15px;float:left;margin-top:4px;border-radius:5px;"></div>
												<div style="float:left;padding-left:6px;">Errors</div>
												<div style="font-size: 14px; font-weight: bold; color: black; float: left; width: 65%; margin-left: 5px;" id="wpfc-optimized-statics-error" class="">3</div>
											</li>
										</ul>
										<ul style="list-style: none outside none;float: left;">
											<li>
												<div style="background-color: rgb(61, 207, 60);width:15px;height:15px;float:left;margin-top:4px;border-radius:5px;"></div>
												<div style="float:left;padding-left:6px;"><span>Optimized Images</span></div>
												<div style="font-size: 14px; font-weight: bold; color: black; float: left; width: 65%; margin-left: 5px;" id="wpfc-optimized-statics-optimized" class="">2191</div>
											</li>

											<li>
												<div style="background-color: rgb(61, 207, 60);width:15px;height:15px;float:left;margin-top:4px;border-radius:5px;"></div>
												<div style="float:left;padding-left:6px;"><span>Total Reduction</span></div>
												<div style="font-size: 14px; font-weight: bold; color: black; float: left; width: 80%; margin-left: 5px;" id="wpfc-optimized-statics-reduction" class="">78400.897</div>
											</li>
											<li></li>
										</ul>

										<ul style="list-style: none outside none;float: left;">
											<li>
												<h1 style="margin-top:0;float:left;">Credit: <span style="display: inline-block; height: 16px; width: auto;min-width:25px;" id="wpfc-optimized-statics-credit" class="">9910</span></h1>
												<span id="buy-image-credit">More</span>
											</li>
											<li>
												<input type="submit" class="button-primary" value="Optimize All JPEG" id="wpfc-optimize-images-button" style="width:100%;height:110px;">
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
				    <?php } ?>
				    <div class="tab5">
				    	<?php
				    		if(!get_option("WpFc_api_key")){
				    			update_option("WpFc_api_key", md5(microtime(true)));
				    		}
				    	?>
				    	<style type="text/css">
				    		#wpfc-premium-container{
				    			overflow: hidden;
				    		}
				    		.wpfc-premium-step{
				    			width: 246px;
				    			float: left;
				    			margin-left: 3px;
				    		}
				    		.wpfc-premium-step div{
				    			float: left !important;
				    		}
				    		.wpfc-premium-step-header{
				    			width: 100%; 
				    			background-color: rgb(58, 158, 235); 
				    			padding-top: 12px;
				    			padding-bottom: 11px;
				    			text-align: center;
				    		}
				    		.wpfc-premium-step-header label{
				    			font-size: 17pt !important;
				    			color: white !important;
				    		}
				    		.wpfc-premium-step-content{
				    			font-size: 16px !important;
				    			line-height: 20px !important;
				    			padding-top: 25px !important;
				    			padding-left: 25px !important;
				    			height: 100px;
				    		}
				    		.wpfc-premium-step-footer p{
				    			font-size: 15px !important;
				    		}
				    		.wpfc-premium-step-footer ul li{
				    			background: url("<?php echo plugins_url("wp-fastest-cache/images/blue-check.png"); ?>") no-repeat scroll 0 2px transparent;
				    			padding: 3px 30px;
				    			font-size: 15px;
				    		}
				    		.wpfc-premium-step-footer{
				    			padding-left: 25px;
				    		}
				    		.wpfc-premium-step-image{
				    			width: 100%; 
				    			height: 180px;
				    			text-align: center;
				    		}
				    	</style>
				    	<div id="wpfc-premium-container">
				    		<div class="wpfc-premium-step">
				    			<div class="wpfc-premium-step-header">
				    				<label>Discover Feautures</label>
				    			</div>
				    			<div class="wpfc-premium-step-content">
				    				In the premium version there are some new features which speed up the sites more.
				    			</div>
				    			<div class="wpfc-premium-step-image">
				    				<img src="<?php echo plugins_url("wp-fastest-cache/images/rocket.png"); ?>" />
				    			</div>
				    			<div class="wpfc-premium-step-footer">
				    				<h1 id="new-features-h1">New Features</h1>
				    				<ul>
				    					<li><a target="_blank" style="text-decoration: none;color: #444;" href="http://www.wpfastestcache.com/premium/image-optimization/">Image Optimization</a></li>
				    					<li><a target="_blank" style="text-decoration: none;color: #444;" href="http://www.wpfastestcache.com/premium/mobile-cache/">Mobile Cache</a></li>
				    					<li><a target="_blank" style="text-decoration: none;color: #444;" href="http://www.wpfastestcache.com/premium/minify-html-plus/">Minify HTML Plus</a></li>
				    					<li><a target="_blank" style="text-decoration: none;color: #444;" href="http://www.wpfastestcache.com/premium/combine-js-plus/">Combine Js Plus</a></li>
				    					<li><a target="_blank" style="text-decoration: none;color: #444;" href="http://www.wpfastestcache.com/premium/remove-comments/">Remove Comments</a></li>
				    					<li><a target="_blank" style="text-decoration: none;color: #444;" href="http://www.wpfastestcache.com/premium/delete-cache-logs/">Delete Cache Logs</a></li>
				    					<li><a target="_blank" style="text-decoration: none;color: #444;" href="http://www.wpfastestcache.com/premium/cache-statics/">Cache Statics</a></li>
				    				</ul>
				    			</div>
				    		</div>
				    		<div class="wpfc-premium-step">
				    			<div class="wpfc-premium-step-header">
				    				<label>Checkout</label>
				    			</div>
				    			<div class="wpfc-premium-step-content">
				    				You need to pay before downloading the premium version.
				    			</div>
				    			<div class="wpfc-premium-step-image">
				    				<img width="140px" height="140px" src="<?php echo plugins_url("wp-fastest-cache/images/wallet.png"); ?>" />
				    			</div>
				    			<div class="wpfc-premium-step-footer">
				    				<h1 style="float:left;" id="just-h1">Just</h1><h1>&nbsp;$<span id="wpfc-premium-price"></span></h1>
				    				<p>The download button will be available after paid. You can buy the premium version now.</p>
				    				<form action="http://api.wpfastestcache.net/paypal/buypremium/" method="post">
				    					<input type="hidden" name="hostname" value="<?php echo str_replace(array("http://", "www."), "", $_SERVER["HTTP_HOST"]); ?>">
					    				<button id="wpfc-buy-premium-button" type="submit" class="btn primaryCta" style="width:200px;">
					    					<span>Buy</span>
					    				</button>
				    				</form>
				    			</div>
				    		</div>
				    		<div class="wpfc-premium-step">
				    			<div class="wpfc-premium-step-header">
				    				<label>Download & Update</label>
				    			</div>
				    			<div class="wpfc-premium-step-content">
				    				You can download and update the premium when you want if you paid.
				    			</div>
				    			<div class="wpfc-premium-step-image" style="">
				    				<img src="<?php echo plugins_url("wp-fastest-cache/images/download-128x128.png"); ?>" />
				    			</div>
				    			<div class="wpfc-premium-step-footer">
				    				<h1 id="get-now-h1">Get It Now!</h1>
				    				<p>Please don't delete the free version. Premium version works with the free version.</p>



				    				<button id="wpfc-download-premium-button" class="btn primaryDisableCta" style="width:200px;">
				    					<?php $wpfc_premium_version = ""; ?>
				    					<?php if(file_exists(WPFC_WP_CONTENT_DIR."/plugins/wp-fastest-cache-premium/wpFastestCachePremium.php")){ ?>
				    						<?php
				    							if($data = @file_get_contents(WPFC_WP_CONTENT_DIR."/plugins/wp-fastest-cache-premium/wpFastestCachePremium.php")){
				    								preg_match("/Version:\s*(.+)/", $data, $out);
				    								if(isset($out[1]) && $out[1]){
				    									$wpfc_premium_version = trim($out[1]);
				    								}
				    							}
				    						?>
				    						<span>Update</span>
				    					<?php }else{ ?>
				    						<span data-type="download">Download</span>
				    					<?php } ?>
				    				</button>
				    				<!--
				    				<button class="btn primaryNegativeCta" style="width:200px;">
				    					<span>Update</span>
				    					<label>(v 1.0)</label>
				    				</button>
				    			-->
				    			</div>
				    		</div>
				    	</div>
				    	<script type="text/javascript">
					    	function GetUserInfo(data) {
					    		window.wpfc_country = data.country;
							}
				    	</script>
				    	<script type="text/javascript" src="//ipinfo.io/json?callback=GetUserInfo"></script>
				    	<script type="text/javascript">
				    		if(jQuery(".tab5").is(":visible")){
				    			jQuery(document).ready(function(){
					    			wpfc_premium_page();
				    			});
				    		}

				    		jQuery("#wpfc-premium").change(function(e){
				    			wpfc_premium_page();
				    		});

							function wpfc_premium_page(){
								jQuery("#revert-loader-toolbar").show();
				    			jQuery.ajax({
									type: 'GET', 
									url: "https://api.wpfastestcache.net/prices/premium/",
									cache: false,
									error: function(x, t, m) {
										alert(t);
									},
									success: function(price){
										jQuery("#wpfc-premium-price").text(price);
						    			jQuery.ajax({
											type: 'GET', 
											url: "https://api.wpfastestcache.net/user/<?php echo str_replace("www.", "", $_SERVER["HTTP_HOST"]); ?>/type/<?php echo get_option("WpFc_api_key"); ?>",
											cache: false,
											error: function(x, t, m) {
												alert(t);
											},
											success: function(credit){
												if(credit == "premium"){
													jQuery("#wpfc-download-premium-button").click(function(){
														jQuery("#revert-loader-toolbar").show();
														jQuery.ajax({
															type: 'GET',
															url: "<?php echo admin_url(); ?>admin-ajax.php",
															data : {"action": "wpfc_download_premium"},
															dataType : "json",
															cache: false, 
															success: function(data){
																if(data.success){
																	 location.reload();
																}else{
																	alert(data.error_message);
																}
																console.log(data, "data");
															}
														});
													});

													var version_in_site = "<?php echo $wpfc_premium_version; ?>";
													var download_button_span = jQuery("#wpfc-download-premium-button span");

													jQuery("#wpfc-buy-premium-button").attr("class", "btn primaryDisableCta");
													jQuery("#wpfc-buy-premium-button").attr("disabled", true);
													jQuery("#wpfc-buy-premium-button").text(window.wpfc.translate("Purchased"));

													if(typeof download_button_span.attr("data-type") != "undefined" && download_button_span.attr("data-type") == "download"){
														jQuery("#wpfc-download-premium-button").attr("class", "btn primaryCta");
														jQuery("#revert-loader-toolbar").hide();
													}else{
										    			jQuery.ajax({
															type: 'GET', 
															url: "https://api.wpfastestcache.net/premium/version/",
															cache: false,
															error: function(x, t, m) {
																alert(t);
															},
															success: function(version){
																jQuery("#revert-loader-toolbar").hide();
																if(version_in_site == version){
																	download_button_span.text(window.wpfc.translate("No Update"));
																	jQuery("#wpfc-download-premium-button").attr("disabled", true);
																}else{
																	download_button_span.text("Update - " + version);
																	jQuery("#wpfc-download-premium-button").attr("class", "btn primaryCta");
																}
																console.log(version, "version", version_in_site, download_button_span);
															}
														});
													}
												}else{
													jQuery("#revert-loader-toolbar").hide();
												}
											}
										});
										jQuery.ajax({
											type: 'GET', 
											url: "https://api.wpfastestcache.net/user/<?php echo str_replace("www.", "", $_SERVER["HTTP_HOST"]); ?>/update_country/<?php echo get_option("WpFc_api_key"); ?>" + "/" + window.wpfc_country,
											cache: false,
											success: function(){}
										});
									}
								});
							}
				    	</script>
				    </div>
				    <div class="tab6" style="padding-left:20px;">
				    	<h2 style="padding-bottom:10px;">Exclude Pages</h2>
				    	<div class="questionCon">
				    			<label style="padding-bottom:10px;">You can stop to create cache for specific pages</label><label style="padding-bottom:10px;padding-left:5px;">[<a target="_blank" href="http://www.wpfastestcache.com/features/exclude-page/">Read More</a>]</label>
				    	</div>
				    	<form method="post" name="wp_manager">
				    		<input type="hidden" value="exclude" name="wpFastestCachePage">
				    		<div class="wpfc-exclude-rule-container">
					    		<div class="wpfc-exclude-rule-line">
					    			<div class="wpfc-exclude-rule-line-left">
							    		<select name="wpfc-exclude-rule-prefix-1">
							    				<option selected="" value=""></option>
							    				<option value="startwith">Start With</option>
							    				<option value="contain">Contain</option>
							    				<option value="exact">Exact</option>
							    		</select>
					    			</div>
					    			<div class="wpfc-exclude-rule-line-middle">
						    			<input type="text" name="wpfc-exclude-rule-content-1" style="width:390px;">
					    			</div>
					    			<div class="wpfc-exclude-rule-line-add">
					    				<img src="<?php echo plugins_url("wp-fastest-cache/images/add.png"); ?>">
					    			</div>
					    			<div class="wpfc-exclude-rule-line-delete">
					    				<img src="<?php echo plugins_url("wp-fastest-cache/images/delete.png"); ?>">
					    			</div>
					    		</div>
				    		</div>
				    		<div class="questionCon qsubmit">
								<div class="submit"><input type="submit" class="button-primary" value="Submit"></div>
							</div>
				    	</form>
				    	<script type="text/javascript">
				    		var WpFcExcludePages = {
				    			rules: [],
				    			init: function(rules){
				    				this.rules = rules;
				    				this.update_rules();
				    				this.click_event_for_add_button();
				    			},
				    			update_rules: function(){
				    				var self = this;

				    				if(typeof this.rules != "undefined" && this.rules.length > 0){
				    					jQuery.each(self.rules, function(i, e){
				    						if(i > 0){
				    							self.add_line(i + 1);
				    						}

			    							jQuery("input[name='wpfc-exclude-rule-content-" + (i+1) + "']").val(e.content);
			    							jQuery("select[name='wpfc-exclude-rule-prefix-" + (i+1) + "']").val(e.prefix);
				    					});
				    				}
				    			},
				    			add_line: function(number){
				    				var line = jQuery(".wpfc-exclude-rule-line").first().closest(".wpfc-exclude-rule-line").clone();
			    					line.find(".wpfc-exclude-rule-line-add").remove();
			    					line.find(".wpfc-exclude-rule-line-delete").show();

			    					line.find("select").attr("name", "wpfc-exclude-rule-prefix-" + number);
			    					line.find("input").attr("name", "wpfc-exclude-rule-content-" + number);
			    					line.find("input").val("");

			    					line.find(".wpfc-exclude-rule-line-delete").click(function(e){
			    						jQuery(e.target).closest(".wpfc-exclude-rule-line").remove();
			    					});

			    					jQuery(".wpfc-exclude-rule-container").append(line);
				    			},
				    			click_event_for_add_button: function(){
				    				var self = this;
				    				var line_length = 0;

				    				jQuery(".wpfc-exclude-rule-line-add").click(function(e){
				    					line_length = jQuery("div.wpfc-exclude-rule-line").length;
				    					self.add_line(line_length + 1);
				    				});
				    			}
				    		};
					    	<?php 
					    		if($rules_json = get_option("WpFastestCacheExclude")){
					    			?>WpFcExcludePages.init(<?php echo $rules_json; ?>);<?php
					    		}else{
					    			?>WpFcExcludePages.init();<?php
					    		}
					    	?>
				    	</script>
				    </div>
				</div>
				<div class="omni_admin_sidebar">

				<div class="omni_admin_sidebar_section" id="vote-us">
					<h3 style="color: antiquewhite;">Support Us</h3>
					<ul>
						<li><label>If you like it, Please vote and support us.</label></li>
					</ul>
					<script>
						jQuery("#vote-us").click(function(){
							var win=window.open("http://wordpress.org/support/view/plugin-reviews/wp-fastest-cache?free-counter?rate=5#postform", '_blank');
							win.focus();
						});
					</script>
				</div>
				<div class="omni_admin_sidebar_section">
				  <h3>Having Issues?</h3>
				  <ul>
				    <li><label>You can create a ticket</label> <a target="_blank" href="http://wordpress.org/support/plugin/wp-fastest-cache"><label>WordPress support forum</label></a></li>
				  <?php
				  	if(isset($this->options->wpFastestCacheLanguage) && $this->options->wpFastestCacheLanguage == "tr"){
				  		?>
				  		<li><label>R10 Üzerinden Sorabilirsiniz</label> <a target="_blank" href="http://www.r10.net/wordpress/1096868-wp-fastest-cache-wp-en-hizli-ve-en-basit-cache-sistemi.html"><label>R10.net destek başlığı</label></a></li>
				  		<?php
				  	}
				  ?>
				  </ul>
				  </div>
				</div>
			</div>
			<?php if(!class_exists("WpFastestCacheImageOptimisation")){ ?>
				<div id="wpfc-promotion" style="height:250px; bottom: -153px; position: fixed; z-index: 9999; right: 20px;cursor: pointer;">
					<img src="<?php echo plugins_url("wp-fastest-cache/images/promotions/promotion-1.jpg"); ?>">
				</div>

				<div id="wpfc-premium-tooltip" style="display:none;width: 160px; height: 60px; position: absolute; margin-left: 354px; margin-top: 112px; color: white;">
					<div style="float:left;width:13px;">
						<div style="width: 0px; height: 0px; border-top: 6px solid transparent; border-right: 6px solid #333333; border-bottom: 6px solid transparent; float: right; margin-right: 0px; margin-top: 25px;"></div>
					</div>
					<div style="font-family:sans-serif;font-size:13px;text-align: center; border-radius: 5px; float: left; background-color: rgb(51, 51, 51); color: white; width: 147px; padding: 10px 0px;">
						<label>Only available in Premium version</label>
					</div>
				</div>

				<script type="text/javascript">
					var promotion_id = "wpfc-promotion";
					var promotion_bottom = jQuery("#wpfc-promotion").css("bottom");

					jQuery("#" + promotion_id).mouseenter(function(){
						jQuery("#" + promotion_id).css({"bottom" : "5px", "z-index" : "9999"});
					});

					jQuery("#" + promotion_id).mouseleave(function(){
						jQuery("#" + promotion_id).css({"bottom" : promotion_bottom, "z-index" : "9999"});
					});

					jQuery("#" + promotion_id).click(function(){
						jQuery("#wpfc-premium").attr("checked", true);
						jQuery("#wpfc-premium").trigger("change");
					});

					jQuery("div.questionCon.disabled").click(function(e){
						if(typeof window.wpfc.tooltip != "undefined"){
							clearTimeout(window.wpfc.tooltip);
						}

						var inputCon = jQuery(e.currentTarget).find(".inputCon");
						var left = 30;

						jQuery(e.currentTarget).children().each(function(i, child){
							left = left + jQuery(child).width();
						});

						jQuery("#wpfc-premium-tooltip").css({"margin-left" : left + "px", "margin-top" : (jQuery(e.currentTarget).offset().top - jQuery(".tab1").offset().top + 25) + "px"});
						jQuery("#wpfc-premium-tooltip").fadeIn( "slow", function() {
							window.wpfc.tooltip = setTimeout(function(){ jQuery("#wpfc-premium-tooltip").hide(); }, 1000);
						});
						return false;
					});
				</script>
			<?php } ?>
			<script>Wpfclang.init("<?php echo $wpFastestCacheLanguage; ?>");</script>
			<?php
		}
	}
?>