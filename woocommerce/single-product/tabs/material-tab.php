<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;

$material = (get_post_meta($product->id, 'material_textarea', true) != '') ? get_post_meta($product->id, 'material_textarea', true) : 0;
?>


<div class="et_pb_module et_pb_toggle  et_pb_accordion_item_1 et_pb_toggle_close  material-tab product-tab">
	<h2 class="et_pb_toggle_title"><?php _e('Matériaux', 'ee') ?></h2>
		<div class="et_pb_toggle_content clearfix" style="display: none;">

      <p><?php echo $material ?></p>

	 </div> <!-- .et_pb_toggle_content -->
</div> <!-- .et_pb_toggle -->
