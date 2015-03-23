<?php
/*
*Template Name: Shop List
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
					<h1><?php single_post_title(); ?></h1>
					<?php element_breadcrumb(); ?>
				</div>
			</div>

			<!-- shop-section
				================================================== -->
			<div class="section-content shop-section list-page">
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
				
							<div class="shop-box">

								
								<?php if(is_front_page()) {
								$paged = (get_query_var('page')) ? get_query_var('page') : 1;
								} else {
									$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
								}
								$args = array(
									'post_type' => 'product',
									'paged' => $paged,
									'posts_per_page' => 4,
								);
								$portfolio = new WP_Query($args);
								
								if($portfolio->have_posts()) : while($portfolio->have_posts()) : $portfolio->the_post(); ?>
								<?php 
									
									global $product, $woocommerce_loop, $post;
								?>

								<div class="shop-post">
									<div class="row">
										<div class="<?php if(get_post_meta($wp_query->get_queried_object_id(), '_cmb_page_fullwidth', true)!="yes"){ ?>col-md-4<?php }else{ ?> col-md-3<?php } ?> col-sm-4">
											<div class="shop-gal">
												<a href="<?php the_permalink();?>"><i class="fa fa-list-ul"></i></a>
												<?php if(has_post_thumbnail()){  ?>
												<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
												<?php }else{ ?>
												<img src="http://placehold.it/300x300" alt="<?php the_title(); ?>">
												<?php } ?>
											</div>
										</div>
										<div class="<?php if(get_post_meta($wp_query->get_queried_object_id(), '_cmb_page_fullwidth', true)!="yes"){ ?>col-md-8<?php }else{ ?> col-md-9<?php } ?> col-sm-8">
											<div class="shop-post-content">
												<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
												<?php echo do_shortcode($product->get_price_html()); ?>
												<?php the_excerpt(); ?>
												<?php
													$handler = apply_filters( 'woocommerce_add_to_cart_handler', $product->product_type, $product );
													switch ( $handler ) {
													case "variable" :
														$add_cart = get_permalink();
													break;
													case "grouped" :
														$add_cart = get_permalink();
													break;
													case "external" :
														 $add_cart = get_permalink();
													break;
													default :
														if ( $product->is_purchasable() ) {
															 $add_cart = esc_url( $product->add_to_cart_url() );
														} else {
															 $add_cart = get_permalink();
														}
													break;
												}
												?>
												<a class="add-to-cart add_to_cart_button  product_type_<?php echo esc_attr($product->product_type); ?>"" href="<?php echo esc_url($add_cart); ?>" rel="nofollow" data-product_id="<?php the_ID(); ?>" data-product_sku="<?php echo esc_attr($product->get_sku()); ?>"><?php _e('Add to Cart', 'element'); ?></a>
											</div>
										</div>
									</div>
								</div>
								<?php endwhile; endif; ?>
								
							</div>

							<?php element_pagination($prev = '<i class="fa fa-angle-left"></i>', $next = '<i class="fa fa-angle-right"></i>', $pages=$portfolio->max_num_pages); ?>
							<?php //wp_reset_postdata(); ?>
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
				</div>
			</div>

		</div>
		<!-- End content -->

<?php get_footer(); ?>