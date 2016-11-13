<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;

$pricedetails = (get_post_meta($product->id, 'pricedetails_textarea', true) != '') ? get_post_meta($product->id, 'pricedetails_textarea', true) : 0;
?>

<div class="material-tab">
    <h2><?php _e('Détail', 'ee') ?></h2>
    <?php echo $pricedetails ?>
</div>
