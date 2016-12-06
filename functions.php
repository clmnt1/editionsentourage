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

/*
 * Woocommerce product additionnal information
 */
// Remove default tabs
remove_filter( 'woocommerce_product_tabs', 'woocommerce_default_product_tabs' );

// Add additional text product
function ee_additional_product_tab_content() {
    wc_get_template('single-product/tabs/additional-tab.php');
}
add_filter('woocommerce_product_tabs', 'ee_additional_product_tab_content');

function ee_add_additional_field_data() {
    woocommerce_wp_textarea_input(
        array(
            'id' => 'additional_textarea',
            'label' => __('Texte additionel', 'ee'),
            'class' => 'additional-field',
            'placeholder' => __('Entrez ici votre texte', 'ee'),
        )
    );
}
add_action('woocommerce_product_options_advanced', 'ee_add_additional_field_data');

function ee_save_additional_product_fields($product_id, $post, $update) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if ($post->post_type == 'product') {
        if (isset($_POST['additional_textarea'])) {
            $additional = $_POST['additional_textarea'];
            update_post_meta($product_id, 'additional_textarea', $additional);
        }
    }
}
add_action('save_post', 'ee_save_additional_product_fields', 10, 3);

// Add materials product
function ee_materials_product_tab_content() {
    wc_get_template('single-product/tabs/material-tab.php');
}
add_filter('woocommerce_product_tabs', 'ee_materials_product_tab_content');

function ee_add_material_field_data() {
    woocommerce_wp_textarea_input(
        array(
            'id' => 'material_textarea',
            'label' => __('Matériaux', 'ee'),
            'class' => 'material-field',
            'placeholder' => __('Liste des matériaux', 'ee'),
        )
    );
}
add_action('woocommerce_product_options_advanced', 'ee_add_material_field_data');

function ee_save_materials_product_fields($product_id, $post, $update) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if ($post->post_type == 'product') {
        if (isset($_POST['material_textarea'])) {
            $material = $_POST['material_textarea'];
            update_post_meta($product_id, 'material_textarea', $material);
        }
    }
}
add_action('save_post', 'ee_save_materials_product_fields', 10, 3);

// Add size product
function ee_size_product_tab_content() {
    wc_get_template('single-product/tabs/size-tab.php');
}
add_filter('woocommerce_product_tabs', 'ee_size_product_tab_content');

function ee_add_size_field_data() {
    woocommerce_wp_text_input(
        array(
            'id' => 'height_text',
            'label' => __('Hauteur', 'ee'),
            'class' => 'height-field',
            'placeholder' => __("Hauteur de l'objet", 'ee'),
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => 'width_text',
            'label' => __('Largeur', 'ee'),
            'class' => 'width-field',
            'placeholder' => __("Largeur de l'objet", 'ee'),
        )
    );
    woocommerce_wp_text_input(
        array(
            'id' => 'depth_text',
            'label' => __('Profondeur', 'ee'),
            'class' => 'depth-field',
            'placeholder' => __("Profondeur de l'objet", 'ee'),
        )
    );
}
add_action('woocommerce_product_options_advanced', 'ee_add_size_field_data');

function ee_save_size_product_fields($product_id, $post, $update) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if ($post->post_type == 'product') {
        if (isset($_POST['height_text'])) {
            $heightText = $_POST['height_text'];
            update_post_meta($product_id, 'height_text', $heightText);
        }
        if (isset($_POST['width_text'])) {
            $widthText = $_POST['width_text'];
            update_post_meta($product_id, 'width_text', $widthText);
        }
        if (isset($_POST['depth_text'])) {
            $depthText = $_POST['depth_text'];
            update_post_meta($product_id, 'depth_text', $depthText);
        }
    }
}
add_action('save_post', 'ee_save_size_product_fields', 10, 3);

// Add price details product
function ee_pricedetails_product_tab_content() {
    wc_get_template('single-product/tabs/pricedetails-tab.php');
}
add_filter('woocommerce_product_tabs', 'ee_pricedetails_product_tab_content');

function ee_add_pricedetails_field_data() {
    woocommerce_wp_textarea_input(
        array(
            'id' => 'pricedetails_textarea',
            'label' => __('Détail du prix', 'ee'),
            'class' => 'pricedetails-field',
            'placeholder' => __('Détail', 'ee'),
        )
    );
}
add_action('woocommerce_product_options_advanced', 'ee_add_pricedetails_field_data');

function ee_save_pricedetails_product_fields($product_id, $post, $update) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if ($post->post_type == 'product') {
        if (isset($_POST['pricedetails_textarea'])) {
            $pricedetails = $_POST['pricedetails_textarea'];
            update_post_meta($product_id, 'pricedetails_textarea', $pricedetails);
        }
    }
}
add_action('save_post', 'ee_save_pricedetails_product_fields', 10, 3);
