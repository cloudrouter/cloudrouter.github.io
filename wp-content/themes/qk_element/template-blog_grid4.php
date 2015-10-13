<?php 
/*
*Template Name: Blog Grid 4
*/
?>
<?php get_header(); ?>
<?php global $wp_query;?>
		<!-- content 
			================================================== -->
		<div id="content">

			<?php if(get_post_meta($wp_query->get_queried_object_id(), '_cmb_page_breadcrumb', true)!="yes"){ ?>
			<!-- page-banner-section
				================================================== -->
			<div class="section-content page-banner-section">
				<div class="container">
					<h1><?php single_post_title(); ?></h1>
					<?php element_breadcrumb(); ?>
				</div>
			</div>
			<?php } ?>

			<!-- blog-section
				================================================== -->
			<div class="section-content blog-section">
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
								'posts_per_page' =>8,
								'paged' => $paged,
							);
							$query = new WP_Query($args);
						?>
						<?php if($query->have_posts()) : ?>
						<?php $i=1; while($query->have_posts()) : $query->the_post(); ?>
						<?php if($i%4==1 or $i==1){ ?>
						<div class="row">
						<?php } ?>
							<div class="col-md-3">
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
									<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									<ul class="post-tags">
										<li><?php _e('by', 'element'); ?> <?php the_author_posts_link(); ?></li>
										<li><a href="#"><?php the_time('d F Y'); ?></a></li>
										<li><?php the_category(', '); ?></li>
									</ul>
									<p><?php echo do_shortcode(element_excerpt($limit = 20)); ?></p>
									<a href="<?php the_permalink(); ?>"><?php _e('Details', 'element'); ?>  <i class="fa fa-angle-right"></i></a>
									<span class="comment-number"><i class="fa fa-comment-o"></i> <?php comments_popup_link(__('0  ', 'element'), __('1 ', 'element'), __(' % ', 'element')); ?></span>
								</div>								
							</div>
						<?php if($i%4==0 or $i == $query->post_count){ ?>		
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

		</div>
		<!-- End content -->
<?php get_footer(); 