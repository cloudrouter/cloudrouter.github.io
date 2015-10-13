
<?php 
global $element_options;
?>
<!-- Container -->
	<div id="container" class="blog-nav">
		<!-- Header
		    ================================================== -->
		<header class="clearfix">
			<!-- Static navbar -->
			<nav class="navbar navbar-default <?php if($element_options!=null && $element_options['body_style'] == 'boxed'){ ?> navbar-static-top<?php }else{ ?> navbar-fixed-top <?php } ?>">
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
				</div>
				<div class="container">
					<div class="navbar-collapse collapse">
						<?php
						$defaults1= array(
								'theme_location'  => 'primary',
								'menu'            => '',
								'container'       => '',
								'container_class' => '',
								'container_id'    => '',
								'menu_class'      => 'nav navbar-nav',
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
			</nav>
		</header>
		<!-- End Header -->