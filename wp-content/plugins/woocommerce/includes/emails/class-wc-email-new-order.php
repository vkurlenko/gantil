<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WC_Email_New_Order' ) ) :

/**
 * New Order Email.
 *
 * An email sent to the admin when a new order is received/paid for.
 *
 * @class       WC_Email_New_Order
 * @version     2.0.0
 * @package     WooCommerce/Classes/Emails
 * @author      WooThemes
 * @extends     WC_Email
 */
class WC_Email_New_Order extends WC_Email {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->id               = 'new_order';
		$this->title            = __( 'New order', 'woocommerce' );
		$this->description      = __( 'New order emails are sent to chosen recipient(s) when a new order is received.', 'woocommerce' );
		$this->heading          = __( 'New customer order', 'woocommerce' );
		$this->subject          = __( '[{site_title}] New customer order ({order_number}) - {order_date}', 'woocommerce' );
		$this->template_html    = 'emails/admin-new-order.php';
		$this->template_plain   = 'emails/plain/admin-new-order.php';

		// Triggers for this email
		add_action( 'woocommerce_order_status_pending_to_processing_notification', array( $this, 'trigger' ), 10, 2 );
		add_action( 'woocommerce_order_status_pending_to_completed_notification', array( $this, 'trigger' ), 10, 2 );
		add_action( 'woocommerce_order_status_pending_to_on-hold_notification', array( $this, 'trigger' ), 10, 2 );
		add_action( 'woocommerce_order_status_failed_to_processing_notification', array( $this, 'trigger' ), 10, 2 );
		add_action( 'woocommerce_order_status_failed_to_completed_notification', array( $this, 'trigger' ), 10, 2 );
		add_action( 'woocommerce_order_status_failed_to_on-hold_notification', array( $this, 'trigger' ), 10, 2 );

		// Call parent constructor
		parent::__construct();

		// Other settings
		$this->recipient = $this->get_option( 'recipient', get_option( 'admin_email' ) );
	}

	/**
	 * Trigger the sending of this email.
	 *
	 * @param int $order_id The order ID.
	 * @param WC_Order $order Order object.
	 */
	public function trigger( $order_id, $order = false ) 
	{
		global $wpdb;

		if ( $order_id && ! is_a( $order, 'WC_Order' ) ) 
		{
			$order = wc_get_order( $order_id );
		}


		if ( is_a( $order, 'WC_Order' ) ) 
		{
			$this->object                  = $order;
			$this->find['order-date']      = '{order_date}';
			$this->find['order-number']    = '{order_number}';
			$this->replace['order-date']   = wc_format_datetime( $this->object->get_date_created() );
			$this->replace['order-number'] = $this->object->get_order_number();
		}

		if ( ! $this->is_enabled() || ! $this->get_recipient() ) {
			return;
		}

		/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
		$mail_to = $this->get_recipient();
		
		$f = fopen($_SERVER['DOCUMENT_ROOT'].'/mail.txt', 'a+');
		$str =  '======================================'."\r\n".$order_id."\r\n";

		$q = 'SELECT * FROM `gn_woocommerce_order_itemmeta` WHERE order_item_id IN (SELECT `order_item_id` FROM `gn_woocommerce_order_items` WHERE order_id = '.$order_id.')';
		fwrite($f, $q."\r\n");
		$res = $wpdb->get_results($q);
		
		foreach ($res as $row) 
		{
			$str .= $row->meta_key.' = '.$row->meta_value."\r\n";

			if($row->meta_key == 'pa_item_salon')
				$mail_to .= ', '.get_option('g_options')['email_'.$row->meta_value];
		}

		$mail_to .= ','.get_option('g_options')['email_admin'];

		$str .= $mail_to."\r\n";		
		
		fwrite($f, $str);

		// если включена опция 'Отправлять только админам'
		if(get_option('g_options')['mail_to_admin_only'])
			$mail_to = get_option('g_options')['email_admin'];

		
		/* CURL */
		// продублируем сообщение кроме почты еще и на сервер
		if(!get_option('g_options')['mail_to_admin_only'])
			$this -> send_by_curl($this->get_content(), $this->get_subject());
		/* CURL */

		$this->send( $mail_to, $this->get_subject(), str_replace(array( '[h1]', '[/h1]' ), array( '', '' ), $this->get_content()), $this->get_headers(), $this->get_attachments() );
		/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/

	}

	/********************************************************/
	/* отправка сообщения из формы на сервер с помощью CURL */
	/********************************************************/
	public function send_by_curl($body = '', $subject = '') {

		// массив поиска подстроки названия салона для заменв на ID салона
		// 118662 - Братиславская, 118663 - Коломенская, 118664 - Ленинский, 118665 - Сходненская
		$s_id = array( 
			'братиславск'   => 118662,
			'коломенск' 	=> 118663,
			'ленинск'       => 118664,
			'сходненск'     => 118665
		 );		

		// ID салона по умолчанию
		$salon_id = 0;

		// в теле сообщения поищем вхождение названия салона и если находим, то в $salon_id подставим ID соответствующего салона
		foreach( $s_id as $k => $v ) {
			if( strpos( mb_strtolower( $body ), $k ) ) {
				$salon_id = $v;
				break;
			}				
		}


		//$url 	= 'http://gantil.ru/getcurl.php'; // URL для отправки запроса
		$url    = 'https://salon.ujn.su/api/smessage';
		$theme 	= urlencode( nl2br( $subject ) );           // тема сообщения
		$text 	= urlencode( nl2br ( str_replace(array( '[', ']' ), array( '<', '>' ), $body) ) );  // тело сообщения (неизменно)
		$to_user= $salon_id;                       // ID салона
		$contact= '';
		
		// строка - данные запроса
		$a 		= "to_user=".$salon_id."&contact=".$contact."&theme=".$theme."&text=".$text;

		// необходимые заголовки
		$headers = array("Authorization: JWT eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjEzMDYyMyIsImlhdCI6MTUxNzgzNzE4MiwiZXhwIjoxNjA0MjM3MTgyfQ.xS-IU-GTQ9k7iaT6_irDSwLnnqhRgMY4KPVRe-5_5_g",
		                 "Content-Type: application/x-www-form-urlencoded");
		
		$ch = curl_init($url);
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $a);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);

		curl_close($ch);
	}
	/*********************************************************/
	/* /отправка сообщения из формы на сервер с помощью CURL */
	/*********************************************************/

	/**
	 * Get content html.
	 *
	 * @access public
	 * @return string
	 */
	public function get_content_html() {
		return wc_get_template_html( $this->template_html, array(
			'order'         => $this->object,
			'email_heading' => $this->get_heading(),
			'sent_to_admin' => true,
			'plain_text'    => false,
			'email'			=> $this,
		) );
	}

	/**
	 * Get content plain.
	 *
	 * @access public
	 * @return string
	 */
	public function get_content_plain() {
		return wc_get_template_html( $this->template_plain, array(
			'order'         => $this->object,
			'email_heading' => $this->get_heading(),
			'sent_to_admin' => true,
			'plain_text'    => true,
			'email'			=> $this,
		) );
	}

	/**
	 * Initialise settings form fields.
	 */
	public function init_form_fields() {
		$this->form_fields = array(
			'enabled' => array(
				'title'         => __( 'Enable/Disable', 'woocommerce' ),
				'type'          => 'checkbox',
				'label'         => __( 'Enable this email notification', 'woocommerce' ),
				'default'       => 'yes',
			),
			'recipient' => array(
				'title'         => __( 'Recipient(s)', 'woocommerce' ),
				'type'          => 'text',
				'description'   => sprintf( __( 'Enter recipients (comma separated) for this email. Defaults to %s.', 'woocommerce' ), '<code>' . esc_attr( get_option( 'admin_email' ) ) . '</code>' ),
				'placeholder'   => '',
				'default'       => '',
				'desc_tip'      => true,
			),
			'subject' => array(
				'title'         => __( 'Subject', 'woocommerce' ),
				'type'          => 'text',
				'description'   => sprintf( __( 'This controls the email subject line. Leave blank to use the default subject: %s.', 'woocommerce' ), '<code>' . $this->subject . '</code>' ),
				'placeholder'   => '',
				'default'       => '',
				'desc_tip'      => true,
			),
			'heading' => array(
				'title'         => __( 'Email heading', 'woocommerce' ),
				'type'          => 'text',
				'description'   => sprintf( __( 'This controls the main heading contained within the email notification. Leave blank to use the default heading: %s.', 'woocommerce' ), '<code>' . $this->heading . '</code>' ),
				'placeholder'   => '',
				'default'       => '',
				'desc_tip'      => true,
			),
			'email_type' => array(
				'title'         => __( 'Email type', 'woocommerce' ),
				'type'          => 'select',
				'description'   => __( 'Choose which format of email to send.', 'woocommerce' ),
				'default'       => 'html',
				'class'         => 'email_type wc-enhanced-select',
				'options'       => $this->get_email_type_options(),
				'desc_tip'      => true,
			),
		);
	}
}

endif;

return new WC_Email_New_Order();
