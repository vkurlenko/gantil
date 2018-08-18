<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
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
 * @version     2.0.0
 */
?>

<style>
	.woo-search{
		padding:10px;
	}
	.aws-container .aws-search-form{text-align: center !important;}

	.aws-search-field{width: 500px !important; max-width: 100% !important; display: inline !important;}
</style>

<?php

if(user_admin()){
	echo '<div class="woo-search">Поиск по каталогу товаров и услуг: ';
	echo do_shortcode('[aws_search_form]');
	echo '</div>';
}
?>
<ul class="products">
