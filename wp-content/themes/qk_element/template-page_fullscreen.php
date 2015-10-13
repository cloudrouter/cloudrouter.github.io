<?php 
/*
*Template Name: Page Fullscreen
*/
?>
<?php get_header(); ?>
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
			<!-- shop-section
				================================================== -->
			<div class="section-content ">
				
					<?php while(have_posts()) : the_post(); 
						the_content(); 
					endwhile;?>
				
			</div>

		</div>
		<!-- End content -->
<?php get_footer(); ?>