<?php
/**
 * Single variation display
 *
 * This is a javascript-based template for single variations (see https://codex.wordpress.org/Javascript_Reference/wp.template).
 * The values will be dynamically replaced after selecting attributes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if(user_admin()){
	global $product;
	$id = $product->get_id();
	$purchase_note = get_post_meta( $id, '_purchase_note', true);
}

?>
<script type="text/template" id="tmpl-variation-template">

	
	<div class="woocommerce-variation-price">
		<span class="price"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">₽</span>{{{ data.variation.display_price }}}</span></span>		
	</div>

	<div class="woocommerce-variation-availability">
		{{{ data.variation.availability_html }}}
	</div>

	<div id="woocommerce-variation-description" class="woocommerce-variation-description">
		{{{ data.variation.variation_description }}}		
	</div>

	<?php
	// вывод предупреждения из поля Дополнительно -> Примечание к покупке
	if($purchase_note){
		echo "<div class='purchase_note'><p>$purchase_note</p></div>";		
	}
	?>	

</script>
<script type="text/template" id="tmpl-unavailable-variation-template">
	<p><?php _e( 'Sorry, this product is unavailable. Please choose a different combination.', 'woocommerce' ); ?></p>
</script>




