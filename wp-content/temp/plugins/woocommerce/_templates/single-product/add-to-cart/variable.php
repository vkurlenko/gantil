<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$attribute_keys = array_keys( $attributes );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<?

// $attributes['pa_item_master'] = array(
// 		'test',
// 		'test2'

// 	);
       

 //printArray($attributes);
// printArray($product);
?>

<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( wp_json_encode( $available_variations ) ) ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php _e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
	<?php else : ?>
		<table class="variations" cellspacing="0">
			<tbody>
				<?php foreach ( $attributes as $attribute_name => $options ) : ?>
					<tr>
						<!-- <td class="label"><label for="<?php echo sanitize_title( $attribute_name ); ?>"><?php echo wc_attribute_label( $attribute_name ); ?></label></td> -->
						<td class="value">
							<!--<label for="<?php echo sanitize_title( $attribute_name ); ?>">--><strong class="option_name"><?php echo wc_attribute_label( $attribute_name ); ?></strong><!-- </label> --><br>
							<?php
								$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( stripslashes( urldecode( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ) ) : $product->get_variation_default_attribute( $attribute_name );
								
								//$_SESSION['salon'] = 'salon-na-sokole';
								if(isset($_SESSION['salon']))
									$selected = $_SESSION['salon'];

								wc_dropdown_variation_attribute_options( array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => $selected ) );
								echo end( $attribute_keys ) === $attribute_name ? apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) : '';
							?>
						</td>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>

		

  <p>Дата: <input type="text" id="datepicker"></p>
  <script>
  
    jQuery(document).ready(function($) 
    {
    	// выбор даты
    	$('#pa_order_date').replaceWith('<input type="text" id="pa_order_date" name="attribute_pa_order_date" placeholder="Выберите дату" style="min-width:75%">');
    	$.datepicker.setDefaults(
			$.extend($.datepicker.regional['ru'])
		)

      	$("#pa_order_date").datepicker({dateFormat : "yy-mm-dd"});

      	// выбор времени
      	options = '<option value="">Время</option>';
      	for(i = 9; i < 22; i++)
      	{
      		options += '<option value="'+i+':00" class="attached enabled">'+i+':00</option>';
      		options += '<option value="'+i+':30" class="attached enabled">'+i+':30</option>';
      	}

      	$("#pa_order_time").empty();
      	$(options).appendTo($("#pa_order_time"));
	})
</script>

		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<div class="single_variation_wrap">
			<?php
				/**
				 * woocommerce_before_single_variation Hook.
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );

				/**
				 * woocommerce_after_single_variation Hook.
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<script language="javascript">
$(document).ready(function()
{

	$('td.value').each(function()
	{
		title = $(this).find('.option_name').text()
		$(this).find('option').eq(0).text(title)

	})

	$('#pa_item_salon').change(function()
	{
		$('#pa_item_spec, #pa_hear-length').prop('selectedIndex',0);

		//ajax save salon
		
	})
})
</script>

<style type="text/css">
	.option_name{display: none}
</style>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
