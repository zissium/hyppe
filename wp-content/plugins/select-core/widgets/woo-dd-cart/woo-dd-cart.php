<?php

class MixtapeQodeWoocommerceDropdownCart extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'qodef_woocommerce_dropdown_cart', // Base ID
			esc_html__( 'Select Woocommerce Dropdown Cart', 'mixtapewp' ), // Name
			array( 'description' => esc_html__( 'Select Woocommerce Dropdown Cart', 'mixtapewp' ), ) // Args
		);
	}

	public function widget( $args, $instance ) {
		global $post;
		extract( $args );

		global $woocommerce;

		$cart_style = 'qodef-with-icon';
		?>

        <div class="qodef-shopping-cart-outer">
            <div class="qodef-shopping-cart-inner">
                <div class="qodef-shopping-cart-header">
                    <a class="qodef-header-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="qodef-cart-amount"><?php echo esc_html( $woocommerce->cart->get_cart_contents_count() ); ?></span>
                    </a>

                    <div class="qodef-shopping-cart-dropdown">
						<?php
						$cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;
						$list_class    = array( 'qodef-cart-list', 'product_list_widget' );
						?>
                        <ul>

							<?php if ( ! $cart_is_empty ) : ?>

							<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :

								$_product = $cart_item['data'];

								// Only display if allowed
								if ( ! $_product->exists() || $cart_item['quantity'] == 0 ) {
									continue;
								}

								// Get price
								$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? wc_get_price_excluding_tax( $_product ) : wc_get_price_including_tax( $_product );
								?>


                                <li>
                                    <div class="qodef-item-image-holder">
                                        <a href="<?php echo esc_url( get_permalink( $cart_item['product_id'] ) ); ?>">
											<?php echo wp_kses( $_product->get_image(), array(
												'img' => array(
													'src'    => true,
													'width'  => true,
													'height' => true,
													'class'  => true,
													'alt'    => true,
													'title'  => true,
													'id'     => true
												)
											) ); ?>
                                        </a>
                                    </div>
                                    <div class="qodef-item-info-holder">
                                        <div class="qodef-item-left">
                                            <a href="<?php echo esc_url( get_permalink( $cart_item['product_id'] ) ); ?>">
												<?php echo apply_filters( 'woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?>
                                            </a>
                                            <span class="qodef-quantity"><?php echo esc_html( $cart_item['quantity'] ); ?></span>
                                            <span>x</span>
											<?php echo apply_filters( 'woocommerce_cart_item_price_html', wc_price( $product_price ), $cart_item, $cart_item_key ); ?>
                                        </div>
                                        <div class="qodef-item-right">
											<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s">&times;</a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_attr__( 'Remove this item', 'mixtapewp' ) ), $cart_item_key ); ?>

                                        </div>
                                    </div>
                                </li>

							<?php endforeach; ?>
                        </ul>
                        <div class="qodef-cart-bottom">
                            <div class="qodef-subtotal-holder clearfix">
                                <span class="qodef-total"><?php esc_html_e( 'Subtotal', 'mixtapewp' ); ?>:</span>
                                <span class="qodef-total-amount">
											<?php echo wp_kses( $woocommerce->cart->get_cart_subtotal(), array(
												'span' => array(
													'class' => true,
													'id'    => true
												)
											) ); ?>
										</span>
                            </div>
                            <div class="qodef-btns-holder clearfix">
                                <a href="<?php echo esc_url( wc_get_cart_url() ); ?>"
                                        class="qodef-btn qodef-btn-outline qodef-btn-light view-cart">
									<?php esc_html_e( 'view cart', 'mixtapewp' ); ?>
                                </a>
                                <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>"
                                        class="qodef-btn qodef-btn-outline qodef-btn-light checkout">
									<?php esc_html_e( 'checkout', 'mixtapewp' ); ?>
                                </a>
                            </div>
                        </div>
					<?php else : ?>

                        <li class="qodef-empty-cart"><?php esc_html_e( 'No products in the cart.', 'mixtapewp' ); ?></li>
                        </ul>

					<?php endif; ?>

						<?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>

						<?php endif; ?>


						<?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>

						<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}

}

add_filter( 'woocommerce_add_to_cart_fragments', 'mixtape_qodef_woocommerce_header_add_to_cart_fragment' );

function mixtape_qodef_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	?>

    <div class="qodef-shopping-cart-header">
        <a class="qodef-header-cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
            <i class="fa fa-shopping-cart"></i>
            <span class="qodef-cart-amount"><?php echo esc_html( $woocommerce->cart->get_cart_contents_count() ); ?></span>
        </a>

        <div class="qodef-shopping-cart-dropdown">
			<?php
			$cart_is_empty = sizeof( $woocommerce->cart->get_cart() ) <= 0;
			//$list_class = array( 'qodef-cart-list', 'product_list_widget' );
			?>
            <ul>

				<?php if ( ! $cart_is_empty ) : ?>
				<?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :

					$_product = $cart_item['data'];

					// Only display if allowed
					if ( ! $_product->exists() || $cart_item['quantity'] == 0 ) {
						continue;
					}

					// Get price
					$product_price = get_option( 'woocommerce_tax_display_cart' ) == 'excl' ? wc_get_price_excluding_tax( $_product ) : wc_get_price_including_tax( $_product );
					?>

                    <li>
                        <div class="qodef-item-image-holder">
							<?php echo wp_kses( $_product->get_image(), array(
								'img' => array(
									'src'    => true,
									'width'  => true,
									'height' => true,
									'class'  => true,
									'alt'    => true,
									'title'  => true,
									'id'     => true
								)
							) ); ?>
                        </div>
                        <div class="qodef-item-info-holder">
                            <div class="qodef-item-left">
                                <a href="<?php echo esc_url( get_permalink( $cart_item['product_id'] ) ); ?>">
									<?php echo apply_filters( 'woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?>
                                </a>
                                <span
                                        class="qodef-quantity"><?php echo esc_html( $cart_item['quantity'] ); ?></span>
                                <span>x</span>
								<?php echo apply_filters( 'woocommerce_cart_item_price_html', wc_price( $product_price ), $cart_item, $cart_item_key ); ?>
                            </div>
                            <div class="qodef-item-right">
								<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s">&times;</a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_attr__( 'Remove this item', 'mixtapewp' ) ), $cart_item_key ); ?>

                            </div>
                        </div>
                    </li>

				<?php endforeach; ?>
            </ul>
            <div class="qodef-cart-bottom">
                <div class="qodef-subtotal-holder clearfix">
                    <span class="qodef-total"><?php esc_html_e( 'Subtotal', 'mixtapewp' ); ?>:</span>
                    <span class="qodef-total-amount">
									<?php echo wp_kses( $woocommerce->cart->get_cart_subtotal(), array(
										'span' => array(
											'class' => true,
											'id'    => true
										)
									) ); ?>
								</span>
                </div>
                <div class="qodef-btns-holder clearfix">
                    <a href="<?php echo esc_url( wc_get_cart_url() ); ?>"
                            class="qodef-btn qodef-btn-outline qodef-btn-light view-cart">
						<?php esc_html_e( 'view cart', 'mixtapewp' ); ?>
                    </a>
                    <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>"
                            class="qodef-btn qodef-btn-outline qodef-btn-light checkout">
						<?php esc_html_e( 'checkout', 'mixtapewp' ); ?>
                    </a>
                </div>
            </div>
		<?php else : ?>

            <li class="qodef-empty-cart"><?php esc_html_e( 'No products in the cart.', 'mixtapewp' ); ?></li>
            </ul>

		<?php endif; ?>
			<?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>

			<?php endif; ?>


			<?php if ( sizeof( $woocommerce->cart->get_cart() ) <= 0 ) : ?>

			<?php endif; ?>
        </div>
    </div>

	<?php
	$fragments['div.qodef-shopping-cart-header'] = ob_get_clean();

	return $fragments;
}

?>