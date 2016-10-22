<?php
function wpm_enqueue_styles(){
wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'wpm_enqueue_styles' );


if (function_exists('pll_get_post')){ // is Polylang activated?
    add_filter('woocommerce_get_cart_page_id', 'pll_woocommerce_get_cart_page_id');
    add_filter('woocommerce_get_checkout_page_id', 'pll_woocommerce_get_checkout_page_id');
    function pll_woocommerce_get_cart_page_id($id) {
        return pll_get_post($id); // translate the page to current language
    }
    function pll_woocommerce_get_checkout_page_id($id) {
        return pll_get_post($id); // translate the page to current language
    }
}


//Easy Booking: Availability Check compatibility with Polylang


add_action( 'ebac_order_processed', 'ebac_polylang_compatibility', 10, 3 );

function ebac_polylang_compatibility( $quantity, $keep_stock_id, $booked ) {

    if ( function_exists( 'pll_get_post_translations' ) ) {

        $pll_translations = pll_get_post_translations( $keep_stock_id );

        if ( $pll_translations ) {

            foreach ( $pll_translations as $language => $ID ) {
                if ( $keep_stock_id != $ID ) { 

                    add_post_meta( $ID, '_booking_days', $booked, true ) || update_post_meta( $ID, '_booking_days', $booked );
		            
                }
            }

        }

    }

}

add_filter( 'ebac_booked_products', 'ebac_booked_products_polylang', 10, 1 );

function ebac_booked_products_polylang( $products ) {

    if ( function_exists( 'pll_get_post_translations' ) ) {

        if ( ! empty( $products ) ) foreach ( $products as $product ) {

            $id = $product['product_id'];
            $pll_translations = pll_get_post_translations( $id );

            if ( $pll_translations ) {

                foreach ( $pll_translations as $language => $ID ) {

                    if ( $id != $ID ) {

                        $products[] = array(
                            'product_id' => $ID,
                            'start'      => $product['start'],
                            'end'        => $product['end'],
                            'qty'        => $product['qty']
                        );

                    }

                }

            }

        }

    }

    return $products;
}

add_filter( 'ebac_delete_stock_ids', 'ebac_polylang_delete_stock_ids', 10, 2 );

function ebac_polylang_delete_stock_ids( $ids, $id ) {

    if ( function_exists( 'pll_get_post_translations' ) ) {

        $pll_translations = pll_get_post_translations( $id );

        if ( $pll_translations ) {

            foreach ( $pll_translations as $language => $ID ) {
                if ( $id != $ID ) {
                    $ids[] = $ID;
                }
            }

        }

    }

    return $ids;

}
/**
* Make WooCommerce take into account translated pages.
*/
function pss_translate_woo_pages( $page ) {

return pll_get_post( $page );

}

/**
 * Increase variations products limit.
 */
define( 'WC_MAX_LINKED_VARIATIONS', 150 );

/*
 * Woocommerce product page layout
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 5 );