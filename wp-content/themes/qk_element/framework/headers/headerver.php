<?php 
global $element_options;
?>
<!-- Container -->
	<div id="container">
		<!-- Header
		    ================================================== -->
		<header class="clearfix">
			<div class="logo">
				<a  href="<?php echo esc_url(home_url()); ?>" title="<?php bloginfo('name'); ?>" >
				<?php if($element_options['logo']['url']!=''){ ?>
					<img src="<?php echo esc_attr($element_options['logo']['url']); ?>" alt="<?php bloginfo('name'); ?>">
				<?php }else{ ?>
					<img alt="<?php bloginfo('name'); ?>" src="<?php echo esc_attr(get_template_directory_uri()); ?>/images/logo.png">
				<?php } ?>
				</a>
			</div>
			
			<a class="elemadded responsive-link" href="#">Menu</a>
			
			<nav class="menu">
				<?php
				$defaults1= array(
						'theme_location'  => 'primary',
						'menu'            => '',
						'container'       => '',
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => '',
						'menu_id'         => '',
						'echo'            => true,
						 'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
						 'walker'            => new wp_bootstrap_navwalker2(),
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
			</nav>
			<div class="social-box">
				<p>We are social</p>
				<ul class="social-list">
					<li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
					<li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
					<li><a class="google" href="#"><i class="fa fa-google-plus"></i></a></li>
					<li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
					<li><a class="pinterest" href="#"><i class="fa fa-pinterest"></i></a></li>
				</ul>
			</div>
			<div class="copyright">
				<span></span>
				<p>&copy; 2014 Nun. All Rights Reserved.</p>
			</div>
		</header>
		<!-- End Header -->