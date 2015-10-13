<?php 
/************************************
*Title ELEMENT
*************************************/
function shortcode_section_title( $atts,  $content = null ) {
    extract( shortcode_atts( array(
      'title' => '',
      'subtitle' => '',
      'align' => 'center',
      
   ), $atts ) );
   ob_start(); ?>
   <div class="title-section" style="text-align: <?php echo esc_attr($align); ?>">
		<div class="container triggerAnimation animated" data-animate="bounceIn">
			<h1><?php echo esc_html($title); ?></h1>
			<?php if($subtitle!=''){ ?>
			<p><?php echo do_shortcode($subtitle); ?></p>
			<?php } ?>			
		</div>
	</div>
   
<?php
    return ob_get_clean();

}
add_shortcode( 'qk_section_title', 'shortcode_section_title' );

if(function_exists('vc_map')){

vc_map( array(
   "name" => __("QK Section Title","element"),
   "base" => "qk_section_title",
   "class" => "",
   "category" => __("Content", "element"),
   "icon" => "icon-qk",
   "params" => array(
	 
      
	   array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title","element"),
         "param_name" => "title",
         "value" => "",
         "description" => ''
      ),array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "",
         "heading" => __("Intro Title","element"),
         "param_name" => "subtitle",
         "value" =>'',
         "description" => ''
      ),array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Text Align","element"),
         "param_name" => "align",
         "value" =>'center',
         "description" => ''
      ),
	
   )
) );

}

/************************************
*Service Block ELEMENT
*************************************/
function shortcode_service_block( $atts,  $content = null ) {
    extract( shortcode_atts( array(
      
	  'title' => '',
	  'animation' => '',
	  'icon' => '',
	  
      
   ), $atts ) );
   static $count = 1;
   ob_start(); ?>
	<div class="services-post services-post1 triggerAnimation animated" data-animate="<?php echo esc_attr($animation); ?>fadeInLeft">
		<span><i class="fa <?php echo esc_attr($icon); ?>"></i></span>
		<div class="services-content">
			<h2><?php echo esc_html($title); ?></h2>
			<p><?php echo do_shortcode($content); ?></p>
		</div>
	</div>
	
<?php
	$count++; 
    return ob_get_clean();

}
add_shortcode( 'qk_service_block', 'shortcode_service_block' );

if(function_exists('vc_map')){

vc_map( array(
   "name" => __("QK Service Block","element"),
   "base" => "qk_service_block",
   "class" => "",
   "icon" => "icon-qk",
   "category" => __("Content", "element"),
   "params" => array(
	 array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title","element"),
         "param_name" => "title",
         "value" => "Font Awesome Integrated",
         "description" => ''
      ), array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "",
         "heading" => __("Content","element"),
         "param_name" => "content",
         "value" => "Aenean sed justo tincidunt, vulputate nisi si amet, rutrum ligula. Pellentesque dictum uam ornare. Sed elit le rut.",
         "description" => ''
      ),
      
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Icon","element"),
         "param_name" => "icon",
         "value" => "fa-css3",
         "description" => ''
      ),
	   array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Animation","element"),
         "param_name" => "animation",
         "value" => "fadeInLeft",
         "description" => '"fadeInLeft", "fadeInRight" or "fadeInUp"'
      )
   )
) );

}


/************************************
*Service Block ELEMENT
*************************************/
function shortcode_service_block2( $atts,  $content = null ) {
    extract( shortcode_atts( array(
      
	  'title' => '',
	  'animation' => '',
	  'icon' => '',
	  
      
   ), $atts ) );
   static $count = 1;
   ob_start(); ?>
   <div class="services-post services-post2 triggerAnimation animated" data-animate="<?php echo esc_attr($animation); ?>">
		<span><i class="fa <?php echo esc_attr($icon); ?>"></i></span>
		<div class="services-content">
			<h2><?php echo esc_html($title); ?></h2>
			<p><?php echo do_shortcode($content); ?></p>
			
		</div>
	</div>
	
<?php
	$count++; 
    return ob_get_clean();

}
add_shortcode( 'qk_service_block2', 'shortcode_service_block2' );

if(function_exists('vc_map')){

vc_map( array(
   "name" => __("QK Service Block 2","element"),
   "base" => "qk_service_block2",
   "class" => "",
   "icon" => "icon-qk",
   "category" => __("Content", "element"),
   "params" => array(
	 array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title","element"),
         "param_name" => "title",
         "value" => "Font Awesome Integrated",
         "description" => ''
      ), array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "",
         "heading" => __("Content","element"),
         "param_name" => "content",
         "value" => "Aenean sed justo tincidunt, vulputate nisi sit amet, rutrum ligula. Pellentesque dictum.",
         "description" => ''
      ),
      
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Icon","element"),
         "param_name" => "icon",
         "value" => "fa-css3",
         "description" => ''
      ),
	   array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Animation","element"),
         "param_name" => "animation",
         "value" => "fadeInLeft",
         "description" => '"fadeInLeft", "fadeInRight" or "fadeInUp"'
      )
   )
) );

}

/************************************
*Service Block ELEMENT
*************************************/
function shortcode_service_block3( $atts,  $content = null ) {
    extract( shortcode_atts( array(
      
	  'title' => '',
	  'animation' => '',
	  'icon' => '',
	  'btn_link' => '',
	  'btn_text' => '',
	  
      
   ), $atts ) );
   static $count = 1;
   ob_start(); ?>
   <div class="services-post services-post2 services-post3 triggerAnimation animated" data-animate="<?php echo esc_attr($animation); ?>">
		<span><i class="fa <?php echo esc_attr($icon); ?>"></i></span>
		<div class="services-content">
			<h2><?php echo esc_html($title); ?></h2>
			<p><?php echo do_shortcode($content); ?></p>
			<?php if($btn_text!=''){ ?>
			<a href="<?php echo esc_url($btn_link); ?>"><?php echo esc_html($btn_text); ?> <i class="fa fa-angle-right"></i></a>
			<?php } ?>
		</div>
	</div>
	
<?php
	$count++; 
    return ob_get_clean();

}
add_shortcode( 'qk_service_block3', 'shortcode_service_block3' );

if(function_exists('vc_map')){

vc_map( array(
   "name" => __("QK Service Block 3","element"),
   "base" => "qk_service_block3",
   "class" => "",
   "icon" => "icon-qk",
   "category" => __("Content", "element"),
   "params" => array(
	 array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title","element"),
         "param_name" => "title",
         "value" => "Font Awesome Integrated",
         "description" => ''
      ), array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "",
         "heading" => __("Content","element"),
         "param_name" => "content",
         "value" => "Aenean sed justo tincidunt, vulputate nisi sit amet, rutrum ligula. Pellentesque dictum.",
         "description" => ''
      ),
      
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Icon","element"),
         "param_name" => "icon",
         "value" => "fa-css3",
         "description" => ''
      ), array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Read More Link","element"),
         "param_name" => "btn_link",
         "value" => "",
         "description" => ''
      ), array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Read More Text","element"),
         "param_name" => "btn_text",
         "value" => "",
         "description" => ''
      ),
	   array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Animation","element"),
         "param_name" => "animation",
         "value" => "fadeInLeft",
         "description" => '"fadeInLeft", "fadeInRight" or "fadeInUp"'
      )
   )
) );

}
/************************************
*Portfolio Slider ELEMENT
*************************************/
add_shortcode('qk_portfolio_slider','shortcode_portfolio_slider');
function shortcode_portfolio_slider($atts, $content=null){
	$atts = shortcode_atts(
		array(
		'order' => '',
		'cat' => '',
	), $atts);
	if($atts['cat']!='' and $atts['cat']!='all'){
		$args = array('post_type' => 'portfolio', 'posts_per_page' => $atts['order'], 'tax_query' => array(
		array(
			'taxonomy' => 'portfolio_category',
			'field'    => 'slug',
			'terms'    => $atts['cat'],
		),
	));
	}else{
		$args = array('post_type' => 'portfolio', 'posts_per_page' => $atts['order']);
	}	
	$portfolio = new WP_Query($args);
 ob_start(); ?>
 
 <div class="portfolio-box triggerAnimation animated" data-animate="fadeIn">
	<div class="container">
		<div id="owl-demo" class="owl-carousel">

			<?php while($portfolio->have_posts()) : $portfolio->the_post(); ?>
				<?php
					$img = element_thumbnail_url('');
				?>
				<div class="item work-post">
					<img alt="<?php the_title(); ?>" src="<?php echo esc_attr(bfi_thumb($img, array('width'=>450, 'height'=> 353))); ?>">
					<div class="hover-box">
						<div class="inner-hover">
							<h2><?php the_title(); ?></h2>
							<p><?php the_time('d F Y'); ?></p>
							<a class="link" href="<?php the_permalink(); ?>"><i class="fa fa-search"></i></a>
							<a class="zoom" href="<?php echo esc_url($img); ?>"><i class="fa fa-picture-o"></i></a>
						</div>						
					</div>
				</div>			
			<?php endwhile; ?>
		</div>
	</div>

</div>

<?php
    return ob_get_clean();

}
if(function_exists('vc_map')){

	add_action( 'init', 'portfolio_tax1', 999999 );
	function portfolio_tax1()
	{
	$categories = get_terms('portfolio_category' , 'hide_empty=0');
	//var_dump($portfolio_skills);

	$category_option = array();
	$category_option['All'] = 'all';
	foreach ($categories as $category) {

	//$default_contact = empty($default_sidebar) ? $contact->ID : $default_contact;
	$category_option[$category->name] = $category->slug;

	}

	vc_map( array(
	   "name" => __("QK Portfolio Slider","element"),
	   "base" => "qk_portfolio_slider",
	   "class" => "",
	   "category" => __("Content", "element"),
	   "icon" => "icon-qk",
	   "params" => array(
		   array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Select Category","spring"),
			 "param_name" => "cat",
			 "value" => $category_option,
			 "description" => ''
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Order","element"),
			 "param_name" => "order",
			 "value" => "9",
			 "description" => ''
		  ),
		   
	   )
	) );
	}
}

/************************************
*Portfolio Slider ELEMENT
*************************************/
add_shortcode('qk_portfolio_slider2','shortcode_portfolio_slider2');
function shortcode_portfolio_slider2($atts, $content=null){
	$atts = shortcode_atts(
		array(
		'order' => '',
		'cat' => '',
	), $atts);
	if($atts['cat']!='' and $atts['cat']!='all'){
		$args = array('post_type' => 'portfolio', 'posts_per_page' => $atts['order'], 'tax_query' => array(
		array(
			'taxonomy' => 'portfolio_category',
			'field'    => 'slug',
			'terms'    => $atts['cat'],
		),
	));
	}else{
		$args = array('post_type' => 'portfolio', 'posts_per_page' => $atts['order']);
	}	
	$portfolio = new WP_Query($args);
 ob_start(); ?>
 
 <div class="portfolio-box triggerAnimation animated" data-animate="fadeIn">
	<div id="owl-demo2" class="owl-carousel">

			<?php while($portfolio->have_posts()) : $portfolio->the_post(); ?>
				<?php
					$img = element_thumbnail_url('');
				?>
				<div class="item work-post">
					<img alt="<?php the_title(); ?>" src="<?php echo esc_attr(bfi_thumb($img, array('width'=>450, 'height'=> 353))); ?>">
					<div class="hover-box">
						<div class="inner-hover">
							<h2><?php the_title(); ?></h2>
							<p><?php the_time('d F Y'); ?></p>
							<a class="link" href="<?php the_permalink(); ?>"><i class="fa fa-search"></i></a>
							<a class="zoom" href="<?php echo esc_url($img); ?>"><i class="fa fa-picture-o"></i></a>
						</div>						
					</div>
				</div>			
			<?php endwhile; ?>
	</div>
</div>

<?php
    return ob_get_clean();

}
if(function_exists('vc_map')){

	add_action( 'init', 'portfolio_tax3', 999999 );
	function portfolio_tax3()
	{
	$categories = get_terms('portfolio_category' , 'hide_empty=0');
	//var_dump($portfolio_skills);

	$category_option = array();
	$category_option['All'] = 'all';
	foreach ($categories as $category) {

	//$default_contact = empty($default_sidebar) ? $contact->ID : $default_contact;
	$category_option[$category->name] = $category->slug;

	}

	vc_map( array(
	   "name" => __("QK Portfolio Slider2","element"),
	   "base" => "qk_portfolio_slider2",
	   "class" => "",
	   "category" => __("Content", "element"),
	   "icon" => "icon-qk",
	   "params" => array(
		   array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Select Category","spring"),
			 "param_name" => "cat",
			 "value" => $category_option,
			 "description" => ''
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Order","element"),
			 "param_name" => "order",
			 "value" => "10",
			 "description" => ''
		  ),
		   
	   )
	) );
	}
}

/************************************
*Portfolio  ELEMENT
*************************************/
add_shortcode('qk_portfolio','shortcode_portfolio');
function shortcode_portfolio($atts, $content=null){
	$atts = shortcode_atts(
		array(
		'order' => '',
		'cat' => '',
	), $atts);
	if($atts['cat']!='' and $atts['cat']!='all'){
		$args = array('post_type' => 'portfolio', 'posts_per_page' => $atts['order'], 'tax_query' => array(
		array(
			'taxonomy' => 'portfolio_category',
			'field'    => 'slug',
			'terms'    => $atts['cat'],
		),
	));
	}else{
		$args = array('post_type' => 'portfolio', 'posts_per_page' => $atts['order']);
	}	
	$portfolio = new WP_Query($args);
 ob_start(); ?>
 
 <div class="portfolio-box fullscreen triggerAnimation animated" data-animate="fadeIn">
	<?php while($portfolio->have_posts()) : $portfolio->the_post(); ?>
	<?php
		$img = element_thumbnail_url('');
	?>
	<div class="work-post">
		<img alt="<?php the_title(); ?>" src="<?php echo esc_attr(bfi_thumb($img, array('width'=>450, 'height'=> 353))); ?>">
		<div class="hover-box">
			<div class="inner-hover">
				<h2><?php the_title(); ?></h2>
				<p><?php the_time('d F Y'); ?></p>
				<a class="link" href="<?php the_permalink(); ?>"><i class="fa fa-search"></i></a>
				<a class="zoom" href="<?php echo esc_url($img); ?>"><i class="fa fa-picture-o"></i></a>
			</div>						
		</div>
	</div>
	<?php endwhile; ?>
</div>

<?php
    return ob_get_clean();

}
if(function_exists('vc_map')){

	add_action( 'init', 'portfolio_tax2', 999999 );
	function portfolio_tax2()
	{
	$categories = get_terms('portfolio_category' , 'hide_empty=0');
	//var_dump($portfolio_skills);

	$category_option = array();
	$category_option['All'] = 'all';
	foreach ($categories as $category) {

	//$default_contact = empty($default_sidebar) ? $contact->ID : $default_contact;
	$category_option[$category->name] = $category->slug;

	}

	vc_map( array(
	   "name" => __("QK Portfolio","element"),
	   "base" => "qk_portfolio",
	   "class" => "",
	   "category" => __("Content", "element"),
	   "icon" => "icon-qk",
	   "params" => array(
		   array(
			 "type" => "dropdown",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Select Category","spring"),
			 "param_name" => "cat",
			 "value" => $category_option,
			 "description" => ''
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Order","element"),
			 "param_name" => "order",
			 "value" => "5",
			 "description" => ''
		  ),
		   
	   )
	) );
	}
}

/************************************
*Portfolio Slider typo
*************************************/
add_shortcode('qk_video_bg','shortcode_video_bg');
function shortcode_video_bg($atts, $content=null){
	$atts = shortcode_atts(
		array(
		'video_url' => '',
		'id' => '',
		'title' => '',
		'subtitle' => '',
		'intro' => '',
	), $atts);
	wp_enqueue_style("YTPlayer", get_template_directory_uri()."/css/YTPlayer.css");
	wp_enqueue_script("YTPlayer", get_template_directory_uri()."/js/jquery.mb.YTPlayer.js",array(),false,true);
	
 ob_start(); ?>
 <!-- video background tags -->
<div id="customElement"></div>
<a id="video" class="player" data-property="{videoURL:'<?php echo esc_attr($atts['video_url']); ?>',containment:'#customElement', showControls:false, autoPlay:true, loop:true, mute:true, startAt:0, opacity:1, addRaster:false, quality:'default'}">My video</a> <!--BsekcY04xvQ-->
<!-- end video background tags -->

 
<?php
    return ob_get_clean();

}
if(function_exists('vc_map')){

vc_map( array(
   "name" => __("QK Video background","typo"),
   "base" => "qk_video_bg",
   "class" => "",
   "category" => __("Content", "typo"),
   "icon" => "icon-qk",
   "params" => array(
	
	array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Video Url","typo"),
         "param_name" => "video_url",
         "value" => "https://www.youtube.com/watch?v=2_OOO_gzZJs",
         "description" => ''
      ),
	  
   )
) );

}


/************************************
*Pricing Element
*************************************/
function shortcode_pricing( $atts,  $content = null ) {
    extract( shortcode_atts( array(
      'title' => '',
      'price' => '',
      'time' => '',
      'price_row' => '',
      'button_text' => '',
      'link' => '',
      'popular' => '',
      
   ), $atts ) );
   ob_start(); ?>
	<ul class="pricing-table <?php echo esc_html($title); ?>">
		<li>
			<h2><?php echo esc_html($title); ?></h2>
		</li>
		<li class="title">
			<p><span><?php echo esc_html($price); ?></span>/ <?php echo esc_html($time); ?></p>
		</li>
		<li class="pricing-row">
		<?php echo  rawurldecode(base64_decode(strip_tags($price_row))); ?>
		</li>
		<li>
			<a href="<?php echo esc_url($link); ?>"><?php echo esc_html($button_text); ?></a>
		</li>
	</ul>
	
<?php
    return ob_get_clean();

}
add_shortcode( 'qk_pricing', 'shortcode_pricing' );

if(function_exists('vc_map')){

vc_map( array(
   "name" => __("QK Pricing","oliver"),
   "base" => "qk_pricing",
   "class" => "",
   "category" => __("Content", "oliver"),
   "icon" => "icon-qk",
   "params" => array(
	 
      
	   array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title","oliver"),
         "param_name" => "title",
         "value" => "Standart",
         "description" => ''
      ),array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Price","oliver"),
         "param_name" => "price",
         "value" => "$15",
         "description" => ''
      ),array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Time","oliver"),
         "param_name" => "time",
         "value" => "Per month",
         "description" => ''
      ),array(
         "type" => "textarea_raw_html",
         "holder" => "div",
         "class" => "",
         "heading" => __("Price Row","oliver"),
         "param_name" => "price_row",
         "value" =>'<ul><li><p>Feature 1</p></li>
<li><p>Feature 2</p></li>
<li><p>Feature 3</p></li>
<li><p>Feature 4</p></li>
</ul>',
         "description" => ''
      ),
	 array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Button","oliver"),
         "param_name" => "button_text",
         "value" => "Order Now",
         "description" => ''
      ),array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Link","oliver"),
         "param_name" => "link",
         "value" => "#",
         "description" => ''
      )
   )
) );

}




/************************************
*Pricing Element
*************************************/
function shortcode_pricing2( $atts,  $content = null ) {
    extract( shortcode_atts( array(
      'title' => '',
      'subtitle' => '',
      'price' => '',
      'time' => '',
      'price_row' => '',
      'button_text' => '',
      'link' => '',
      'popular' => '',
      
   ), $atts ) );
   ob_start(); ?>
	<ul class="pricing-table2 <?php echo esc_html($title); ?>">
		<li>
			<h2><?php echo esc_html($title); ?></h2>
			<h1>
				$<span><?php echo esc_html($price); ?></span></span>/ <?php echo esc_html($time); ?>
			</h1>
			<p><?php echo esc_html($subtitle); ?></p>
		</li>
		
		<li class="pricing-row">
		<?php echo  rawurldecode(base64_decode(strip_tags($price_row))); ?>
		</li>
		<li>
			<a href="<?php echo esc_url($link); ?>"><?php echo esc_html($button_text); ?></a>
		</li>
	</ul>
	
<?php
    return ob_get_clean();

}
add_shortcode( 'qk_pricing2', 'shortcode_pricing2' );

if(function_exists('vc_map')){

vc_map( array(
   "name" => __("QK Pricing 2","oliver"),
   "base" => "qk_pricing2",
   "class" => "",
   "category" => __("Content", "oliver"),
   "icon" => "icon-qk",
   "params" => array(
	 
      
	   array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title","oliver"),
         "param_name" => "title",
         "value" => "Standart",
         "description" => ''
      ), array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Sub Title","oliver"),
         "param_name" => "subtitle",
         "value" => "Created for Professional People",
         "description" => ''
      ),array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Price","oliver"),
         "param_name" => "price",
         "value" => "$15",
         "description" => ''
      ),array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Time","oliver"),
         "param_name" => "time",
         "value" => "mo",
         "description" => ''
      ),array(
         "type" => "textarea_raw_html",
         "holder" => "div",
         "class" => "",
         "heading" => __("Price Row","oliver"),
         "param_name" => "price_row",
         "value" =>'<ul><li><p>Feature 1</p></li>
<li><p>Feature 2</p></li>
<li><p>Feature 3</p></li>
<li><p>Feature 4</p></li>
</ul>
',
         "description" => ''
      ),
	 array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Button","oliver"),
         "param_name" => "button_text",
         "value" => "Order Now",
         "description" => ''
      ),array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Link","oliver"),
         "param_name" => "link",
         "value" => "#",
         "description" => ''
      )
   )
) );

}
/************************************
*Statistic ELEMENT
*************************************/
function shortcode_statistic( $atts,  $content = null ) {
    extract( shortcode_atts( array(
      
	  'title' => '',
	  'level' => '',
	  'after' => '',
	  
      
   ), $atts ) );
	wp_enqueue_script("appear", get_template_directory_uri()."/js/jquery.appear.js",array(),false,true);
	wp_enqueue_script("countTo", get_template_directory_uri()."/js/jquery.countTo.js",array(),false,true);
   static $count = 1;
   ob_start(); ?>
   <div class="statistic-post">
		<h2><span class="timer" data-from="0" data-to="<?php echo esc_attr($level); ?>"></span><?php echo esc_html($after); ?></h2>
		<p><?php echo esc_html($title); ?></p>
	</div>
	
	
<?php
	$count++; 
    return ob_get_clean();

}
add_shortcode( 'qk_statistic', 'shortcode_statistic' );

if(function_exists('vc_map')){

vc_map( array(
   "name" => __("QK Statistic","element"),
   "base" => "qk_statistic",
   "class" => "",
   "icon" => "icon-qk",
   "category" => __("Content", "element"),
   "params" => array(
	 array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title","element"),
         "param_name" => "title",
         "value" => "Your Title Goes Here",
         "description" => ''
      ),
      
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Number","element"),
         "param_name" => "level",
         "value" => "1255",
         "description" => ''
      ),
	  
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("After","element"),
         "param_name" => "after",
         "value" => "",
         "description" => "'+', '%', ..."
      ),
   )
) );

}

/************************************
*Team ELEMENT
*************************************/
function shortcode_team( $atts,  $content = null ) {
    extract( shortcode_atts( array(
	  'image' => '',
	  'name' => 'Jonathan Sanders',
	  'job' => 'Development',
	  'facebook' => '',
	  'twitter' => '',
	  'linkedin' => '',
	  'dribble' => '',
      
   ), $atts ) );
   ob_start(); ?>
   
   <div class="team-post">
		<?php
			$img = wp_get_attachment_image_src($image,'full');
			$img = $img[0];
		?>
		<img src="<?php echo esc_attr($img); ?>" alt="member" class="img-responsive">
		<div class="team-content">
			<h2><?php echo esc_html($name); ?></h2>
			<span><?php echo esc_attr($job); ?></span>
			<p><?php echo do_shortcode($content); ?></p>
			<ul class="team-social">
				<?php if($facebook!=''){ ?>
				<li><a class="facebook" href="<?php echo esc_url($facebook); ?>"><i class="fa fa-facebook"></i></a></li>
				<?php } ?>
				<?php if($twitter!=''){ ?>
				<li><a class="twitter" href="<?php echo esc_url($twitter); ?>"><i class="fa fa-twitter"></i></a></li>
				<?php } ?>
				<?php if($dribble!=''){ ?>
				<li><a class="dribble" href="<?php echo esc_url($dribble); ?>"><i class="fa fa-dribbble"></i></a></li>
				<?php } ?>
				<?php if($linkedin!=''){ ?>
				<li><a class="linkedin" href="<?php echo esc_url($linkedin); ?>"><i class="fa fa-linkedin"></i></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
  
<?php
    return ob_get_clean();

}
add_shortcode( 'qk_team', 'shortcode_team' );

if(function_exists('vc_map')){

vc_map( array(
   "name" => __("QK Member","element"),
   "base" => "qk_team",
   "class" => "",
   "icon" => "icon-qk",
   "category" => __("Content", "element"),
   "params" => array(
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Name","element"),
         "param_name" => "name",
         "value" => "John Doe",
         "description" => ''
      ),
	  
     array(
         "type"      => "attach_image",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Avatar", 'element'),
         "param_name"=> "image",
         "value"     => "",
         "description" => __("UploadIcon", 'element')
      ),
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Job","element"),
         "param_name" => "job",
         "value" => "Designer",
         "description" => ''
      ),
	  array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "",
         "heading" => __("Content ","element"),
         "param_name" => "content",
         "value" => 'Nam elementum eleifend diam a vulputate. Curabitur egestas nisl lacus, vitae ullamcorper lacus placerat eget. Sed tium vehicula tristique. Quisque vel metus',
         "description" => ''
      ),
	   array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Twitter","element"),
         "param_name" => "twitter",
         "value" => "",
         "description" => ''
      ),array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Facebook","element"),
         "param_name" => "facebook",
         "value" => "",
         "description" => ''
      ),array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Dribble","element"),
         "param_name" => "dribble",
         "value" => "",
         "description" => ''
      ),array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Linkedin","element"),
         "param_name" => "linkedin",
         "value" => "",
         "description" => ''
      )
   )
) );

}

/************************************
*Team ELEMENT
*************************************/
function shortcode_team2( $atts,  $content = null ) {
    extract( shortcode_atts( array(
	  'image' => '',
	  'name' => 'Jonathan Sanders',
	  'job' => 'Development',
	  'facebook' => '',
	  'twitter' => '',
	  'linkedin' => '',
	  'dribble' => '',
      
   ), $atts ) );
   ob_start(); ?>
   <div class="team-post2">
		<?php
			$img = wp_get_attachment_image_src($image,'full');
			$img = $img[0];
		?>
		<img src="<?php echo esc_attr($img); ?>" alt="member" class="img-responsive">
		<div class="team-content">
			<h2><?php echo esc_html($name); ?></h2>
			<span><?php echo esc_attr($job); ?></span>
			<p><?php echo do_shortcode($content); ?></p>
			<ul class="team-social">
				<?php if($facebook!=''){ ?>
				<li><a class="facebook" href="<?php echo esc_url($facebook); ?>"><i class="fa fa-facebook"></i></a></li>
				<?php } ?>
				<?php if($twitter!=''){ ?>
				<li><a class="twitter" href="<?php echo esc_url($twitter); ?>"><i class="fa fa-twitter"></i></a></li>
				<?php } ?>
				<?php if($dribble!=''){ ?>
				<li><a class="dribble" href="<?php echo esc_url($dribble); ?>"><i class="fa fa-dribbble"></i></a></li>
				<?php } ?>
				<?php if($linkedin!=''){ ?>
				<li><a class="linkedin" href="<?php echo esc_url($linkedin); ?>"><i class="fa fa-linkedin"></i></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
  
<?php
    return ob_get_clean();

}
add_shortcode( 'qk_team2', 'shortcode_team2' );

if(function_exists('vc_map')){

vc_map( array(
   "name" => __("QK Member 2","element"),
   "base" => "qk_team2",
   "class" => "",
   "icon" => "icon-qk",
   "category" => __("Content", "element"),
   "params" => array(
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Name","element"),
         "param_name" => "name",
         "value" => "John Doe",
         "description" => ''
      ),
	  
     array(
         "type"      => "attach_image",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Avatar", 'element'),
         "param_name"=> "image",
         "value"     => "",
         "description" => __("UploadIcon", 'element')
      ),
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Job","element"),
         "param_name" => "job",
         "value" => "Designer",
         "description" => ''
      ),
	  array(
         "type" => "textarea",
         "holder" => "div",
         "class" => "",
         "heading" => __("Content ","element"),
         "param_name" => "content",
         "value" => 'Nam elementum eleifend diam a vulputate. Curabitur egestas nisl lacus, vitae ullamcorper lacus placerat eget. Sed tium vehicula tristique. Quisque vel metus',
         "description" => ''
      ),
	   array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Twitter","element"),
         "param_name" => "twitter",
         "value" => "",
         "description" => ''
      ),array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Facebook","element"),
         "param_name" => "facebook",
         "value" => "",
         "description" => ''
      ),array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Dribble","element"),
         "param_name" => "dribble",
         "value" => "",
         "description" => ''
      ),array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Linkedin","element"),
         "param_name" => "linkedin",
         "value" => "",
         "description" => ''
      )
   )
) );

}
/************************************
*Testimonial Slider ELEMENT
*************************************/
add_shortcode('qk_testimonial','shortcode_testimonial');
function shortcode_testimonial($atts, $content=null){
	$atts = shortcode_atts(
		array(
		'order' => '8',
		'id' => '',
		'title' => '',
	), $atts);
	$args = array('post_type' => 'testimonial', 'posts_per_page' => $atts['order']);
	wp_enqueue_style( 'bxslider', get_template_directory_uri().'/css/jquery.bxslider.css');
	wp_enqueue_script("bxslider", get_template_directory_uri()."/js/jquery.bxslider.min.js",array(),false,true);	
	$testimonials = new WP_Query($args);
 ob_start(); ?>
		<div class="testimonial-box1">
			<div class="container triggerAnimation animated" data-animate="fadeIn">
				<ul class="bxslider">
					<?php while($testimonials->have_posts()) : $testimonials->the_post(); ?>
					<li>
						<?php the_content(); ?>
						<h2><?php the_title(); ?></h2>
					</li>
					<?php endwhile; ?>
				</ul>
			</div>
		</div>

		
<?php
    return ob_get_clean();

}
if(function_exists('vc_map')){

vc_map( array(
   "name" => __("QK Testimonials","element"),
   "base" => "qk_testimonial",
   "class" => "",
   "category" => __("Content", "element"),
   "icon" => "icon-qk",
   "params" => array(
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Order","element"),
         "param_name" => "order",
         "value" => "4",
         "description" => ''
      )
	  
   )
) );

}

/************************************
*Testimonial Slider ELEMENT
*************************************/
add_shortcode('qk_testimonial2','shortcode_testimonial2');
function shortcode_testimonial2($atts, $content=null){
	$atts = shortcode_atts(
		array(
		'order' => '8',
		'id' => '',
		'title' => '',
	), $atts);
	$args = array('post_type' => 'testimonial', 'posts_per_page' => $atts['order']);
			
	$portfolio = new WP_Query($args);
 ob_start(); ?>
		<div class="testimonial-box2">
			<div class="container">
				<ul class="testimonial-list">
					<?php while($portfolio->have_posts()) : $portfolio->the_post(); ?>
					<li>
						<?php the_content(); ?>
						<div class="autor-testim">
						<?php if(get_post_meta(get_the_ID(), '_cmb_t_logo', true)!=''){ ?>
							<img src="<?php echo esc_attr(get_post_meta(get_the_ID(), '_cmb_t_logo', true)); ?>" alt="<?php the_title(); ?>">
						<?php } ?>
							<h3><?php the_title(); ?></h3>
							<span>Happy Customer</span>
						</div>
					</li>
					<?php endwhile; ?>
				</ul>
			</div>
		</div>
		
		
<?php
    return ob_get_clean();

}
if(function_exists('vc_map')){

vc_map( array(
   "name" => __("QK Testimonials 2","element"),
   "base" => "qk_testimonial2",
   "class" => "",
   "category" => __("Content", "element"),
   "icon" => "icon-qk",
   "params" => array(
		
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Order","element"),
         "param_name" => "order",
         "value" => "2",
         "description" => ''
      )
	  
   )
) );

}
/************************************
*Client ELEMENT
*************************************/
add_shortcode('qk_client','shortcode_client');
function shortcode_client($atts, $content=null){
	$atts = shortcode_atts(
		array(
		'cat' => '',
		'order' => '3',
		'title' => '',
		'sub_title' => '',
	), $atts);
	
	$args = array('post_type' => 'client', 'posts_per_page' => $atts['order']);
		
	 $clients = new WP_Query($args);
	  ob_start(); ?>
	  <div class="client-box">
			<div class="container triggerAnimation animated" data-animate="fadeIn">
				<ul>
					<?php while($clients->have_posts()) : $clients->the_post(); ?>
						<li><a target="_blank" href="<?php echo esc_url(get_post_meta(get_the_ID(), '_cmb_c_link', true)); ?>"><img alt="<?php the_title(); ?>" src="<?php echo esc_attr(get_post_meta(get_the_ID(), '_cmb_c_logo', true)); ?>" ></a></li>
					<?php endwhile; ?>
				</ul>
			</div>
		</div>

	 <?php
    return ob_get_clean();

}

if(function_exists('vc_map')){

vc_map( array(
   "name" => __("QK Clients","element"),
   "base" => "qk_client",
   "class" => "",
   "icon" => "icon-qk",
   "category" => __("Content", "element"),
   "params" => array(
     array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Order","element"),
         "param_name" => "order",
         "value" => '6',
         "description" => ''
      )
   )
) );

}

/************************************
*Featured Product ELEMENT
*************************************/
add_shortcode('qk_feature_product','shortcode_featured_product');
function shortcode_featured_product($atts, $content=null){
	$atts = shortcode_atts(
		array(
		'order' => '',
		'title' => '',
		'items' => '',
	), $atts);
		$query_args = array(
			'posts_per_page' => $atts['order'],
			'post_status' 	 => 'publish',
			'post_type' 	 => 'product',
			'no_found_rows'  => 1,
			'order'          => $order == 'asc' ? 'asc' : 'desc'
		);
		global $woocommerce; 
		$query_args['meta_query'] = array();
		$query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
		$query_args['meta_query']   = array_filter( $query_args['meta_query'] );
		$query_args['meta_query'][] = array(
			'key'   => '_featured',
			'value' => 'yes'
		);
		static $countf = 1;
 ob_start(); ?>
	<?php ?>
		
		<div class="shop-box">
			<h2><?php echo esc_html($atts['title']); ?></h2>
			<div class="carousel-arrows featured<?php echo esc_attr($countf); ?>-arrows">
				<a href="#" class="prev-link"><i class="fa fa-angle-left"></i></a>
				<a href="#" class="next-link"><i class="fa fa-angle-right"></i></a>
			</div>	
			<div id="owl-featured<?php echo esc_attr($countf); ?>" class="owl-carousel owl-featured">
			<?php 
				$r = new WP_Query( $query_args );
				if ( $r->have_posts() ) : while( $r->have_posts() ) : $r->the_post(); 
				global $product, $woocommerce_loop, $post;
			?>
				<div class="item">
					<div class="shop-post">
						<div class="shop-gal">
							<a href="<?php the_permalink(); ?>"><i class="fa fa-list-ul"></i></a>
							<?php if(has_post_thumbnail()){  ?>
							<?php the_post_thumbnail(); ?>
							<?php }else{ ?>
							<img src="http://placehold.it/300x300" alt="<?php the_title(); ?>">
							<?php } ?>
							<?php
								//$WC_nb = new WC_nb();
								//$WC_nb->woocommerce_show_product_loop_new_badge(); 
								$postdate 		= get_the_time( 'Y-m-d' );			// Post date
								$postdatestamp 	= strtotime( $postdate );			// Timestamped post date
								$newness 		= get_option( 'wc_nb_newness' ); 	// Newness in days as defined by option

								if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp ) {
							?>
							<span class="new"><?php _e('New', 'element'); ?></span>
							<?php } ?>
						</div>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
						<div><?php echo do_shortcode($product->get_price_html()); ?></div>
						<?php
							$handler = apply_filters( 'woocommerce_add_to_cart_handler', $product->product_type, $product );
							switch ( $handler ) {
							case "variable" :
								$add_cart = get_permalink();
							break;
							case "grouped" :
								$add_cart = get_permalink();
							break;
							case "external" :
								 $add_cart = get_permalink();
							break;
							default :
								if ( $product->is_purchasable() ) {
									 $add_cart = esc_url( $product->add_to_cart_url() );
								} else {
									 $add_cart = get_permalink();
								}
							break;
						}
						?>
						<a class="add-to-cart add_to_cart_button  product_type_<?php echo esc_attr($product->product_type); ?>"" href="<?php echo esc_url($add_cart); ?>" rel="nofollow" data-product_id="<?php the_ID(); ?>" data-product_sku="<?php echo esc_attr($product->get_sku()); ?>"><?php _e('Add to Cart', 'element'); ?></a>
					</div>
				</div>
			<?php endwhile; endif; ?>
			<?php wp_reset_postdata(); ?>
			</div>
		</div>
		<script>
			(function($){
				$(document).ready(function(){
					try {
						var owl = $("#owl-featured<?php echo esc_js($countf); ?>");
						owl.owlCarousel({
							items : <?php echo esc_js($atts['items']); ?>,
							itemsDesktop : [1199,4],
							itemsDesktopSmall : [979,3]
						});
						// Custom Navigation Events
						$(".featured<?php echo esc_js($countf); ?>-arrows .next-link").click(function(event){
							event.preventDefault();
							owl.trigger('owl.next');
						});
						$(".featured<?php echo esc_js($countf); ?>-arrows .prev-link").click(function(event){
							event.preventDefault();
							owl.trigger('owl.prev');
						});
					} catch(err) {

					}
				});
			})(jQuery);
		</script>

<?php
    return ob_get_clean();
	$countf++;
}
if(function_exists('vc_map')){

	

	vc_map( array(
	   "name" => __("QK Featured Product","element"),
	   "base" => "qk_feature_product",
	   "class" => "",
	   "category" => __("Content", "element"),
	   "icon" => "icon-qk",
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title","element"),
			 "param_name" => "title",
			 "value" => "Featured Products",
			 "description" => ''
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Products on each slide","element"),
			 "param_name" => "items",
			 "value" => "6",
			 "description" => ''
		  ),array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Order","element"),
			 "param_name" => "order",
			 "value" => "8",
			 "description" => ''
		  ),
		   
	   )
	) );
	
}

/************************************
*Featured Product ELEMENT
*************************************/
add_shortcode('qk_best_product','shortcode_best_product');
function shortcode_best_product($atts, $content=null){
	$atts = shortcode_atts(
		array(
		'order' => '',
		'title' => '',
		'items' => '',
	), $atts);
		$query_args = array(
			'posts_per_page' => $atts['order'],
			'post_status' 	 => 'publish',
				'post_type' 	 => 'product',
				'no_found_rows'  => 1,
				'order'          => $order == 'asc' ? 'asc' : 'desc',
			);
			global $woocommerce; 
			$query_args['meta_query'] = array();
			$query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
			$query_args['meta_query']   = array_filter( $query_args['meta_query'] );
			$query_args['meta_key'] = 'total_sales';
			$query_args['orderby']  = 'meta_value_num';
			
		static $countb = 1;
 ob_start(); ?>
	<?php ?>
		
		<div class="shop-box">
			<h2><?php echo esc_html($atts['title']); ?></h2>
			<div class="carousel-arrows best<?php echo esc_attr($countb); ?>-arrows">
				<a href="#" class="prev-link"><i class="fa fa-angle-left"></i></a>
				<a href="#" class="next-link"><i class="fa fa-angle-right"></i></a>
			</div>	
			<div id="owl-best<?php echo esc_attr($countb); ?>" class="owl-carousel owl-best">
			<?php 
				$r = new WP_Query( $query_args );
				if ( $r->have_posts() ) : while( $r->have_posts() ) : $r->the_post(); 
				global $product, $woocommerce_loop, $post;
			?>
				<div class="item">
					<div class="shop-post">
						<div class="shop-gal">
							<a href="<?php the_permalink(); ?>"><i class="fa fa-list-ul"></i></a>
							<?php if(has_post_thumbnail()){  ?>
							<?php the_post_thumbnail(); ?>
							<?php }else{ ?>
							<img src="http://placehold.it/300x300" alt="<?php the_title(); ?>">
							<?php } ?>
							<?php
								//$WC_nb = new WC_nb();
								//$WC_nb->woocommerce_show_product_loop_new_badge(); 
								$postdate 		= get_the_time( 'Y-m-d' );			// Post date
								$postdatestamp 	= strtotime( $postdate );			// Timestamped post date
								$newness 		= get_option( 'wc_nb_newness' ); 	// Newness in days as defined by option

								if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp ) {
							?>
							<span class="new"><?php _e('New', 'element'); ?></span>
							<?php } ?>
						</div>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
						<div><?php echo do_shortcode($product->get_price_html()); ?></div>
						<?php
							$handler = apply_filters( 'woocommerce_add_to_cart_handler', $product->product_type, $product );
							switch ( $handler ) {
							case "variable" :
								$add_cart = get_permalink();
							break;
							case "grouped" :
								$add_cart = get_permalink();
							break;
							case "external" :
								 $add_cart = get_permalink();
							break;
							default :
								if ( $product->is_purchasable() ) {
									 $add_cart = esc_url( $product->add_to_cart_url() );
								} else {
									 $add_cart = get_permalink();
								}
							break;
						}
						?>
						<a class="add-to-cart add_to_cart_button  product_type_<?php echo esc_attr($product->product_type); ?>"" href="<?php echo esc_url($add_cart); ?>" rel="nofollow" data-product_id="<?php the_ID(); ?>" data-product_sku="<?php echo esc_attr($product->get_sku()); ?>"><?php _e('Add to Cart', 'element'); ?></a>
					</div>
				</div>
			<?php endwhile; endif; ?>
			<?php wp_reset_postdata(); ?>
			</div>
		</div>
		<script>
			(function($){
				$(document).ready(function(){
					try {
						var owl = $("#owl-best<?php echo esc_js($countb); ?>");
						owl.owlCarousel({
							items : <?php echo esc_js($atts['items']); ?>,
							itemsDesktop : [1199,4],
							itemsDesktopSmall : [979,3]
						});
						// Custom Navigation Events
						$(".best<?php echo esc_js($countb); ?>-arrows .next-link").click(function(event){
							event.preventDefault();
							owl.trigger('owl.next');
						});
						$(".best<?php echo esc_js($countb); ?>-arrows .prev-link").click(function(event){
							event.preventDefault();
							owl.trigger('owl.prev');
						});
					} catch(err) {

					}
				});
			})(jQuery);
		</script>

<?php
    return ob_get_clean();
	$countb++;
}
if(function_exists('vc_map')){

	

	vc_map( array(
	   "name" => __("QK Best Product","element"),
	   "base" => "qk_best_product",
	   "class" => "",
	   "category" => __("Content", "element"),
	   "icon" => "icon-qk",
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title","element"),
			 "param_name" => "title",
			 "value" => "Best Products",
			 "description" => ''
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Products on each slide","element"),
			 "param_name" => "items",
			 "value" => "3",
			 "description" => ''
		  ),array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Order","element"),
			 "param_name" => "order",
			 "value" => "6",
			 "description" => ''
		  ),
		   
	   )
	) );
	
}

/************************************
*Portfolio Slider ELEMENT
*************************************/
add_shortcode('qk_recent_product','shortcode_recent_product');
function shortcode_recent_product($atts, $content=null){
	$atts = shortcode_atts(
		array(
		'order' => '',
		'title' => '',
		'items' => '',
	), $atts);
		$query_args = array(
			'posts_per_page' => $atts['order'],
			'post_status' 	 => 'publish',
				'post_type' 	 => 'product',
				'no_found_rows'  => 1,
				'order'          => $order == 'asc' ? 'asc' : 'desc'
			);
			global $woocommerce; 
			$query_args['meta_query'] = array();
			$query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
			$query_args['meta_query']   = array_filter( $query_args['meta_query'] );
			static $countr = 1;
 ob_start(); ?>
	<?php ?>
		<div class="shop-box">
			<h2><?php echo esc_html($atts['title']); ?></h2>
			<div class="carousel-arrows recent<?php echo esc_attr($countr); ?>-arrows">
				<a href="#" class="prev-link"><i class="fa fa-angle-left"></i></a>
				<a href="#" class="next-link"><i class="fa fa-angle-right"></i></a>
			</div>	
			<div id="owl-recent<?php echo esc_attr($countr); ?>" class="owl-recent owl-carousel">
				
				<?php 
				$r = new WP_Query( $query_args );
				if ( $r->have_posts() ) : while( $r->have_posts() ) : $r->the_post(); 
				global $product, $woocommerce_loop, $post;
			?>
				<div class="item">
					<div class="shop-post">
						<div class="shop-gal">
							<a href="<?php the_permalink(); ?>"><i class="fa fa-list-ul"></i></a>
							<?php if(has_post_thumbnail()){  ?>
							<?php the_post_thumbnail(); ?>
							<?php }else{ ?>
							<img src="http://placehold.it/300x300" alt="<?php the_title(); ?>">
							<?php } ?>
							<?php
								//$WC_nb = new WC_nb();
								//$WC_nb->woocommerce_show_product_loop_new_badge(); 
								$postdate 		= get_the_time( 'Y-m-d' );			// Post date
								$postdatestamp 	= strtotime( $postdate );			// Timestamped post date
								$newness 		= get_option( 'wc_nb_newness' ); 	// Newness in days as defined by option

								if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp ) {
							?>
							<span class="new"><?php _e('New', 'element'); ?></span>
							<?php } ?>
						</div>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
						<div><?php echo do_shortcode($product->get_price_html()); ?></div>
						<?php
							$handler = apply_filters( 'woocommerce_add_to_cart_handler', $product->product_type, $product );
							switch ( $handler ) {
							case "variable" :
								$add_cart = get_permalink();
							break;
							case "grouped" :
								$add_cart = get_permalink();
							break;
							case "external" :
								 $add_cart = get_permalink();
							break;
							default :
								if ( $product->is_purchasable() ) {
									 $add_cart = esc_url( $product->add_to_cart_url() );
								} else {
									 $add_cart = get_permalink();
								}
							break;
						}
						?>
						<a class="add-to-cart add_to_cart_button  product_type_<?php echo esc_attr($product->product_type); ?>"" href="<?php echo esc_url($add_cart); ?>" rel="nofollow" data-product_id="<?php the_ID(); ?>" data-product_sku="<?php echo esc_attr($product->get_sku()); ?>"><?php _e('Add to Cart', 'element'); ?></a>
					</div>
				</div>
			<?php endwhile; endif; ?>
			<?php wp_reset_postdata(); ?>
				
			</div>
		</div>
		<script>
			(function($){
				$(document).ready(function(){
					try {
						var owl = $("#owl-recent<?php echo esc_js($countr); ?>");
						owl.owlCarousel({
							items : <?php echo esc_js($atts['items']); ?>,
							itemsDesktop : [1199,4],
							itemsDesktopSmall : [979,3]
						});
						// Custom Navigation Events
						$(".recent<?php echo esc_js($countr); ?>-arrows .next-link").click(function(event){
							event.preventDefault();
							owl.trigger('owl.next');
						});
						$(".recent<?php echo esc_js($countr); ?>-arrows .prev-link").click(function(event){
							event.preventDefault();
							owl.trigger('owl.prev');
						});
					} catch(err) {

					}
				});
			})(jQuery);
		</script>
	
<?php
    return ob_get_clean();
	$countr++;
}
if(function_exists('vc_map')){

	

	vc_map( array(
	   "name" => __("QK Recent Product","element"),
	   "base" => "qk_recent_product",
	   "class" => "",
	   "category" => __("Content", "element"),
	   "icon" => "icon-qk",
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title","element"),
			 "param_name" => "title",
			 "value" => "Recent Products",
			 "description" => ''
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Order","element"),
			 "param_name" => "order",
			 "value" => "8",
			 "description" => ''
		  ),array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Product on each Slider","element"),
			 "param_name" => "items",
			 "value" => "6",
			 "description" => ''
		  ),
		   
	   )
	) );
	
}


add_shortcode('qk_rated_product','shortcode_rated_product');
function shortcode_rated_product($atts, $content=null){
	$atts = shortcode_atts(
		array(
		'order' => '',
		'title' => '',
		'items' => '',
	), $atts);
		$query_args = array(
			'posts_per_page' => $atts['order'],
			'post_status' 	 => 'publish',
				'post_type' 	 => 'product',
				'no_found_rows'  => 1,
				'order'          => $order == 'asc' ? 'asc' : 'desc'
			);
			global $woocommerce; 
			$query_args['meta_query'] = array();
			$query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
			$query_args['meta_query']   = array_filter( $query_args['meta_query'] );
			
 ob_start(); ?>
	<?php static $countr = 1; ?>
	<?php ?>
		<div class="shop-box">
			<h2><?php echo esc_html($atts['title']); ?></h2>
			<div class="carousel-arrows top-rated<?php echo esc_attr($countr); ?>-arrows">
				<a href="#" class="prev-link"><i class="fa fa-angle-left"></i></a>
				<a href="#" class="next-link"><i class="fa fa-angle-right"></i></a>
			</div>	
			<div id="owl-top-rated<?php echo esc_attr($countr); ?>" class="owl-top-rated owl-carousel">
				
				<?php 
				$r = new WP_Query( $query_args );
				if ( $r->have_posts() ) : while( $r->have_posts() ) : $r->the_post(); 
				global $product, $woocommerce_loop, $post;
			?>
				<div class="item">
					<div class="shop-post">
						<div class="shop-gal">
							<a href="<?php the_permalink(); ?>"><i class="fa fa-list-ul"></i></a>
							<?php if(has_post_thumbnail()){  ?>
							<?php the_post_thumbnail(); ?>
							<?php }else{ ?>
							<img src="http://placehold.it/300x300" alt="<?php the_title(); ?>">
							<?php } ?>
							<?php
								//$WC_nb = new WC_nb();
								//$WC_nb->woocommerce_show_product_loop_new_badge(); 
								$postdate 		= get_the_time( 'Y-m-d' );			// Post date
								$postdatestamp 	= strtotime( $postdate );			// Timestamped post date
								$newness 		= get_option( 'wc_nb_newness' ); 	// Newness in days as defined by option

								if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp ) {
							?>
							<span class="new"><?php _e('New', 'element'); ?></span>
							<?php } ?>
						</div>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
						<div><?php echo do_shortcode($product->get_price_html()); ?></div>
						<?php
							$handler = apply_filters( 'woocommerce_add_to_cart_handler', $product->product_type, $product );
							switch ( $handler ) {
							case "variable" :
								$add_cart = get_permalink();
							break;
							case "grouped" :
								$add_cart = get_permalink();
							break;
							case "external" :
								 $add_cart = get_permalink();
							break;
							default :
								if ( $product->is_purchasable() ) {
									 $add_cart = esc_url( $product->add_to_cart_url() );
								} else {
									 $add_cart = get_permalink();
								}
							break;
						}
						?>
						<a class="add-to-cart add_to_cart_button  product_type_<?php echo esc_attr($product->product_type); ?>"" href="<?php echo esc_url($add_cart); ?>" rel="nofollow" data-product_id="<?php the_ID(); ?>" data-product_sku="<?php echo esc_attr($product->get_sku()); ?>"><?php _e('Add to Cart', 'element'); ?></a>
					</div>
				</div>
			<?php endwhile; endif; ?>
			<?php wp_reset_postdata(); ?>
				
			</div>
		</div>
		<script>
			(function($){
				$(document).ready(function(){
					try {
						var owl = $("#owl-top-rated<?php echo esc_js($countr); ?>");
						owl.owlCarousel({
							items : <?php echo esc_js($atts['items']); ?>,
							itemsDesktop : [1199,4],
							itemsDesktopSmall : [979,3]
						});
						// Custom Navigation Events
						$(".top-rated<?php echo esc_js($countr); ?>-arrows .next-link").click(function(event){
							event.preventDefault();
							owl.trigger('owl.next');
						});
						$(".top-rated<?php echo esc_js($countr); ?>-arrows .prev-link").click(function(event){
							event.preventDefault();
							owl.trigger('owl.prev');
						});
					} catch(err) {

					}
				});
			})(jQuery);
		</script>
	
<?php
	$countr++;
    return ob_get_clean();
	
}
if(function_exists('vc_map')){

	

	vc_map( array(
	   "name" => __("QK Rated Product","element"),
	   "base" => "qk_rated_product",
	   "class" => "",
	   "category" => __("Content", "element"),
	   "icon" => "icon-qk",
	   "params" => array(
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Title","element"),
			 "param_name" => "title",
			 "value" => "Top Rated Products",
			 "description" => ''
		  ),
		  array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Order","element"),
			 "param_name" => "order",
			 "value" => "8",
			 "description" => ''
		  ),array(
			 "type" => "textfield",
			 "holder" => "div",
			 "class" => "",
			 "heading" => __("Product on each Slider","element"),
			 "param_name" => "items",
			 "value" => "6",
			 "description" => ''
		  ),
		   
	   )
	) );
	
}

/************************************
*Team ELEMENT
*************************************/
function shortcode_shopbanner( $atts,  $content = null ) {
    extract( shortcode_atts( array(
	  'image' => '',
	  'name' => '',
	  'link' => '#',
      
   ), $atts ) );
   ob_start(); ?>
   <div class="marketing-post">
		<?php
			$img = wp_get_attachment_image_src($image,'full');
			$img = $img[0];
		?>
		<img src="<?php echo esc_attr($img); ?>" alt="<?php echo esc_html($name); ?>" class="img-responsive">
		<h2><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($name); ?></a></h2>
	</div>
   
<?php
    return ob_get_clean();

}
add_shortcode( 'qk_shop_banner', 'shortcode_shopbanner' );

if(function_exists('vc_map')){

vc_map( array(
   "name" => __("QK Shop Banner","element"),
   "base" => "qk_shop_banner",
   "class" => "",
   "icon" => "icon-qk",
   "category" => __("Content", "element"),
   "params" => array(
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title","element"),
         "param_name" => "name",
         "value" => "New Spring Collection",
         "description" => ''
      ),
	  
     array(
         "type"      => "attach_image",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Banner", 'element'),
         "param_name"=> "image",
         "value"     => "",
         "description" => __("Upload Image Banner", 'element')
      ),
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Link","element"),
         "param_name" => "link",
         "value" => "#",
         "description" => ''
      ),
	  
   )
) );

}

/************************************
*Statistic ELEMENT
*************************************/
function shortcode_skill2( $atts,  $content = null ) {
    extract( shortcode_atts( array(
      
	  'title' => 'Web Design',
	  'level' => '',
	  'btn_text' => 'View All',
	  'color' => '#2c3e50',
	  'image' => '',
	  'effect' => '',
	  'icon' => '',
	  
      
   ), $atts ) );
   
	wp_enqueue_script("appear", get_template_directory_uri()."/js/jquery.appear.js",array(),false,true);
   
   static $counts = 1;
   ob_start(); ?>
   <div class="skills-progress skill<?php echo esc_attr($counts); ?>">
		<p><?php echo esc_html($title); ?> <span><?php echo esc_html($level); ?>%</span></p>
		<div class="meter nostrips develope">
			<p style="width: <?php echo esc_attr($level); ?>%"></p>
		</div>
	</div>
	<script>
		(function($){
		$(document).ready(function(){
			try{
				
				var skillBar = $('.skill<?php echo esc_js($counts); ?>');
				skillBar.appear(function() {

					var animateElement = $(".skill<?php echo esc_js($counts); ?> .meter > p");
					animateElement.each(function() {
						$(this)
							.data("origWidth", $(this).width())
							.width(0)
							.animate({
								width: $(this).data("origWidth")
							}, 1200);
					});

				});
			} catch(err) {
			}
		});
		})(jQuery);
	</script>
<?php
	$counts++; 
    return ob_get_clean();

}
add_shortcode( 'qk_skill2', 'shortcode_skill2' );

if(function_exists('vc_map')){

vc_map( array(
   "name" => __("QK Skill Line","element"),
   "base" => "qk_skill2",
   "class" => "",
   "icon" => "icon-qk",
   "category" => __("Content", "element"),
   "params" => array(
	 array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Title","element"),
         "param_name" => "title",
         "value" => "Illustration",
         "description" => ''
      ),
     
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Level","element"),
         "param_name" => "level",
         "value" => "75",
         "description" => ''
      ),
	 
   )
) );

}
/************
*Map ELEMENT
************/
add_shortcode('qk_map','shortcode_map');
function shortcode_map($atts, $content=null){
	$atts = shortcode_atts(
		array(
		'zoom' => '17',
		'lat' => '51.51152',
		'lon' => '-0.125198',
		'image' => get_template_directory_uri().'/images/marker.png'
	), $atts);

	wp_enqueue_script("map_api", "http://maps.google.com/maps/api/js?sensor=false",array(),false,true);
	wp_enqueue_script("map", get_template_directory_uri()."/js/gmap3.min.js",array(),false,true);
	
 ob_start(); ?>

	<div class="map"></div>
	<?php
	if($atts['image']!=''){
		$img = wp_get_attachment_image_src($atts['image'],'full');
		$img = $img[0];
		}else{
			$img = get_template_directory_uri().'/images/marker.png';
		}
	?>
	<script>
		(function($){
			'use strict';
			$(document).ready(function(){
				
			
				/* ==============================================
				Google Map
				=============================================== */
				var contact = {"lat":"<?php echo  esc_js($atts['lat']); ?>", "lon":"<?php echo esc_js($atts['lon']); ?>"}; //Change a map coordinate here!

				try {
					var mapContainer = $('.map');
					mapContainer.gmap3({
						action: 'addMarker',
						marker:{
							options:{
								icon : new google.maps.MarkerImage('<?php echo esc_js($img); ?>')
							}
						},
						latLng: [contact.lat, contact.lon],
						map:{
							center: [contact.lat, contact.lon],
							zoom: <?php echo  esc_js($atts['zoom']); ?>
							},
						},
						{action: 'setOptions', args:[{scrollwheel:false}]}
					);
				} catch(err) {

				}
				
			
			});
			
		})(jQuery);
	</script>
 
<?php
    return ob_get_clean();

}
if(function_exists('vc_map')){

vc_map( array(
   "name" => __("QK Map","element"),
   "base" => "qk_map",
   "class" => "",
   "icon" => "icon-qk",
   "category" => __("Content", "element"),
   "params" => array(
	
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Latitude","element"),
         "param_name" => "lat",
         "value" => "-33.880641",
         "description" => ''
      ),
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Longitude","element"),
         "param_name" => "lon",
         "value" => "151.204298",
         "description" => ''
      ),
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Map Zooom","element"),
         "param_name" => "zoom",
         "value" => "16",
         "description" => ''
      ),
	  array(
         "type"      => "attach_image",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Map Icon", 'thematico'),
         "param_name"=> "image",
         "value"     => '',
         "description" => __("UploadIcon", 'thematico')
      ),
   )
) );

}


/************************************
*Featured Video
*************************************/
function shortcode_fullcontact( $atts,  $content = null ) {
    extract( shortcode_atts( array(
      'contact_form' => '',
      'info' => '',
      'zoom' => '17',
	'lat' => '51.51152',
		'lon' => '-0.125198',
		'image' => get_template_directory_uri().'/images/marker.png'
   ), $atts ) );
   wp_enqueue_script("map_api", "http://maps.google.com/maps/api/js?sensor=false",array(),false,true);
	wp_enqueue_script("map", get_template_directory_uri()."/js/gmap3.min.js",array(),false,true);
   ob_start(); ?>

<!-- map-section
	================================================== -->
<div id="map-fullscreen" class="map"></div>

<!-- contact-section2
================================================== -->
<div class="section-content contact-section2">
	<div class="contact-information">
		<?php echo rawurldecode(base64_decode(strip_tags($info))); ?>
	</div>
	<?php echo do_shortcode('[contact-form-7 id="'.$contact_form.'"]'); ?>
</div>
<?php
if($atts['image']!=''){
	$img = wp_get_attachment_image_src($atts['image'],'full');
	$img = $img[0];
	}else{
		$img = get_template_directory_uri().'/images/marker.png';
	}
?>
<script>
	(function($){
		'use strict';
		$(document).ready(function(){
			
		
			/* ==============================================
			Google Map
			=============================================== */
			var contact = {"lat":"<?php echo  esc_js($atts['lat']); ?>", "lon":"<?php echo esc_js($atts['lon']); ?>"}; //Change a map coordinate here!

			try {
				var mapContainer = $('.map');
				mapContainer.gmap3({
					action: 'addMarker',
					marker:{
						options:{
							icon : new google.maps.MarkerImage('<?php echo esc_js($img); ?>')
						}
					},
					latLng: [contact.lat, contact.lon],
					map:{
						center: [contact.lat, contact.lon],
						zoom: <?php echo  esc_js($atts['zoom']); ?>
						},
					},
					{action: 'setOptions', args:[{scrollwheel:false}]}
				);
			} catch(err) {

			}
			
		
		});
		
	})(jQuery);
</script>
 
 
<?php
    return ob_get_clean();

}
add_shortcode( 'qk_contact_full', 'shortcode_fullcontact' );

if(function_exists('vc_map')){
$args = array (
		'nopaging' => true,
		'post_type' => 'wpcf7_contact_form',
		'status' => 'publish',
	);
$contacts = get_posts($args);	
$contact_options = array(); $default_contact = '';
foreach ($contacts as $contact) {

//$default_contact = empty($default_sidebar) ? $contact->ID : $default_contact;
$contact_options[$contact->post_title] = $contact->ID;

}
vc_map( array(
   "name" => __("QK Full Map","spring"),
   "base" => "qk_contact_full",
   "class" => "",
   "category" => __("Content", "spring"),
   "icon" => "icon-qk",
   "params" => array(
	 
      
	   array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => __("Select Contact","spring"),
         "param_name" => "contact_form",
         "value" => $contact_options,
         "description" => ''
      ),
	 array(
         "type" => "textarea_raw_html",
         "holder" => "div",
         "class" => "",
         "heading" => __("Info","element"),
         "param_name" => "info",
         "value" => '<h2>Contact Info</h2>
<ul class="information-list">
<li><i class="fa fa-phone"></i><span>+1 703-697-1776</span></li>
<li><i class="fa fa-envelope-o"></i><a href="#">nunforest@gmail.com</a></li>
<li><i class="fa fa-map-marker"></i><span>1400 Defense Pentagon, Arlington County, Virginia, United States</span></li>
</ul>',
         "description" => ''
      ),
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Latitude","element"),
         "param_name" => "lat",
         "value" => "-33.880641",
         "description" => ''
      ),
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Longitude","element"),
         "param_name" => "lon",
         "value" => "151.204298",
         "description" => ''
      ),
	  array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Map Zooom","element"),
         "param_name" => "zoom",
         "value" => "16",
         "description" => ''
      ),
	  array(
         "type"      => "attach_image",
         "holder"    => "div",
         "class"     => "",
         "heading"   => __("Map Icon", 'thematico'),
         "param_name"=> "image",
         "value"     => '',
         "description" => __("UploadIcon", 'thematico')
      ),
	  
   )
) );

}


/************************************
*Blog ELEMENT
*************************************/
add_shortcode('qk_blog','shortcode_blog');
function shortcode_blog($atts, $content=null){
	$atts = shortcode_atts(
		array(
		'order' => '8',
		'id' => '',
		'title' => '',
		'cat' => '',
	), $atts);
	if($atts['cat']!='' and $atts['cat']!='all'){
		$args = array('post_type' => 'post', 'posts_per_page' => $atts['order'], 'category_name'=>$atts['cat']);
	}else{
		$args = array('post_type' => 'post', 'posts_per_page' => $atts['order']);
	}	
	$blog = new WP_Query($args);
 ob_start(); ?>
		<div class="blog-box">

			<?php if($blog->have_posts()) : ?>
				<?php $i=1; while($blog->have_posts()) : $blog->the_post(); ?>
				<?php if($i%3==1 or $i==1){ ?>
				<div class="row">
				<?php } ?>
					<div class="col-md-4">
						<div class="blog-post">
							<div class="blog-gal">
								<?php if(has_post_thumbnail()){
									$img = element_thumbnail_url('');
									$img_url = bfi_thumb($img, array('width'=>370, 'height'=> 280));
								}else{
									$img_url = 'http://placehold.it/370x280';
								}?>
								<img src="<?php echo esc_attr($img_url); ?>" alt="<?php the_title(); ?>">
								<div class="blog-hover">
									<a class="zoom" href="<?php echo esc_attr($img_url); ?>"><i class="fa fa-search"></i></a>
								</div>
							</div>
							<div class="blog-content">
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<ul class="post-tags">
									<li><?php _e('by', 'element'); ?> <?php the_author_posts_link(); ?></li>
									<li><a href="#"><?php the_time('d F Y'); ?></a></li>
									<li><?php the_category(', '); ?></li>
									<li><span class="comment-number"><i class="fa fa-comment-o"></i> <?php comments_popup_link(__(' 0', 'element'), __(' 1 ', 'element'), __(' % ', 'element')); ?></span></li>
								</ul>
								<p><?php echo do_shortcode(element_excerpt($limit = 20)); ?></p>
								
							</div>
						</div>								
					</div>
				<?php if($i%3==0 or $i == $blog->post_count){ ?>		
				</div>
				<?php } ?>
				<?php $i++; endwhile; ?>
				<?php else: ?>
				<div class="not-found">
						<h1><?php _e('Nothing Found Here!','element'); ?></h1>
						<h3><?php _e('Search with other string:', 'element') ?></h3>
						<div class="search-form">
								<?php get_search_form(); ?>
						</div>
				</div>
				<?php endif; ?>

		</div>
		
<?php
    return ob_get_clean();

}
if(function_exists('vc_map')){


$taxonomy     = 'category';
$orderby      = 'name';  
$show_count   = 0;      // 1 for yes, 0 for no
$pad_counts   = 0;      // 1 for yes, 0 for no
$hierarchical = 1;      // 1 for yes, 0 for no  
$title        = '';  
$empty        = 0;

$args = array(
'taxonomy'     => $taxonomy,
'orderby'      => $orderby,
'show_count'   => $show_count,
'pad_counts'   => $pad_counts,
'hierarchical' => $hierarchical,
'title_li'     => $title,
'hide_empty'   => $empty
);

$categories = get_categories( $args );

$category_option = array();
$category_option['All'] = 'all';
foreach ($categories as $category) {

//$default_contact = empty($default_sidebar) ? $contact->ID : $default_contact;
$category_option[$category->name] = $category->slug;

}

vc_map( array(
   "name" => __("QK Blog","element"),
   "base" => "qk_blog",
   "class" => "",
   "category" => __("Content", "element"),
   "icon" => "icon-qk",
   "params" => array(
		
	 
	   array(
         "type" => "dropdown",
         "holder" => "div",
         "class" => "",
         "heading" => __("Select Category","spring"),
         "param_name" => "cat",
         "value" => $category_option,
         "description" => ''
      ),
		array(
         "type" => "textfield",
         "holder" => "div",
         "class" => "",
         "heading" => __("Order","element"),
         "param_name" => "order",
         "value" => "6",
         "description" => ''
      ),
	 
   )
) );

}
?>