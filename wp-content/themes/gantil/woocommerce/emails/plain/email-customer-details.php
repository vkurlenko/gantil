<?php
/**
 * Additional Customer Details (plain)
 *
 * This is extra customer data which can be filtered by plugins. It outputs below the order item table.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/plain/email-addresses.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates/Emails/Plain
 * @version     2.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

echo strtoupper( __( 'Customer details', 'woocommerce' ) ) . "\n\n";

// для выделения email и номера телефона выделим их BB -тегом [H1]
// при формировании тела письма этот тег вырезается, а при отправке сообщения через CURL преобразуется в тег <h1> (в файле \wp-content\plugins\woocommerce\includes\emails\class-wc-email-new-order.php)
foreach ( $fields as $field ) {
	echo wp_kses_post( $field['label'] ) . ': [h1]' . wp_kses_post( $field['value'] ) . "[/h1]\n";
}
