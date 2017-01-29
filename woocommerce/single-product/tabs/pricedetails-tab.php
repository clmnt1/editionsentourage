<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;

$pricedetails = (get_post_meta($product->id, 'pricedetails_textarea', true) != '') ? get_post_meta($product->id, 'pricedetails_textarea', true) : 0;
?>

<div class="et_pb_module et_pb_toggle  et_pb_accordion_item_3 et_pb_toggle_close  pricedetails-tab product-tab">
	<h2 class="et_pb_toggle_title"><?php pll_e('Details') ?></h2>
		<div class="et_pb_toggle_content clearfix" style="display: none;">

      <p><?php echo $pricedetails ?></p>

	 </div> <!-- .et_pb_toggle_content -->
</div> <!-- .et_pb_toggle -->
