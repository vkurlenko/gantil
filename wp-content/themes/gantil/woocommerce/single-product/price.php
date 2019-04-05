<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;


$terms = wc_get_product_terms( $product->id, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) );

/*if(user_admin()){
    printArray($product);
}*/


if ( ! empty( $terms ) ) {
    $main_term = $terms[0];
    $ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
    if ( ! empty( $ancestors ) ) {
        $ancestors = array_reverse( $ancestors );
        // first element in $ancestors has the root category ID
        // get root category object
        $root_cat = get_term( $ancestors[0], 'product_cat' );
        //printArray($root_cat);
    }
    else {
        // root category would be $main_term if no ancestors exist
    }
}
else {
    // no category assigned to the product
}

if($root_cat->slug == 'butik'):
?>
<p class="price"><?php echo $product->get_price_html(); ?></p>
<?php
endif;
?>