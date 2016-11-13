<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;

$additional = (get_post_meta($product->id, 'additional_textarea', true) != '') ? get_post_meta($product->id, 'additional_textarea', true) : 0;
?>

<div class="material-tab">
    <?php echo $additional ?>
</div>
