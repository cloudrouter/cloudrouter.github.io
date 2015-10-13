<?php get_header(); ?>
<?php global $wp_query,$element_options; ?>
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
							<h1><?php woocommerce_page_title(); ?></h1>
							<?php woocommerce_breadcrumb($delimiter=">"); ?>
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
			<!-- shop-section
				================================================== -->
			<div class="section-content shop-section fullwidth">
				<div class="container">
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
							

								<?php
									if ( is_singular( 'product' ) ) {
										woocommerce_content();
									  }else{
									   //For ANY product archive.
									   //Product taxonomy, product search or /shop landing
										woocommerce_get_template( 'archive-product.php' );
									  }
								?>

							
						</div>
						
						<?php if(get_post_meta($wp_query->get_queried_object_id(), '_cmb_page_fullwidth', true)!="yes"){ ?>
						<div class="col-md-3">
							<?php get_sidebar('shop'); ?>
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