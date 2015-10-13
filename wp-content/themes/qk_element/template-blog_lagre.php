<?php
/*
*Template Name: Blog Large
*/
?>
<?php get_header(); ?>
<?php global $wp_query, $element_options;?>
		<!-- content 
			================================================== -->
		<div id="content">

			<?php if(get_post_meta($wp_query->get_queried_object_id(), '_cmb_page_breadcrumb', true)!="yes"){ ?>
			<!-- page-banner-section
				================================================== -->
			<div class="section-content page-banner-section">
				<?php if($element_options['body_style'] == 'vertical-dark'){ ?>
					<div class="page-banner-box">
				<?php } ?>
						<div class="container">
							<h1><?php single_post_title(); ?></h1>
							<?php element_breadcrumb(); ?>
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
			<div class="section-content blog-section blog-large">
				<div class="container">
					<div class="row">
						
						<?php
							global $wp_query; 
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
							<div class="blog-box">
							<?php 
								if(is_front_page()) {
									$paged = (get_query_var('page')) ? get_query_var('page') : 1;
								} else {
									$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
								}
								$args = array(
									'post_type' => 'post',
									'posts_per_page' =>4,
									'paged' => $paged,
								);
								$query = new WP_Query($args);
							?>
							<?php if($query->have_posts()) : ?>
							<?php $i=1; while($query->have_posts()) : $query->the_post(); ?>
							<?php get_template_part( 'contentl', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) ); ?>

							<?php endwhile; ?>
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
							<?php element_pagination($prev = '<i class="fa fa-angle-left"></i>', $next = '<i class="fa fa-angle-right"></i>', $pages=$query->max_num_pages); ?>
							
						</div>
						<?php if(get_post_meta($wp_query->get_queried_object_id(), '_cmb_page_fullwidth', true)!="yes"){ ?>
						<div class="col-md-3">
							<?php get_sidebar(); ?>
						</div>
						<?php } ?>

					</div>
				</div>
			</div>
			<?php if($element_options['body_style'] == 'vertical-light' or $element_options['body_style'] == 'vertical-dark'){ ?>
				</div></div>
			<?php } ?>
		</div>
		<!-- End content -->
<?php get_footer(); ?>