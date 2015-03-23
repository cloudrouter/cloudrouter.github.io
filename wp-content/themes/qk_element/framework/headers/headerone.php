<?php 
global $element_options;
?>


<!-- Container -->
	<div id="container" class="header2">
		<?php $banner_type= $element_options['banner_type']; ?>
		<!-- slider 
			================================================== -->
		<div id="slider" class="slider1" <?php if($banner_type=='slider'){ ?> style="background: url('<?php echo esc_attr($element_options['banner_bg']['url']); ?>') fixed; " <?php }else{ ?> style="background: none !important;"<?php } ?>>
			<?php if($element_options['banner_type']=='video'){ ?>
				<!-- video background tags -->
				<div id="customElement"></div>
			<?php } ?>
			<div class="flexslider">
				<ul class="slides">
					<?php
						$args = array('post_type' => 'qk_slide', 'posts_per_page' => -1);
						$flexslider = new WP_Query($args);
					?>
					<?php while($flexslider->have_posts()) : $flexslider->the_post();  ?>
					<li>
						<div class="container">
							<?php the_content(); ?>
						</div>
					</li>
					<?php endwhile; ?>
				</ul>
			</div>
		<?php if($element_options['banner_type']=='video'){ ?>
			<a id="video" class="player" data-property="{videoURL:'<?php echo esc_attr($element_options['videoID']); ?>',containment:'#customElement', showControls:false, autoPlay:true, loop:true, mute:true, startAt:0, opacity:1, addRaster:false, quality:'default'}">My video</a> <!--BsekcY04xvQ-->
			<!-- end video background tags -->
		<?php } ?>
		</div>
		<!-- End slider -->

		<!-- Header
		    ================================================== -->
		<header class="clearfix">
			<!-- Static navbar -->
			<nav class="navbar navbar-default navbar-static-top">	
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand"href="<?php echo esc_url(home_url()); ?>" title="<?php bloginfo('name'); ?>" >
						<?php if($element_options['logo']['url']!=''){ ?>
							<img src="<?php echo esc_attr($element_options['logo']['url']); ?>" alt="<?php bloginfo('name'); ?>">
						<?php }else{ ?>
							<img alt="<?php bloginfo('name'); ?>" src="<?php echo esc_attr(get_template_directory_uri()); ?>/images/logo.png">
						<?php } ?>
						</a>
					</div>
					<div class="navbar-collapse collapse">	
						
						<?php
							if(is_page_template('template-home.php') or !has_nav_menu( 'primary' )){
								$defaults1= array(
										'theme_location'  => 'one_page',
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
										'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
										'depth'           => 0,
									);
									if ( has_nav_menu( 'one_page' ) ) {
										wp_nav_menu( $defaults1 );
									}
							}else{

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
							}
							?>
					</div>
				</div>
			</nav>
		</header>
		<!-- End Header -->