<?php
/**
 * Proceed to checkout button
 *
 * Contains the markup for the proceed to checkout button on the cart.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/proceed-to-checkout-button.php.
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
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<!--
<a href="<?php /*echo esc_url( wc_get_checkout_url() );*/?>" class="checkout-button button alt wc-forward">
	<?php /*esc_html_e( 'Proceed to checkout', 'woocommerce' ); */?>
</a>
<a href="//gantil.ru/services/" class="button wc-forward">Продолжить покупки</a>-->

<ul class="salons-item-menu-2">
    <li class="light">
        <a href="/checkout/">Оформить заказ</a>
        <div id="trapezoid"></div>
    </li>
    <!--<li id="trapezoid"></li>-->
    <li class="dark"><a href="/services/">Продолжить покупки</a></li>

    <div style="clear:both"></div>
</ul>

<style>

.salons-item-menu-2,
.salons-item-menu-2 li{
	display: block;
	padding:0;
	margin:0;
}
.salons-item-menu-2{
	border:2px solid #606060;
	background: #f30;
	overflow: hidden;
}
.salons-item-menu-2 li{
	float: left;
	width: 50%;
	text-align: center;
}

.salons-item-menu-2 li a{
	color:#fff;
	text-transform: uppercase;
	padding: 16px 0;
	display: inline-block;
	font-weight: bold;
	font-size: 22px;
}

 .salons-item-menu-2 li.light{
	position: relative;
	width: 53%;
}

.salons-item-menu-2 li.dark{
	background: #606060;
	width: 47%;
}

.salons-item-menu-2 li.dark a{
	color:#fff;
}

#trapezoid {
	position: absolute;
	top:0;
	right: 0;
	border-bottom: 65px solid #606060;
	border-left: 40px solid transparent;
	border-right: 0px solid transparent;
	height: 0;
	width: 6%;
}

</style>