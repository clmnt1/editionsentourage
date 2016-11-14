<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;

$material = (get_post_meta($product->id, 'material_textarea', true) != '') ? get_post_meta($product->id, 'material_textarea', true) : 0;
?>

<div class="material-tab product-tab">
    <h2><?php _e('Matériaux', 'ee') ?></h2>
    <?php echo $material ?>
</div>
