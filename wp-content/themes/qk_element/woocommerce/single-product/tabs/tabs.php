<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

	<div class="product-tabs">
	<div class="tab-box">
		<ul class="nav nav-tabs" id="myTab">
			<?php $i=1; foreach ( $tabs as $key => $tab ) : ?>

				<li class="<?php echo $key ?>_tab <?php if($i==1){ echo "active"; } ?>">
					<a href="#tab-<?php echo $key ?>" data-toggle="tab"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
				</li>

			<?php $i++; endforeach; ?>
		</ul>
		<div class="tab-content">
		<?php $j=1; foreach ( $tabs as $key => $tab ) : ?>

			<div class="tab-pane <?php if($j==1){ echo "active"; } ?>" id="tab-<?php echo $key ?>">
				<?php call_user_func( $tab['callback'], $key, $tab ) ?>
			</div>

		<?php $j++; endforeach; ?>
		</div>
	</div>
	</div>

<?php endif; ?>