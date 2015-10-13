<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>
<?php
$columns = 12/$woocommerce_loop['columns'];
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ){
	$columns .=' first';
}
?>
<div <?php post_class( 'col-md-'.$columns); ?>>
	<div class="shop-post">
		<div class="shop-gal">
			<a href="<?php the_permalink(); ?>"><i class="fa fa-list-ul"></i></a>
			<?php if(has_post_thumbnail()){  ?>
			<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
			<?php }else{ ?>
			<img src="http://placehold.it/300x300" alt="<?php the_title(); ?>">
			<?php } ?>
		</div>
		<h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
		<div><?php echo do_shortcode($product->get_price_html()); ?></div>
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
