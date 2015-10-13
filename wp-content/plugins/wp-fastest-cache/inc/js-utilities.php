<?php
	class JsUtilities{
		private $html = "";
		private $jsLinks = array();
		private $jsLinksExcept = "";
		private $url = "";

		public function __construct($wpfc, $html){
			//$this->html = preg_replace("/\s+/", " ", ((string) $html));
			$this->html = $html;

			$this->setJsLinksExcept();

			$this->inlineToScript($wpfc);
			$this->setJsLinks();
			$this->setJsLinksExcept();
		}

		public function inlineToScript($wpfc){
			preg_match("/<head(.*?)<\/head>/si", $this->html, $head);
			preg_match_all("/<script([^\>]*)>((?:(?!<\/script).)+)<\/script\s*>/is",$head[1],$out);

			if(count($out) > 0){
				$countStyle = array_count_values($out[2]);

				$i = 0;

				$out[2] = array_unique($out[2]);

				foreach ($out[2] as $key => $value) {
					$cachFilePath = WPFC_WP_CONTENT_DIR."/cache/wpfc-minified/".md5($value);
					$jsScript = content_url()."/cache/wpfc-minified/".md5($value);

					if(strpos($this->getJsLinksExcept(), $out[0][$i]) === false){
						if(!is_dir($cachFilePath)){
							$prefix = time();
							$wpfc->createFolder($cachFilePath, $value, "js", $prefix);
						}

						if($jsFiles = @scandir($cachFilePath, 1)){
							if($countStyle[$value] == 1){
								$script = "<!-- <script".$out[1][$i].">".str_replace(array("<!--", "-->"), "", $value)."</script> -->"."\n"."<script".$out[1][$i]." src='".$jsScript."/".$jsFiles[0]."'></script>";
								if($tmpHtml = @preg_replace("/<script[^<>]*>".preg_quote($value, "/")."<\/script\s*>/", $script, $this->html)){
									$this->html = $tmpHtml;
								}else{
									$this->err = "inline js is too large. it is a mistake for optimization. save it as a file and call in the html.".$value;
								}
							}else{
								$script = "<!-- <script".$out[1][$i].">".str_replace(array("<!--", "-->"), "", $value)."</script> -->"."\n"."<script".$out[1][$i]." src='".$jsScript."/".$jsFiles[0]."'></script>";
								if($tmpHtml = @preg_replace("/<script[^<>]*>".preg_quote($value, "/")."<\/script\s*>/", $script, $this->html)){
									$this->html = $tmpHtml;
								}else{
									$this->err = "inline js is too large. it is a mistake for optimization. save it as a file and call in the html.".$value;
								}
								$countStyle[$value] = $countStyle[$value] - 1;
							}
						}
					}

					$i++;
				}
			}
		}

		public function setJsLinks(){
			preg_match("/<head(.*?)<\/head>/si", $this->html, $head);

			preg_match_all("/<script[^<>]+src=[\"\']([^\"\']+)[\"\'][^<>]*><\/script>/", $head[1], $this->jsLinks);

			$this->jsLinks = $this->jsLinks[0];
		}

		public function setJsLinksExcept(){
			preg_match("/<head(.*?)<\/head>/si", $this->html, $head);

			preg_match_all("/<\!--\s*\[\s*if[^>]+>(.*?)<\!\s*\[\s*endif\s*\]\s*-->/si", $head[1], $jsLinksInIf);

			preg_match_all("/<\!--(?!\[if)(.*?)(?!<\!\s*\[\s*endif\s*\]\s*)-->/si", $head[1], $jsLinksCommentOut);

			preg_match_all("/<script[^\>]*>((?:(?!<\/script).)+)GoogleAnalyticsObject((?:(?!<\/script).)+)<\/script>/si", $head[1], $jsLinksGoogleAnalytics);

			preg_match_all("/<script[^\>]*>((?:(?!<\/script).)+)google\-analytics\.com((?:(?!<\/script).)+)<\/script>/si", $head[1], $jsLinksGoogleAnalyticsYoast);
			
			preg_match_all("/<script[^\>]*>((?:(?!<\/script).)+)WebFontConfig((?:(?!<\/script).)+)<\/script>/si", $head[1], $jsLinksGoogleFonts);


			$this->jsLinksExcept = implode(" ", array_merge($jsLinksInIf[0], $jsLinksCommentOut[0], $jsLinksGoogleAnalytics[0], $jsLinksGoogleAnalyticsYoast[0], $jsLinksGoogleFonts[0]));
		}

		public function getJsLinksExcept(){
			return $this->jsLinksExcept;
		}

		public function getJsLinks(){
			return array_unique($this->jsLinks);
		}

		public function minify($url, $minify = true){
			$this->url = $url;

			$cachFilePath = WPFC_WP_CONTENT_DIR."/cache/wpfc-minified/".md5($url);
			$jsLink = content_url()."/cache/wpfc-minified/".md5($url);

			if(is_dir($cachFilePath)){
				return array("cachFilePath" => $cachFilePath, "jsContent" => "", "url" => $jsLink);
			}else{
				if($js = $this->file_get_contents_curl($url)){
					if($minify){
						$js = preg_replace("/^\s+/m", "", ((string) $js));
					}

					$js = "\n// source --> ".$url." \n".$js;

					return array("cachFilePath" => $cachFilePath, "jsContent" => $js, "url" => $jsLink);
				}
			}
			return false;
		}

		public function checkInternal($link){
			$httpHost = str_replace("www.", "", $_SERVER["HTTP_HOST"]); 
			if(preg_match("/src=[\"\'](.*?)[\"\']/", $link, $src)){

				if(preg_match("/^\/[^\/]/", $src[1])){
					return $src[1];
				}

				if(@strpos($src[1], $httpHost)){
					return $src[1];
				}
			}
			return false;
		}

		public function replaceLink($search, $replace, $content){
			$href = "";

			if(stripos($search, "<script") === false){
				$href = $search;
			}else{
				preg_match("/.+src=[\"\'](.+)[\"\'].+/", $search, $out);
			}

			if(count($out) > 0){
				$content = preg_replace("/<script[^>]+".preg_quote($out[1], "/")."[^>]+><\/script>/", $replace, $content);
			}

			return $content;
		}


		public function mergeJs($prev, $wpfc){
			if(count($prev["value"]) > 0){
				$name = "";
				foreach ($prev["value"] as $prevKey => $prevValue) {
					if($prevKey == count($prev["value"]) - 1){
						$name = md5($name);
						$cachFilePath = WPFC_WP_CONTENT_DIR."/cache/wpfc-minified/".$name;

						if(!is_dir($cachFilePath)){
							$wpfc->createFolder($cachFilePath, $prev["content"], "js", time());
						}

						if($jsFiles = @scandir($cachFilePath, 1)){
							$prefixLink = str_replace(array("http:", "https:"), "", content_url());
							$newLink = "<script src='".$prefixLink."/cache/wpfc-minified/".$name."/".$jsFiles[0]."' type=\"text/javascript\"></script>";
							$this->html = $this->replaceLink($prevValue, "<!-- ".$prevValue." -->"."\n".$newLink, $this->html);
						}
					}else{
						$name .= $prevValue;
						$this->html = $this->replaceLink($prevValue, "<!-- ".$prevValue." -->", $this->html);
					}
				}
			}
			return $this->html;
		}

		public function file_get_contents_curl($url) {

			if(!preg_match("/\.php$/", $url)){
				$url = $url."?v=".time();
			}

			if(preg_match("/^\/[^\/]/", $url)){
				$url = home_url().$url;
			}

			$url = preg_replace("/^\/\//", "http://", $url);
			
			// $ch = curl_init();
		 
			// curl_setopt($ch, CURLOPT_HEADER, 0);
			// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
			// curl_setopt($ch, CURLOPT_URL, $url);
		 
			// $data = curl_exec($ch);
			// curl_close($ch);
		 
			// if(preg_match("/<\/\s*html\s*>\s*$/i", $data)){
			// 	return false;
			// }else{
			// 	return $data;	
			// }

			$response = wp_remote_get($url, array('timeout' => 10 ) );

			if ( !$response || is_wp_error( $response ) ) {
				return false;
			}else{
				if(wp_remote_retrieve_response_code($response) == 200){
					$data = wp_remote_retrieve_body( $response );

					if(preg_match("/<\/\s*html\s*>\s*$/i", $data)){
						return false;
					}else{
						return $data;	
					}
				}
			}
		}
	}
?>