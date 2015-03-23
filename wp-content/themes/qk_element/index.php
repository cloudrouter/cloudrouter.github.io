<?php get_header(); ?>
<?php global $element_options; ?>
		<!-- content 
			================================================== -->
		<div id="content">

			<!-- page-banner-section
				================================================== -->
			<div class="section-content page-banner-section">
				<div class="container">
					<h1>Blog Standard</h1>
					<?php element_breadcrumb(); ?>
				</div>
			</div>
			<?php if($element_options['body_style'] == 'vertical-light' or $element_options['body_style'] == 'vertical-dark'){ ?>
			<div class="content-box">
				
					<div class="container-fluid">
			<?php } ?>
			<!-- blog-section
				================================================== -->
			<div class="section-content blog-section blog-standard">
			<?php if($element_options['body_style'] != 'vertical-light'){ ?>
				<div class="container">
			<?php } ?>
					<div class="row">
						
						<div class="col-md-9">
							<div class="blog-box">
							<?php 
							if(have_posts()) :
											while(have_posts()) : the_post(); 
							?>
							<?php get_template_part( 'content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) ); ?>

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
							 <?php element_pagination($prev = '<i class="fa fa-angle-left"></i>', $next = '<i class="fa fa-angle-right"></i>', $pages=''); ?>
							
						</div>

						<div class="col-md-3">
							<?php get_sidebar(); ?>
						</div>

					</div>
				<?php if($element_options['body_style'] != 'vertical-light'){ ?>
				</div>
				<?php } ?>
			</div>
		<?php if($element_options['body_style'] == 'vertical-light' or $element_options['body_style'] == 'vertical-dark'){ ?>
				</div></div>
			<?php } ?>
		</div>
		<!-- End content -->

<?php get_footer(); ?>