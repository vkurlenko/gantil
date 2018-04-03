<?php
/**
 * Loop Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
?>
<!-- 
<?php if ( $price_html = $product->get_price_html() ) : ?>
	<span class="price"><?php echo $price_html; ?></span>
<?php endif; ?>
 -->
<?php
/* укажем диапазон цен на услугу */

	require_once $_SERVER['DOCUMENT_ROOT'].'/wp-content/plugins/my_im_ex/inc/class.prlist.php';

	$priceRange = new PRLIST();

	// узнаем корневой раздел каталога (УСЛУГИ, БУТИК), к которому относится продукт
	$top_term = $priceRange->get_top_term( 'product_cat',  $product->get_id());
	$root_category = $top_term->slug;

	

	// получим диапазон цен (array)
	$range = $priceRange->getPriceRange($product->get_id());

	$str_pfx = '';
	
	
	switch (count($range)) {
		case 0 :	
			$range_string = ' ';
			break;

		case 1 : 	
			$range_string = $str_pfx.' &#8381;'.$range[0];
			break;
		
		default:   
			
				$range_string = $str_pfx.'&#8381;'.min($range).' - &#8381;'.max($range);
			
			break;
	}

	if($range_string) : ?>
		<span class="price"><span class="woocommerce-Price-amount amount"><?=$range_string?></span></span>
	<?php endif;?>

	
