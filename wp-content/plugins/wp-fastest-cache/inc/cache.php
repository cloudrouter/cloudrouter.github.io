<?php
	class WpFastestCacheCreateCache extends WpFastestCache{
		public $options = array();
		private $startTime;
		private $blockCache = false;
		private $err = "";

		public function __construct(){
			$this->options = $this->getOptions();

			$this->checkActivePlugins();
		}

		public function checkActivePlugins(){
			//for WP-Polls
			if($this->isPluginActive('wp-polls/wp-polls.php')){
				require_once "wp-polls.php";
				$wp_polls = new WpPollsForWpFc();
				$wp_polls->execute();
			}
		}

		public function checkShortCode($content){
			if(preg_match("/\[wpfcNOT\]/", $content)){
				if(!is_home() || !is_archive()){
					$this->blockCache = true;
				}
				$content = str_replace("[wpfcNOT]", "", $content);
			}
			return $content;
		}

		public function createCache(){
			if(isset($this->options->wpFastestCacheStatus)){
				$this->startTime = microtime(true);
				ob_start(array($this, "callback"));
			}
		}

		public function ignored(){
			$list = array(
						"\/wp\-comments\-post\.php",
						"\/sitemap\.xml",
						"\/wp\-login\.php",
						"\/robots\.txt",
						"\/wp\-cron\.php",
						"\/wp\-content",
						"\/wp\-admin",
						"\/wp\-includes",
						"\/index\.php",
						"\/xmlrpc\.php",
						"\/wp\-api\/"
					);
			if($this->isPluginActive('woocommerce/woocommerce.php')){
				array_push($list, "\/cart", "\/checkout", "\/receipt", "\/confirmation", "\/product");
			}

			if(preg_match("/".implode("|", $list)."/i", $_SERVER["REQUEST_URI"])){
				return true;
			}

			return false;
		}

		public function exclude_page(){
			$preg_match_rule = "";
			$request_url = trim($_SERVER["REQUEST_URI"], "/");

			if($json_data = get_option("WpFastestCacheExclude")){
				$std = json_decode($json_data);

				foreach($std as $key => $value){
					if(isset($value->prefix) && $value->prefix){
						$value->content = trim($value->content, "/");

						if($value->prefix == "exact"){
							if(strtolower($value->content) == strtolower($request_url)){
								return true;	
							}
						}else{
							if($value->prefix == "startwith"){
								$preg_match_rule = "^".preg_quote($value->content, "/");
							}else if($value->prefix == "contain"){
								$preg_match_rule = preg_quote($value->content, "/");
							}

							if(preg_match("/".$preg_match_rule."/i", $request_url)){
								return true;
							}
						}
					}
				}

			}
			return false;
		}

		public function is_xml($buffer){
			if(preg_match("/\<\?xml/i", $buffer)){
				return true;
			}
			return false;
		}

		public function callback($buffer){
			$buffer = $this->checkShortCode($buffer);

			if(preg_match("/Mediapartners-Google/i", $_SERVER['HTTP_USER_AGENT'])){
				return $buffer;
			}else if($this->exclude_page()){
				return $buffer."<!-- Wp Fastest Cache: Exclude Page -->";
			}else if($this->is_xml($buffer)){
				return $buffer."<!-- Wp Fastest Cache: XML Content -->";
			}else if (is_user_logged_in() || $this->isCommenter()){
				return $buffer;
			} else if(preg_match("/json/i", $_SERVER["HTTP_ACCEPT"])){
				return $buffer;
			}else if($this->checkWoocommerceSession()){
				if($this->checkHtml($buffer)){
					return $buffer;
				}else{
					return $buffer."<!-- \$_COOKIE['wp_woocommerce_session'] has been set -->";
				}
			}else if(defined('DONOTCACHEPAGE') && $this->isPluginActive('wordfence/wordfence.php')){ // for Wordfence: not to cache 503 pages
				return $buffer."<!-- DONOTCACHEPAGE is defined as TRUE -->";
			}else if($this->isPasswordProtected($buffer)){
				return $buffer."<!-- Password protected content has been detected -->";
			}else if($this->isWpLogin($buffer)){
				return $buffer;
			}else if($this->hasContactForm7WithCaptcha($buffer)){
				return $buffer."<!-- This page was not cached because ContactForm7's captcha -->";
			}else if(is_404()){
				return $buffer;
			}else if($this->ignored()){
				return $buffer."<!-- ignored -->";
			}else if($this->blockCache === true){
				return $buffer."<!-- wpfcNOT has been detected -->";
			}else if(isset($_GET["preview"])){
				return $buffer."<!-- not cached -->";
			}else if(preg_match("/\?/", $_SERVER["REQUEST_URI"])){
				return $buffer;
			}else if($this->checkHtml($buffer)){
				return $buffer."<!-- html is corrupted -->";
			}else{				
				if($this->isMobile()){
					if(class_exists("WpFcMobileCache") && isset($this->options->wpFastestCacheMobileTheme)){
						$wpfc_mobile = new WpFcMobileCache();
						$cachFilePath = $this->getWpContentDir()."/cache/".$wpfc_mobile->get_folder_name()."".$_SERVER["REQUEST_URI"];
					}else{
						return $buffer."<!-- mobile user -->";
					}
				}else{
					$cachFilePath = $this->getWpContentDir()."/cache/all".$_SERVER["REQUEST_URI"];
				}

				//to show cache version of home page via php if htaccess rewrite rule does not work
				if($_SERVER["REQUEST_URI"] == "/"){
					if(file_exists($cachFilePath."index.html")){
						if($content = @file_get_contents($cachFilePath."index.html")){
							return $content."<!-- via php -->";
						}
					}
				}

				$content = $this->cacheDate($buffer);

				if(isset($this->options->wpFastestCacheCombineCss) && isset($this->options->wpFastestCacheMinifyCss)){
					require_once "css-utilities.php";
					$css = new CssUtilities($this, $content);
					$content = $css->combineCss($this, true);
					//to minify css files which are NOT "media='all'"
					$content = $css->minifyCss($this, true);
					$this->err = $css->getError();
				}else if(isset($this->options->wpFastestCacheCombineCss)){
					require_once "css-utilities.php";
					$css = new CssUtilities($this, $content);
					$content = $css->combineCss($this, false);
				}else if(isset($this->options->wpFastestCacheMinifyCss)){
					require_once "css-utilities.php";
					$css = new CssUtilities($this, $content);
					$content = $css->minifyCss($this, false);
					$this->err = $css->getError();
				}

				if(isset($this->options->wpFastestCacheCombineJs)){
					$content = $this->combineJs($content, false);
				}

				if(class_exists("WpFastestCachePowerfulHtml")){
					$powerful_html = new WpFastestCachePowerfulHtml();
					$powerful_html->set_html($content);
					
					if(isset($this->options->wpFastestCacheRemoveComments)){
						$content = $powerful_html->remove_head_comments();
					}

					if(isset($this->options->wpFastestCacheMinifyHtmlPowerFul)){
						$content = $powerful_html->minify_html();
					}
				}

				if($this->err){
					return $buffer."<!-- ".$this->err." -->";
				}else{
					$content = $this->minify($content);
					$this->createFolder($cachFilePath, $content);
					return $buffer."<!-- need to refresh to see cached version -->";
				}
			}
		}

		public function minify($content){
			return isset($this->options->wpFastestCacheMinifyHtml) ? preg_replace("/^\s+/m", "", ((string) $content)) : $content;
		}

		public function checkHtml($buffer){
			if(preg_match('/<html[^\>]*>/si', $buffer) && preg_match('/<body[^\>]*>/si', $buffer)){
				return false;
			}
			// if(strlen($buffer) > 10){
			// 	return false;
			// }

			return true;
		}

		public function cacheDate($buffer){
			if($this->isMobile() && class_exists("WpFcMobileCache")){
				return $buffer."<!-- Mobile: WP Fastest Cache file was created in ".$this->creationTime()." seconds, on ".date("d-m-y G:i:s")." ".$_SERVER['HTTP_USER_AGENT']."-->";
			}else{
				return $buffer."<!-- WP Fastest Cache file was created in ".$this->creationTime()." seconds, on ".date("d-m-y G:i:s")." ".$_SERVER['HTTP_USER_AGENT']."-->";
			}
		}

		public function creationTime(){
			return microtime(true) - $this->startTime;
		}

		public function isCommenter(){
			$commenter = wp_get_current_commenter();
			return isset($commenter["comment_author_email"]) && $commenter["comment_author_email"] ? true : false;
		}
		public function isPasswordProtected($buffer){

			if(preg_match("/action\=[\'\"].+postpass.*[\'\"]/", $buffer)){
				return true;
			}

			return false;


			// if(count($_COOKIE) > 0){
			// 	if(preg_match("/wp-postpass/", implode(" ",array_keys($_COOKIE)))){
			// 		return true;
			// 	}

			// }
			// return false;
		}

		public function createFolder($cachFilePath, $buffer, $extension = "html", $prefix = ""){
			$create = false;
			
			if($buffer && strlen($buffer) > 100 && $extension == "html"){
				$create = true;
			}

			if(($extension == "css" || $extension == "js") && $buffer && strlen($buffer) > 5){
				$create = true;
				$buffer = trim($buffer);
				if($extension == "js"){
					if(substr($buffer, -1) != ";"){
						$buffer .= ";";
					}
				}
			}

			$cachFilePath = urldecode($cachFilePath);

			if($create){
				if (!is_user_logged_in() && !$this->isCommenter()){
					if(!is_dir($cachFilePath)){
						if(is_writable($this->getWpContentDir()) || ((is_dir($this->getWpContentDir()."/cache")) && (is_writable($this->getWpContentDir()."/cache")))){
							if (@mkdir($cachFilePath, 0755, true)){

								file_put_contents($cachFilePath."/".$prefix."index.".$extension, $buffer);
								
								if(class_exists("WpFastestCacheStatics")){

									if(preg_match("/wpfc\-mobile\-cache/", $cachFilePath)){
										$extension = "mobile";
									}
									
					   				$cache_statics = new WpFastestCacheStatics($extension, strlen($buffer));
					   				$cache_statics->update_db();
				   				}

							}else{
							}
						}else{

						}
					}else{
						if(file_exists($cachFilePath."/".$prefix."index.".$extension)){

						}else{

							file_put_contents($cachFilePath."/".$prefix."index.".$extension, $buffer);
							
							if(class_exists("WpFastestCacheStatics")){
								
								if(preg_match("/wpfc\-mobile\-cache/", $cachFilePath)){
									$extension = "mobile";
								}

				   				$cache_statics = new WpFastestCacheStatics($extension, strlen($buffer));
				   				$cache_statics->update_db();
			   				}
						}
					}
				}
			}elseif($extension == "html"){
				$this->err = "Buffer is empty so the cache cannot be created";
			}
		}

		public function replaceLink($search, $replace, $content){
			$href = "";

			if(stripos($search, "<link") === false){
				$href = $search;
			}else{
				preg_match("/.+href=[\"\'](.+)[\"\'].+/", $search, $out);
			}

			if(count($out) > 0){
				$content = preg_replace("/<link[^>]+".preg_quote($out[1], "/")."[^>]+>/", $replace, $content);
			}

			return $content;
		}

		public function combineJs($content, $minify = false){
			$minify = true;
			if(isset($this->options->wpFastestCacheCombineJs)){
				require_once "js-utilities.php";
				$js = new JsUtilities($this, $content);

				if(count($js->getJsLinks()) > 0){
					$prev = array("content" => "", "value" => array());
					foreach ($js->getJsLinks() as $key => $value) {
						if($href = $js->checkInternal($value)){
							if(strpos($js->getJsLinksExcept(), $href) === false){
								if(!preg_match("/<script[^>]+json[^>]+>.+/", $value)){
									$minifiedJs = $js->minify($href, $minify);

									if($minifiedJs){
										if(!is_dir($minifiedJs["cachFilePath"])){

											if(isset($this->options->wpFastestCacheCombineJsPowerFul)){
												$powerful_html = new WpFastestCachePowerfulHtml();
												$minifiedJs["jsContent"] = $powerful_html->minify_js($minifiedJs["jsContent"]);
											}


											$prefix = time();
											$this->createFolder($minifiedJs["cachFilePath"], $minifiedJs["jsContent"], "js", $prefix);
										}

										if($jsFiles = @scandir($minifiedJs["cachFilePath"], 1)){
											if($jsContent = $js->file_get_contents_curl($minifiedJs["url"]."/".$jsFiles[0]."?v=".time())){
												$prev["content"] = $prev["content"]."\n".$jsContent;
												array_push($prev["value"], $value);
											}
										}
									}
								}else{
									$content = $js->mergeJs($prev, $this);
									$prev = array("content" => "", "value" => array());
								}
							}else{
								$content = $js->mergeJs($prev, $this);
								$prev = array("content" => "", "value" => array());
							}
						}else{
							$content = $js->mergeJs($prev, $this);
							$prev = array("content" => "", "value" => array());
						}
					}
					$content = $js->mergeJs($prev, $this);
				}
			}

			$content = preg_replace("/(<!-- )+/","<!-- ", $content);
			$content = preg_replace("/( -->)+/"," -->", $content);

			return $content;
		}

		public function isMobile(){
			if(preg_match("/.*".$this->getMobileUserAgents().".*/i", $_SERVER['HTTP_USER_AGENT'])){
				return true;
			}else{
				return false;
			}
		}
		public function isPluginActive( $plugin ) {
			return in_array( $plugin, (array) get_option( 'active_plugins', array() ) ) || $this->isPluginActiveForNetwork( $plugin );
		}
		public function isPluginActiveForNetwork( $plugin ) {
			if ( !is_multisite() )
				return false;

			$plugins = get_site_option( 'active_sitewide_plugins');
			if ( isset($plugins[$plugin]) )
				return true;

			return false;
		}

		public function checkWoocommerceSession(){
			foreach($_COOKIE as $key => $value){
			  if(preg_match("/^wp\_woocommerce\_session/", $key)){
			  	return true;
			  }
			}

			return false;
		}

		public function isWpLogin($buffer){
			if(preg_match("/<form[^\>]+loginform[^\>]+>((?:(?!<\/form).)+)user_login((?:(?!<\/form).)+)user_pass((?:(?!<\/form).)+)<\/form>/si", $buffer)){
				return true;
			}

			return false;
		}

		public function hasContactForm7WithCaptcha($buffer){
			if(is_single() || is_page()){
				if(preg_match("/<input[^\>]+_wpcf7_captcha[^\>]+>/i", $buffer)){
					return true;
				}
			}
			
			return false;
		}
	}
?>