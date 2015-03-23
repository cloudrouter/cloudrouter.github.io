<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<?php 
global $element_options, $woocommerce; 
global $wp_query;
    $seo_title = get_post_meta($wp_query->get_queried_object_id(), "_cmb_seo_title", true);
    $seo_description = get_post_meta($wp_query->get_queried_object_id(), "_cmb_seo_description", true);
    $seo_keywords = get_post_meta($wp_query->get_queried_object_id(), "_cmb_seo_keywords", true);
?>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="author" content="qktheme">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- For SEO -->
	<?php if($seo_description!="") { ?>
	<meta name="description" content="<?php echo esc_attr($seo_description); ?>">
	<?php }elseif($element_options['seo_des']!=''){ ?>
	<meta name="description" content="<?php echo esc_attr($element_options['seo_des']); ?>">
	<?php } ?>
	<?php if($seo_keywords!="") { ?>
	<meta name="keywords" content="<?php echo esc_attr($seo_keywords); ?>">
	<?php }elseif($element_options['seo_key']!=''){ ?>
	<meta name="keywords" content="<?php echo esc_attr( $element_options['seo_key']); ?>">
	<?php } ?>
	<!-- End SEO-->
	<?php if($element_options['favicon']['url']!=''){ ?>
	<link rel="icon" href="<?php echo esc_url($element_options['favicon']['url']); ?>" type="image/x-icon">
	<?php } ?>
	<?php if($element_options['apple_icon']['url']!=''){ ?>
	<link rel="apple-touch-icon" href="<?php echo esc_url($element_options['apple_icon']['url']); ?>" />
	<?php } ?>
	<?php if($element_options['apple_icon_57']['url']!=''){ ?>
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo esc_url($element_options['apple_icon_57']['url']); ?>">
	<?php } ?>
	<?php if($element_options['apple_icon_72']['url']!=''){ ?>
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url($element_options['apple_icon_72']['url']); ?>">
	<?php } ?>
	<?php if($element_options['apple_icon_114']['url']!=''){ ?>
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url($element_options['apple_icon_114']['url']); ?>">
	<?php } ?>
	<?php 
	// Google analytics
    echo esc_html($element_options['google_analytics']);
	?>
<!-- dfj removed outdated
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

 // Old UA, dfj removing ga('create', 'UA-58616991-1', 'auto');
  ga('create', 'UA-59923891-1', 'auto');
  ga('send', 'pageview');

</script> -->

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-59923891-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<?php if($element_options['body_style'] != 'vertical-light'){ ?>
	<?php if($element_options['body_style'] != 'vertical-dark'){ ?>
	<div class="preloader">
		<h2><img src="https://cloudrouter.org/wp-content/themes/qk_element/images/CloudRouter-Small-Transparent.png" alt="CloudRouter">
			<?php if($element_options['loading']['url']!=''){ ?>
				<img src="https://cloudrouter.org/wp-content/themes/qk_element/images/loader.gif" alt="<?php bloginfo('name'); ?>">
			<?php }else{ ?>
			<img alt="" src="https://cloudrouter.org/wp-content/themes/qk_element/images/loader.gif">
			<?php } ?>
		</h2>
	</div>
	<?php } ?>
	<?php }elseif($element_options==null){ ?>
		<div class="preloader">
			<h2><img src="https://cloudrouter.org/wp-content/themes/qk_element/images/CloudRouter-Small-Transparent.png" alt="CloudRouter">
				<?php if($element_options['loading']['url']!=''){ ?>
					<img src="https://cloudrouter.org/wp-content/themes/qk_element/images/loader.gif" alt="<?php bloginfo('name'); ?>">
				<?php }else{ ?>
				<img alt="" src="https://cloudrouter.org/wp-content/themes/qk_element/images/loader.gif">
				<?php } ?>
			</h2>
		</div>
	<?php } ?>
	<?php 
	if(is_page('home-blog')){
		get_template_part('framework/headers/header5');
	}elseif(is_page('header-2')){
		get_template_part('framework/headers/header2');
	}elseif(is_page('header-3')){
		get_template_part('framework/headers/header3');
	}elseif(is_page('header-4')){
		get_template_part('framework/headers/header4');
	}elseif($element_options!=null && $element_options['body_style'] == 'vertical-light'){
		get_template_part('framework/headers/headerver');
	}elseif($element_options!=null && $element_options['body_style'] == 'vertical-dark'){
		get_template_part('framework/headers/headerver');
	}elseif($element_options!=null && $element_options['body_style'] == 'one-page'){
		get_template_part('framework/headers/headerone');
	}elseif(isset($element_options['header_layout']) and $element_options['header_layout']=="header2" ){
		get_template_part('framework/headers/header2');
	}elseif(isset($element_options['header_layout']) and $element_options['header_layout']=="header3" ){
		get_template_part('framework/headers/header3');
	}elseif(isset($element_options['header_layout']) and $element_options['header_layout']=="header4" ){
		get_template_part('framework/headers/header4');
	}elseif(isset($element_options['header_layout']) and $element_options['header_layout']=="header5" ){
		get_template_part('framework/headers/header5');
	}else{
	?>
	<!-- Container -->
	<div id="container">
		
		<!-- Header
		    ================================================== -->
		<header class="clearfix">
			<!-- Static navbar -->
			<nav class="navbar navbar-default <?php if($element_options!=null && $element_options['body_style'] == 'boxed'){ ?> navbar-static-top<?php }else{ ?> navbar-fixed-top <?php } ?>">

				<div class="header-top-line">
					<div class="container">
						<div class="row">
							<div class="col-md-6 col-sm-7">
								<?php echo do_shortcode($element_options['header-info']); ?>
							</div>
							<div class="col-md-6 col-sm-5">
								<div class="right-align">
								<?php if(is_active_sidebar('top-cart')){ ?>
								<?php if (class_exists('Woocommerce')) { ?>
									<ul>
										<li><a href="#" class="shopping-button"><i class="fa fa-shopping-cart"></i> Your Cart</a>
											<?php
											
												dynamic_sidebar('top-cart');
											

											?>
											
										</li>
									</ul>	
								<?php } ?>
								<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>	
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="<?php echo esc_url(home_url()); ?>" title="<?php bloginfo('name'); ?>" >
						<?php if($element_options['logo']['url']!=''){ ?>
							<img src="<?php echo esc_attr($element_options['logo']['url']); ?>" alt="<?php bloginfo('name'); ?>">
						<?php }else{ ?>
							<img alt="<?php bloginfo('name'); ?>" src="<?php echo esc_attr(get_template_directory_uri()); ?>/images/logo.png">
						<?php } ?>
						</a>
					</div>
					<div class="navbar-collapse collapse">
						<?php
						$defaults1= array(
								'theme_location'  => 'primary',
								'menu'            => '',
								'container'       => '',
								'container_class' => '',
								'container_id'    => '',
								'menu_class'      => 'nav navbar-nav navbar-right',
								'menu_id'         => '',
								'echo'            => true,
								 'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
								 'walker'            => new wp_bootstrap_navwalker(),
								'before'          => '',
								'after'           => '',
								'link_before'     => '',
								'link_after'      => '',
								'items_wrap'      => '<ul data-breakpoint="800" id="%1$s" class="%2$s">%3$s</ul>',
								'depth'           => 0,
							);
							if ( has_nav_menu( 'primary' ) ) {
								wp_nav_menu( $defaults1 );
							}
						?>
						
					</div>
				</div>

				<div class="left-tag-line">
					Router Distribution for the Cloud
				</div>
				<div class="right-tag-line">
					An Open Source Community Project
				</div>
			</nav>
		</header>
		<!-- End Header -->
<?php } ?>



