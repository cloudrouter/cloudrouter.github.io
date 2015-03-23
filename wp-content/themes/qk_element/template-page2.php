<?php 
/*
*Template Name: Page Fullscreen2
*/
?>
<?php get_header(); ?>

		<!-- content 
			================================================== -->
		<div id="content">
			<?php if(get_post_meta($wp_query->get_queried_object_id(), '_cmb_page_breadcrumb', true)!="yes"){ ?>
			<!-- page-banner-section
				================================================== -->
			<div class="section-content page-banner-section2">
				<div class="container">
					<div class="row">
						<div class="col-sm-6">
							<h1><?php single_post_title(); ?></h1>
						</div>
						<div class="col-sm-6">
							<?php element_breadcrumb(); ?>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
			<?php 
				while(have_posts()) : the_post();
					the_content(); 
				endwhile;
			?>
			

		</div>
		<!-- End content -->

<?php get_footer(); ?>