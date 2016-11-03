<div class="right-column">
	<div class="cart-sidebar">
		<?php
		if ( ! defined( 'ABSPATH' ) ) {
			exit; // Exit if accessed directly
		}

		?>

		<?php do_action( 'woocommerce_before_mini_cart' ); ?>

		<div class="cart-picto">
			<div class="slidemenu-control">
				<?php echo $items_number = WC()->cart->get_cart_contents_count(); ?>
			</div>
		</div>



		<div class="slidemenu-menu cart_list_container">
				<div class="cart_list product_list_widget <?php echo $args['list_class']; ?>">

					<?php if ( ! WC()->cart->is_empty() ) : ?>

						<table class="cart-table">
							<tbody>

							<?php
							foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
								$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
								$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

								if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
									$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
									$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
									$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
									$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
									?>
									<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
											<td class="table-remove">
											<?php if ( ! $_product->is_visible() ) : ?>
												<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . $product_name . '&nbsp;'; ?>
											<?php else : ?>
												<?php
												echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
													'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
													esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
													__( 'Remove this item', 'woocommerce' ),
													esc_attr( $product_id ),
													esc_attr( $_product->get_sku() )
												), $cart_item_key );
												?>
											</td>
											<td class="table-image-thumbnail">
												<a href="<?php echo esc_url( $product_permalink ); ?>">
													<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . '&nbsp;'; ?>
												</a>
											</td>
											<td class="table-name">
												<a href="<?php echo esc_url( $product_permalink ); ?>">
													<?php echo $product_name?>
												</a>
												<?php echo WC()->cart->get_item_data( $cart_item ); ?>
											</td>
										<?php endif; ?>
										<td class="table-price">
											<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
										</td>
									</tr>
									<?php
								}
							}
							?>

						</tbody>
					</table>
					<?php else : ?>

						<p class="empty"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></p>

					<?php endif; ?>

					<?php if ( ! WC()->cart->is_empty() ) : ?>
						<div
						<p class="total"><strong><?php _e( 'Subtotal', 'woocommerce' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

						<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

						<div class="buttons">
							<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button wc-forward"><?php _e( 'View Cart', 'woocommerce' ); ?></a>
							<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button checkout wc-forward"><?php _e( 'Checkout', 'woocommerce' ); ?></a>
							<span class="align-right"><img src="<?php echo get_stylesheet_directory_uri() ?>/images/paypal-icon.svg" /><img src="<?php echo get_stylesheet_directory_uri() ?>/images/cb-icon.svg"></span>
						</div>

					<?php endif; ?>

					<?php do_action( 'woocommerce_after_mini_cart' ); ?>
				</div>
		</div>
	</div><!-- cart-sidebar -->

	<script type="text/javascript">
		jQuery('.cart-sidebar').slideMenu("right");
	</script>
</div>
