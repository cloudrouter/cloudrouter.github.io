<?php global $element_options; ?>
<!-- Container -->
	<div id="container" class="header3">
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
								<div class="flags-section">
									<?php if (is_active_sidebar('languages')){ ?>
									<?php 
										dynamic_sidebar('languages');
									?>
									<?php }else{ ?>
									<ul class="language-choose">
										<li><a href="#"><img src="<?php echo esc_attr((get_template_directory_uri()); ?>/images/flag/uk.png" alt=""><span>English</span><i class="fa fa-angle-down"></i></a>
											<ul class="drop-languages">
												<li><a href="#"><img src="<?php echo esc_attr((get_template_directory_uri()); ?>/images/flag/usa.png" alt=""><span>English</span></a></li>
												<li><a href="#"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/images/flag/ger.png" alt=""><span>German</span></a></li>
												<li><a href="#"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/images/flag/fra.png" alt=""><span>French</span></a></li>
												<li><a href="#"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/images/flag/ita.png" alt=""><span>Italian</span></a></li>
												<li><a href="#"><img src="<?php echo esc_attr(get_template_directory_uri()); ?>/images/flag/spa.png" alt=""><span>Spanish</span></a></li>
											</ul>
										</li>
									</ul>
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
						<form class="navbar-form navbar-left" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
					        <div class="form-group">
								<input type="text" class="form-control" name="s" placeholder="<?php esc_attr_e( 'Search...', 'element' ); ?>" />
							</div>
							<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
					    </form>
					</div>
				    <div class="right-align">
						<?php if(is_active_sidebar('top-cart')){ ?>
						<?php if (class_exists('Woocommerce')) { ?>
						<?php global $woocommerce;?>
					    <ul>
					    	<li><a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="shopping-button"> <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'element'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?> <i class="fa fa-shopping-cart"></i></a>
								<?php
											
									dynamic_sidebar('top-cart');
								

								?>
							</li>
					    </ul>
						<?php } ?>
						<?php } ?>
				    </div>
				</div>
				<div class="bottom-menu">
					<div class="container">
						<div class="navbar-collapse collapse">
							<?php
							$defaults1= array(
									'theme_location'  => 'primary',
									'menu'            => '',
									'container'       => '',
									'container_class' => '',
									'container_id'    => '',
									'menu_class'      => 'nav navbar-nav navbar-left',
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
				</div>
			</nav>
		</header>
		<!-- End Header -->