<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<div class="shoping-drop">
	<div class="items-area">
		<p><?php _e('Recently added items', 'element'); ?></p>
		<ul>
			<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

			<?php
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

						$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
						$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
						$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

						?>
						<li>
							<?php echo do_shortcode($thumbnail); ?>
							<div class="items-cont">
								<h2><?php echo esc_html($product_name); ?><a href="#">x</a><a href="#"><i class="fa fa-pencil"></i></a></h2>
								<p> <?php echo esc_attr($cart_item['quantity']); ?> X - <span><?php echo do_shortcode($product_price); ?></span></p>
							</div>
						</li>
						
						<?php
					}
				}
			?>

		<?php else : ?>

			<li class="empty"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></li>

		<?php endif; ?>
			
		</ul>
	</div>
	<div class="total-price">
		<p><?php _e('Total', 'element'); ?> <?php echo esc_html(WC()->cart->get_cart_subtotal()); ?></p>
	</div>
	<div class="continue-shop">
		<a href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>" ><?php _e( 'View Cart', 'woocommerce' ); ?></a>
		<a href="<?php echo esc_url(WC()->cart->get_checkout_url()); ?>" ><?php _e( 'Checkout', 'woocommerce' ); ?></a>
	</div>
</div>


<?php do_action( 'woocommerce_after_mini_cart' ); ?>
