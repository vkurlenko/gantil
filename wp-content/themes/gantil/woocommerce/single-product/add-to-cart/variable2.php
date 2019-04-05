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

// получим slug корневой категории (service/butik)
$top_cat_slug = g_get_top_cat_slug($product);

//echo $top_cat_slug;

$attribute_keys = array_keys( $attributes );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<!-- social-block -->
<?php /*get_template_part('inc/social/social-block');*/?>
<!-- /social-block -->

<?php 
	
	/* укажем диапазон цен на услугу */

	require_once $_SERVER['DOCUMENT_ROOT'].'/wp-content/plugins/my_im_ex/inc/class.prlist.php';

	$priceRange = new PRLIST();

	// узнаем корневой раздел каталога (УСЛУГИ, БУТИК), к которому относится продукт
	$top_term = $priceRange->get_top_term( 'product_cat',  $product->get_id());
	$root_category = $top_term->slug;

	// определим сохранен ли в сессии салон
	if (!isset($_SESSION['salon']))
		$salon = '';
	else
		$salon = $_SESSION['salon'];

	// получим диапазон цен (array)
	$range = $priceRange->getPriceRange($product->get_id(), $salon);

	switch ($root_category) {
		case 'service' :
			$str_pfx = 'Цена в '.$priceRange->getSalonName($salon);
			break;

		case 'butik' :
			$str_pfx = 'Цена в салонах';
			break;
	}
	
	
	switch (count($range)) {
		case 0 :	
			$range_string = 'Цена не определена';
			break;

		case 1 : 	
			$range_string = $str_pfx.' &#8381;'.$range[0];
			break;
		
		default:   
			if($salon) 
				$range_string = $str_pfx.' от &#8381;'.min($range).' до &#8381;'.max($range);
			else
				$range_string = 'Цена в разных салонах от &#8381;'.min($range).' до &#8381;'.max($range);
			break;
	}

	//echo '<span class="price-range">'.$range_string.'</span>';

	/* /укажем диапазон цен на услугу */
	?>


<form class="variations_form cart cart_<?=$top_cat_slug?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo htmlspecialchars( wp_json_encode( $available_variations ) ) ?>">
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

		 

 		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<div class="single_variation_wrap">

			

			<?php
				/**
				 * woocommerce_before_single_variation Hook.
				 */

				do_action( 'woocommerce_before_single_variation' );

				?>
				
				<?php

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

<script type="text/javascript">
	
/* поля выбора ДАТЫ и ВРЕМЕНИ */
jQuery(document).ready(function($) 
{

    //alert(date.getHours());
	// выбор даты
	$('#pa_order_date').replaceWith('<input type="hidden" id="pa_order_date" name="attribute_pa_order_date" placeholder="Выберите дату" style="min-width:75%"><div id="datepicker"></div>');

	$(function() 
	{
        $('#datepicker').datepicker($.extend({
        	dateFormat : "dd-mm-yy",
      		minDate: 0, maxDate: "+12M",
      		onSelect: function(value, date) 
      		{ 
      			$('#pa_order_date').val(value);		        
		    }                
        },
         $.datepicker.regional['ru']
       ));
        
    });
	


  	// выбор времени
    var date = new Date();

  	options = '<option value="Любое время"  class="attached enabled" selected>Любое время</option>';

  	for(i = 9; i < 22; i++)
  	{
  	    var dis = 'enabled';

  	    if(i <= date.getHours())
  	        continue;

  		options += '<option value="'+i+'.00" class="attached '+dis+'" >'+i+':00</option>';
  		options += '<option value="'+i+'.30" class="attached '+dis+'" >'+i+':30</option>';
  	}

  	$("#pa_order_time").empty();
  	$(options).appendTo($("#pa_order_time"));     	
})
/* /поля выбора ДАТЫ и ВРЕМЕНИ */
</script>

<script language="javascript">

	var color = 'color';
	var sheet = document.styleSheets[2];		
	var index = sheet.cssRules.length-1;
	var stop = false;
	//console.log(sheet.cssRules.length+' / '+index);

	
	/* сделаем неактивными красные/зеленые смены */
	function setColor(color)
	{		
		
		if(color == 'watch-all' && !stop)	
		{			
			sheet.deleteRule(index)		
			stop = true				
		}	
			

		if(color == 'watch-green')
		{			
			if(!stop) 
				sheet.deleteRule(index)			
			sheet.addRule(".red a", "opacity: .35; filter: Alpha(Opacity=35); cursor: default !important;", index);	
			stop = false
			
		}


		if(color == 'watch-red')
		{
			if(!stop) 
				sheet.deleteRule(index)				
			sheet.addRule(".green a", "opacity: .35; filter: Alpha(Opacity=35); cursor: default !important;", index);
			stop = false
			
		}

		//console.log(document.styleSheets[2]);
	}
	/* /сделаем неактивными красные/зеленые смены */

	function set_salon(s)
	{
		//var s = $('#pa_item_salon').val();
		//alert(s)

		$.ajax({
			type: "POST",
		  	url: '/wp-content/themes/gantil/ajax/set.salon.php',
		  	data: "salon="+s,
		  	success: function(data)
		  	{
		    	//location.reload();
		  	},
		  	error: function()
		  	{
		  		alert('Ошибка сохранения салона');
		  	}
		});
	}

	
	$(document).ready(function()
	{	
		
		$('.variations_form td.value').each(function()
		{
			title = $(this).find('.option_name').text()
			$(this).find('option').eq(0).text(title)
		})
		
		
		// при смене салона 
		$('#pa_item_salon').before('<p>Эта услуга предоставляется в салонах:<p>')

		//alert($('#pa_item_salon').val())

		if($('#pa_item_salon').val() == '')
		{
			//alert('empty')
			$('#pa_item_salon').change(function()
			{
				$('#pa_item_spec').prop('selectedIndex',0);
				$('#selectMaster').remove();
				$('#pa_item_master').attr('value', '');
				//alert('salon')
				//ajax save salon
			})
		}
		else
		{
			//alert($('#pa_item_salon').val()) 
			p = $('#pa_item_salon').parents('tr');
			$(p).nextAll('tr').find('select').removeClass('visible').prop('selectedIndex',0);	
			$(p).next('tr').find('select').addClass('visible');
		}

		

		// выпадающее поле выбора мастера заменим на скрытый INPUT
		$('#pa_item_master').replaceWith('<input type="hidden" id="pa_item_master" name="attribute_pa_item_master" data-attribute_name="attribute_pa_item_master" data-show_option_none="yes" placeholder="мастер" style="min-width:75%">');

		
	})
</script>

<style type="text/css">
	/* p.price{display: none;} */
	.hidden-button{display: none !important;}
	.variations select{display: none !important}  
	.variations select.visible{display: block !important} 
	#pa_item_salon, #pa_obem{display: block !important;}
	.cart_service .quantity{display: none !important;} 
	.option_name{display: none}
	#pa_order_time{display: block !important;}
	.dis{opacity: .35; background-image: none}
	.item-master{cursor: pointer;}
	.item-master:hover{background: #eee;}
	.item-master, #wait{list-style-type: none; padding:5px 0 5px 10px; border:1px solid #fff; min-width: 75%;    max-width: 100%;    float: left;}
	.item-master-selected{border:1px solid #ccc;}
	.item-master img{border-radius: 50%; cursor: pointer;}
	.master_name{margin-left:10px;}
	#wait{text-align: center}
	#wait img{height: 50px} 

</style>

<!-- <p><a class="button" href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>"><?php _e( '&larr; Return To Shop', 'woocommerce' ) ?></a></p> -->

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
