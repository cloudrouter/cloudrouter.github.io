<?php
	class CssUtilities{
		private $html = "";
		private $cssLinks = array();
		private $cssLinksExcept = "";
		private $url = "";
		private $err = "";

		public function __construct($wpfc, $html){
			//$this->html = preg_replace("/\s+/", " ", ((string) $html));
			$this->html = $html;

			$ini = 0;

			if(function_exists("ini_set") && function_exists("ini_get")){
				$ini = ini_get("pcre.recursion_limit");
				ini_set("pcre.recursion_limit", "2777");
			}

			$this->setCssLinksExcept();

			$this->inlineToLink($wpfc);
			$this->setCssLinks();
			$this->setCssLinksExcept();

			if($ini){
				ini_set("pcre.recursion_limit", $ini);
			}
		}

		public function inlineToLink($wpfc){
			preg_match("/<head(.*?)<\/head>/si", $this->html, $head);
			preg_match_all("/<style([^><]*)>([^<]+)<\/style>/is",$head[1],$out);

			if(count($out) > 0){

				$countStyle = array_count_values($out[2]);

				$i = 0;

				$out[2] = array_unique($out[2]);

				foreach ($out[2] as $key => $value) {

					$value = trim($value);

					// to prevent inline to external if the style is used in the javascript
					if(in_array($value[0], array(";","'",'"'))){
						continue;
					}


					$cachFilePath = WPFC_WP_CONTENT_DIR."/cache/wpfc-minified/".md5($value);
					$cssLink = content_url()."/cache/wpfc-minified/".md5($value);

					preg_match("/media=[\"\']([^\"\']+)[\"\']/", $out[1][$i], $tmpMedia);
					$media = (isset($tmpMedia[1]) && $tmpMedia[1]) ? $tmpMedia[1] : "all";

					if(strpos($this->getCssLinksExcept(), $out[0][$i]) === false){
						if(!is_dir($cachFilePath)){
							$prefix = time();
							$wpfc->createFolder($cachFilePath, $value, "css", $prefix);
						}

						if($cssFiles = @scandir($cachFilePath, 1)){
							if($countStyle[$value] == 1){
								$link = "<!-- <style".$out[1][$i].">".$value."</style> -->"."\n<link rel='stylesheet' href='".$cssLink."/".$cssFiles[0]."' type='text/css' media='".$media."' />";
								if($tmpHtml = @preg_replace("/<style[^><]*>\s*".preg_quote($value, "/")."\s*<\/style>/", $link, $this->html)){
									if($this->_process($value)){
										$this->html = $tmpHtml;
									}
								}else{
									$this->err = "inline css is too large. it is a mistake for optimization. save it as a file and call in the html.".$value;
								}
							}else{
								$link = "<!-- <style".$out[1][$i].">".$value."</style> -->"."\n<link rel='stylesheet' href='".$cssLink."/".$cssFiles[0]."' type='text/css' media='".$media."' />";
								if($tmpHtml = @preg_replace("/<style[^><]*>\s*".preg_quote($value, "/")."\s*<\/style>/", $link, $this->html)){
									if($this->_process($value)){
										$this->html = $tmpHtml;
									}
								}else{
									$this->err = "inline css is too large. it is a mistake for optimization. save it as a file and call in the html.".$value;
								}
								$countStyle[$value] = $countStyle[$value] - 1;
							}
						}
					}

					$i++;

				}
			}
		}

		public function minify($url, $minify = true){
			$this->url = $url;

			$cachFilePath = WPFC_WP_CONTENT_DIR."/cache/wpfc-minified/".md5($url);
			$cssLink = content_url()."/cache/wpfc-minified/".md5($url);

			if(is_dir($cachFilePath)){
				return array("cachFilePath" => $cachFilePath, "cssContent" => "", "url" => $cssLink, "realUrl" => $url);
			}else{
				if($css = $this->file_get_contents_curl($url."?v=".time())){
					if($minify){
						$cssContent = $this->_process($css);
						$cssContent = $this->fixPathsInCssContent($cssContent);
					}else{
						$cssContent = $css;
						$cssContent = $this->fixPathsInCssContent($cssContent);
					}

					return array("cachFilePath" => $cachFilePath, "cssContent" => $cssContent, "url" => $cssLink, "realUrl" => $url);
					//return array("cachFilePath" => $cachFilePath, "cssContent" => "/* ".$url." */\n".$cssContent, "url" => $cssLink, "realUrl" => $url);
				}
			}
			return false;
		}

		public function file_get_contents_curl($url) {

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

		public function fixPathsInCssContent($css){
			$css = preg_replace("/@import\s+[\"\']([^\;\"\'\)]+)[\"\'];/", "@import url($1);", $css);
			return preg_replace_callback("/url\(([^\)]*)\)/", array($this, 'newImgPath'), $css);
			//return preg_replace_callback("/url\((?P<path>[^\)]*)\)/", array($this, 'newImgPath'), $css);
		}

		public function fixRules($css){
			$css = $this->fixImportRules($css);
			$css = $this->fixCharset($css);
			//$css = preg_replace("/@media/i","\n@media",$css);
			return $css;
		}

		public function fixImportRules($css){
			preg_match_all('/@import\s+url\([^\)]+\);/i', $css, $imports);

			if(count($imports[0]) > 0){
				$css = preg_replace('/@import\s+url\([^\)]+\);/i', "/* @import is moved to the top */", $css);
				for ($i = count($imports[0])-1; $i >= 0; $i--) {
					$css = $imports[0][$i]."\n".$css;
				}
			}
			return $css;
		}

		public function fixCharset($css){
			preg_match_all('/@charset[^\;]+\;/i', $css, $charsets);
			if(count($charsets[0]) > 0){
				$css = preg_replace('/@charset[^\;]+\;/i', "/* @charset is moved to the top */", $css);
				foreach($charsets[0] as $charset){
					$css = $charset."\n".$css;
				}
			}
			return $css;
		}

		public function newImgPath($matches){

			if(preg_match("/data\:image\/svg\+xml/", $matches[1])){
				$matches[1] = $matches[1];
			}else{
				$matches[1] = str_replace(array("\"","'"), "", $matches[1]);
				if(!$matches[1]){
					$matches[1] = "";
				}else if(preg_match("/^(\/\/|http|\/\/fonts|data:image|data:application)/", $matches[1])){
					$matches[1] = $matches[1];
				}else if(preg_match("/^\//", $matches[1])){
					$homeUrl = str_replace(array("http:", "https:"), "", home_url());
					$matches[1] = $homeUrl.$matches[1];
				}else if(preg_match("/^(?P<up>(\.\.\/)+)(?P<name>.+)/", $matches[1], $out)){
					$count = strlen($out["up"])/3;
					$url = dirname($this->url);
					for($i = 1; $i <= $count; $i++){
						$url = substr($url, 0, strrpos($url, "/"));
					}
					$url = str_replace(array("http:", "https:"), "", $url);
					$matches[1] = $url."/".$out["name"];
				}else{
					$url = str_replace(array("http:", "https:"), "", dirname($this->url));
					$matches[1] = $url."/".$matches[1];
				}
			}




			return "url(".$matches[1].")";
		}

		public function setCssLinks(){
			preg_match("/<head(.*?)<\/head>/si", $this->html, $head);
			preg_match_all("/<link[^<>]*rel=[\"\']stylesheet[\"\'][^<>]*>/", $head[1], $this->cssLinks);
			$this->cssLinks = array_unique($this->cssLinks[0]);
		}

		public function setCssLinksExcept(){
			preg_match("/<head(.*?)<\/head>/si", $this->html, $head);

			preg_match_all("/<\!--\s*\[\s*if[^>]+>(.*?)<\!\s*\[\s*endif\s*\]\s*-->/si", $head[1], $cssLinksInIf);

			preg_match_all("/<\!--(?!\[if)(.*?)(?!<\!\s*\[\s*endif\s*\]\s*)-->/si", $head[1], $cssLinksCommentOut);

			preg_match_all("/<script((?:(?!<\/script).)+)<\/style>((?:(?!<\/script).)+)<\/script>/si", $head[1], $cssLinksInScripts);
			
			$this->cssLinksExcept = implode(" ", array_merge($cssLinksInIf[0], $cssLinksCommentOut[0], $cssLinksInScripts[0]));
		}

		public function getCssLinks(){
			return $this->cssLinks;
		}

		public function getCssLinksExcept(){
			return $this->cssLinksExcept;
		}

		public function checkInternal($link){
			$httpHost = str_replace("www.", "", $_SERVER["HTTP_HOST"]); 
			if(preg_match("/href=[\"\'](.*?)[\"\']/", $link, $href)){

				if(preg_match("/^\/[^\/]/", $href[1])){
					return $href[1];
				}

				if(@strpos($href[1], $httpHost)){
					return $href[1];
				}
			}
			return false;
		}

		public function minifyCss($wpfc, $exceptMediaAll){
			if(count($this->getCssLinks()) > 0){
				foreach ($this->getCssLinks() as $key => $value) {
					if($href = $this->checkInternal($value)){

						if($exceptMediaAll && preg_match("/media=[\'\"]all[\'\"]/", $value)){
							continue;
						}

						$minifiedCss = $this->minify($href);

						if($minifiedCss){
							if(isset($wpfc->options->wpFastestCacheMinifyCssPowerFul)){
								$powerful_html = new WpFastestCachePowerfulHtml();
								$minifiedCss["cssContent"] = $powerful_html->minify_css($minifiedCss["cssContent"]);
							}

							if(!is_dir($minifiedCss["cachFilePath"])){
								$prefix = time();
								$wpfc->createFolder($minifiedCss["cachFilePath"], $minifiedCss["cssContent"], "css", $prefix);
							}

							if($cssFiles = @scandir($minifiedCss["cachFilePath"], 1)){
								$prefixLink = str_replace(array("http:", "https:"), "", $minifiedCss["url"]);
								
								//$this->html = str_replace($href, $prefixLink."/".$cssFiles[0], $this->html);

								$newLink = str_replace($href, $prefixLink."/".$cssFiles[0], $value);
								$this->html = $wpfc->replaceLink($value, $newLink, $this->html);
							}
						}
					}
				}
			}

			return $this->html;
		}

		public function combineCss($wpfc, $minify = false){
			if(count($this->getCssLinks()) > 0){
				$prev = array("content" => "", "value" => array(), "name" => "");
				foreach ($this->getCssLinks() as $key => $value) {
					if($href = $this->checkInternal($value)){
						if(strpos($this->getCssLinksExcept(), $href) === false && preg_match("/media=[\'\"]all[\'\"]/", $value)){

							$minifiedCss = $this->minify($href, $minify);

							if($minifiedCss){

								if($minify && isset($wpfc->options->wpFastestCacheMinifyCssPowerFul)){
									$powerful_html = new WpFastestCachePowerfulHtml();
									$minifiedCss["cssContent"] = $powerful_html->minify_css($minifiedCss["cssContent"]);
								}

								if(!is_dir($minifiedCss["cachFilePath"])){
									$prefix = time();
									$wpfc->createFolder($minifiedCss["cachFilePath"], $minifiedCss["cssContent"], "css", $prefix);
								}

								if($cssFiles = @scandir($minifiedCss["cachFilePath"], 1)){
									if($cssContent = $this->file_get_contents_curl($minifiedCss["url"]."/".$cssFiles[0]."?v=".time())){
										$prev["name"] .= $minifiedCss["realUrl"];
										$prev["content"] .= $cssContent."\n";
										array_push($prev["value"], $value);
									}
								}
							}
						}else{
							$prev["content"] = $this->fixRules($prev["content"]);
							$this->mergeCss($wpfc, $prev);
							$prev = array("content" => "", "value" => array());
						}
					}else{
						$prev["content"] = $this->fixRules($prev["content"]);
						$this->mergeCss($wpfc, $prev);
						$prev = array("content" => "", "value" => array());
					}
				}
				$prev["content"] = $this->fixRules($prev["content"]);
				$this->mergeCss($wpfc, $prev);
			}

			$this->html = preg_replace("/(<!-- )+/","<!-- ", $this->html);
			$this->html = preg_replace("/( -->)+/"," -->", $this->html);

			return $this->html;
		}

		public function mergeCss($wpfc, $prev){
			if(count($prev["value"]) > 0){
				foreach ($prev["value"] as $prevKey => $prevValue) {
					if($prevKey == count($prev["value"]) - 1){
						$name = md5($prev["name"]);
						$cachFilePath = WPFC_WP_CONTENT_DIR."/cache/wpfc-minified/".$name;

						if(!is_dir($cachFilePath)){
							$wpfc->createFolder($cachFilePath, $prev["content"], "css", time());
						}

						if($cssFiles = @scandir($cachFilePath, 1)){
							$prefixLink = str_replace(array("http:", "https:"), "", content_url());
							$newLink = "<link rel='stylesheet' href='".$prefixLink."/cache/wpfc-minified/".$name."/".$cssFiles[0]."' type='text/css' media='all' />";
							$this->html = $wpfc->replaceLink($prevValue, "<!-- ".$prevValue." -->"."\n".$newLink, $this->html);
						}
					}else{
						$name .= $prevValue;
						$this->html = $wpfc->replaceLink($prevValue, "<!-- ".$prevValue." -->", $this->html);
					}
				}
			}
		}

		public function getError(){
			return $this->err;
		}

	    protected $_inHack = false;
	 
	    protected function _process($css){
	        $css = preg_replace("/^\s+/m", "", ((string) $css));
	        $css = preg_replace_callback('@\\s*/\\*([\\s\\S]*?)\\*/\\s*@'
	            ,array($this, '_commentCB'), $css);

	        //to remove empty chars from url()
			$css = preg_replace("/url\((\s+)([^\)]+)(\s+)\)/", "url($2)", $css);

	        return trim($css);
	    }
	    
	    protected function _commentCB($m){
	        $hasSurroundingWs = (trim($m[0]) !== $m[1]);
	        $m = $m[1]; 
	        // $m is the comment content w/o the surrounding tokens, 
	        // but the return value will replace the entire comment.
	        if ($m === 'keep') {
	            return '/**/';
	        }
	        if ($m === '" "') {
	            // component of http://tantek.com/CSS/Examples/midpass.html
	            return '/*" "*/';
	        }
	        if (preg_match('@";\\}\\s*\\}/\\*\\s+@', $m)) {
	            // component of http://tantek.com/CSS/Examples/midpass.html
	            return '/*";}}/* */';
	        }
	        if ($this->_inHack) {
	            // inversion: feeding only to one browser
	            if (preg_match('@
	                    ^/               # comment started like /*/
	                    \\s*
	                    (\\S[\\s\\S]+?)  # has at least some non-ws content
	                    \\s*
	                    /\\*             # ends like /*/ or /**/
	                @x', $m, $n)) {
	                // end hack mode after this comment, but preserve the hack and comment content
	                $this->_inHack = false;
	                return "/*/{$n[1]}/**/";
	            }
	        }
	        if (substr($m, -1) === '\\') { // comment ends like \*/
	            // begin hack mode and preserve hack
	            $this->_inHack = true;
	            return '/*\\*/';
	        }
	        if ($m !== '' && $m[0] === '/') { // comment looks like /*/ foo */
	            // begin hack mode and preserve hack
	            $this->_inHack = true;
	            return '/*/*/';
	        }
	        if ($this->_inHack) {
	            // a regular comment ends hack mode but should be preserved
	            $this->_inHack = false;
	            return '/**/';
	        }
	        // Issue 107: if there's any surrounding whitespace, it may be important, so 
	        // replace the comment with a single space
	        return $hasSurroundingWs // remove all other comments
	            ? ' '
	            : '';
	    }
	}
?>