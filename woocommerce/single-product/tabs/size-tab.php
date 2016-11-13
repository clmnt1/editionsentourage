<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;

$heightText = (get_post_meta($product->id, 'height_text', true) != '') ? get_post_meta($product->id, 'height_text', true) : 0;
$widthText = (get_post_meta($product->id, 'width_text', true) != '') ? get_post_meta($product->id, 'width_text', true) : 0;
$depthText = (get_post_meta($product->id, 'depth_text', true) != '') ? get_post_meta($product->id, 'depth_text', true) : 0;
?>

<div class="size-tab product-tab">
    <h2><?php _e('Dimensions', 'ee') ?></h2>
    <span><?php _e('Hauteur', 'ee') ?></span>
    <?php echo $heightText ?>
    <span><?php _e('Largeur', 'ee') ?></span>
    <?php echo $widthText ?>
    <span><?php _e('Profondeur', 'ee') ?></span>
    <?php echo $depthText ?>
</div>
