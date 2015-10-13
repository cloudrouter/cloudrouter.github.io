<?php get_header(); ?>
<?php global $wp_query, $element_options; ?>
		<!-- content 
			================================================== -->
		<div id="content">
			<?php if(get_post_meta($wp_query->get_queried_object_id(), '_cmb_page_breadcrumb', true)!="yes"){ ?>
			<!-- page-banner-section
				================================================== -->
				<?php 
					$bg = get_post_meta($wp_query->get_queried_object_id(), "_cmb_breadcrumb_bg", false);
				?>
			<div class="section-content page-banner-section" style="background-image: url('<?php print $bg[0];?>');background-size: cover;">
			<?php if($element_options['body_style'] == 'vertical-dark'){ ?>
				<div class="page-banner-box">
			<?php } ?>
					<div class="container">
						<h1><?php single_post_title(); ?></h1>
						<?php //element_breadcrumb(); ?>
					</div>
			<?php if($element_options['body_style'] == 'vertical-dark'){ ?>
				</div>
			<?php } ?>
			</div>
			<?php } ?>
			<?php if($element_options['body_style'] == 'vertical-light' or $element_options['body_style'] == 'vertical-dark'){ ?>
			<div class="content-box">
				
					<div class="container-fluid">
			<?php } ?>
						<!-- blog-section
							================================================== -->
						<div class="section-content blog-section">
						<?php if($element_options['body_style'] != 'vertical-light'){ ?>
						<?php if($element_options['body_style'] != 'vertical-dark'){ ?>
							<div class="container">
						<?php } ?>
						<?php } ?>
								<div class="row">
									<?php
										
										if(get_post_meta($wp_query->get_queried_object_id(), '_cmb_page_fullwidth', true)=="yes"){
											$page_class="col-md-12";
										}else{
											$page_class="col-md-9";
										}
									?>
									<?php 
										if(get_post_meta($wp_query->get_queried_object_id(), '_cmb_page_fullwidth', true)!="yes" and get_post_meta($wp_query->get_queried_object_id(), '_cmb_sidebar_position', true)=="left"){
											$page_class .=' pull-right';
										}
									?>
									<div class="main-page <?php echo esc_attr($page_class); ?>">
									<?php while(have_posts()) : the_post(); ?>
										<?php the_content(); ?>
											<?php
												$defaults = array(
													'before'           => '<div id="page-links"><strong>Page: </strong>',
													'after'            => '</div>',
													'link_before'      => '<span>',
													'link_after'       => '</span>',
													'next_or_number'   => 'number',
													'separator'        => ' ',
													'nextpagelink'     => __( 'Next page','pioneer' ),
													'previouspagelink' => __( 'Previous page','pioneer' ),
													'pagelink'         => '%',
													'echo'             => 1
												);
											 ?>
											<?php wp_link_pages($defaults); ?>
									<?php endwhile; ?>
									</div>
									<?php if(get_post_meta($wp_query->get_queried_object_id(), '_cmb_page_fullwidth', true)!="yes"){ ?>
									<div class="col-md-3">
										 <?php  if(get_post_meta($wp_query->get_queried_object_id(), '_cmb_page_sidebar', true)=="sidebar-shop"){ ?>
											<?php get_sidebar('shop'); ?>
										<?php }else{ ?>
											<?php get_sidebar(); ?>
										<?php } ?>
									</div>
									<?php } ?>
								</div>
							<?php if($element_options['body_style'] != 'vertical-light'){ ?>
							<?php if($element_options['body_style'] != 'vertical-dark'){ ?>
							</div>
							<?php } ?>
							<?php } ?>
						</div>
			<?php if($element_options['body_style'] == 'vertical-light' or $element_options['body_style'] == 'vertical-dark'){ ?>
				</div></div>
			<?php } ?>

		</div>
		<!-- End content -->
<?php get_footer(); ?>