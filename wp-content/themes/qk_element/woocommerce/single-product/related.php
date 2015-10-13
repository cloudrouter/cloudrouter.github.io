<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

$related = $product->get_related( 3 );

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => 3,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = 3;

if ( $products->have_posts() ) : ?>

	<div class="section-content shop-section related">

		<div class="shop-box">
			<h2><?php _e('Related Products', 'element'); ?></h2>

		<?php woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php wc_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>
		</div>
	</div>

<?php endif;

wp_reset_postdata();
