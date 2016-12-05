<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;

$heightText = (get_post_meta($product->id, 'height_text', true) != '') ? get_post_meta($product->id, 'height_text', true) : 0;
$widthText = (get_post_meta($product->id, 'width_text', true) != '') ? get_post_meta($product->id, 'width_text', true) : 0;
$depthText = (get_post_meta($product->id, 'depth_text', true) != '') ? get_post_meta($product->id, 'depth_text', true) : 0;
?>

<div class="et_pb_module et_pb_toggle  et_pb_accordion_item_2 et_pb_toggle_close  size-tab product-tab">
	<h2 class="et_pb_toggle_title"><?php _e('Dimensions', 'ee') ?></h2>
		<div class="et_pb_toggle_content clearfix" style="display: none;">

      <p><span><?php _e('Hauteur', 'ee') ?></span>
      <?php echo $heightText ?>
      <br />
      <span><?php _e('Largeur', 'ee') ?></span>
      <?php echo $widthText ?>
      <br />
      <span><?php _e('Profondeur', 'ee') ?></span>
      <?php echo $depthText ?></p>

	 </div> <!-- .et_pb_toggle_content -->
</div> <!-- .et_pb_toggle -->
