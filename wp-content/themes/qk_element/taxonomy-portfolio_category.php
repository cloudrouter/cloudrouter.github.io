<?php 
/*
*Template Name: Portfolio 4Col
*/
?>
<?php get_header(); ?>

		<!-- content 
			================================================== -->
		<div id="content">

			<!-- page-banner-section
				================================================== -->
			<div class="section-content page-banner-section">
				<div class="container">
					<h1><?php _e('Portfolio','element'); ?></h1>
				</div>
			</div>

			<!-- portfolio-page
				================================================== -->
			<div class="section-content portfolio-page standart">
				<div class="container">
					
					<div class="portfolio-box masonry col-4">
						<?php 
								if(have_posts()) : while(have_posts()) : the_post(); ?>
							<?php
								$item_classes = '';
								$item_skill = '';
								$item_cats = get_the_terms(get_the_ID(), 'portfolio_category');
								foreach((array)$item_cats as $item_cat){
									if(count($item_cat)>0){
										$item_classes .= $item_cat->slug . ' ';
										$item_skill .= $item_cat->name . ' | ';
									}
								}
							?>
							<?php
								$img = element_thumbnail_url('');
							?>
							<div class="work-post <?php echo esc_attr($item_classes); ?>">
									<img src="<?php echo bfi_thumb($img, array('width'=>450, 'height'=> 353)); ?>" alt="<?php the_title(); ?>">
									<div class="hover-box">
										<div class="inner-hover">
											<h2><?php the_title(); ?></h2>
											<p><?php the_time('d F Y'); ?></p>
											<a class="link" href="<?php the_permalink(); ?>"><i class="fa fa-search"></i></a>
											<a class="zoom" href="<?php echo esc_attr($img); ?>"><i class="fa fa-picture-o"></i></a>
										</div>						
									</div>
								</div>
							<?php endwhile; endif; ?>
					</div>

					<?php element_pagination($prev = '<i class="fa fa-angle-left"></i>', $next = '<i class="fa fa-angle-right"></i>', $pages=''); ?>

				</div>
			</div>

		</div>
		<!-- End content -->
<?php get_footer(); ?>