<?
add_action('admin_menu', function()
{
	add_menu_page('Редактирование прайс-листов', 'Прайс-листы Услуги', 'manage_options', 'my_im_ex/inc/page.php');
	add_menu_page('Редактирование прайс-листов', 'Прайс-листы Бутик', 'manage_options', 'my_im_ex/inc/page3.php');
});



//add_action('init', 'test');



add_action('wp_ajax_set_price', 		'set_price');
add_action('wp_ajax_nopriv_set_price', 	'set_price');

add_action('wp_ajax_del_var', 			'del_var');
add_action('wp_ajax_nopriv_del_var', 	'del_var');

function update_range($pid, $price)
{
	global $wpdb;

	$sql = "SELECT meta_value FROM `gn_postmeta`
			WHERE post_id = ".$pid."
			AND meta_key = '_price'";
	$res = $wpdb->get_results($sql);

	$arr = array();

	foreach($res as $row)
	{
		$arr[] = $row->meta_value;
	}

	if(!in_array($price, $arr))
	{
		$add_meta = add_post_meta($pid, '_price', $price);
		//echo 'add_meta = '.$add_meta;
	}
		
		//echo 'new value '.$price;

	//printArray($res);
}


/**********************************/
/* ajax-запрос на обновление цены */
/**********************************/
function set_price()
{
	global $wpdb;
		
	$pid 	= intval( $_POST['pid'] );
	$vid 	= intval( $_POST['vid'] );
	$price 	= intval( $_POST['price'] );

	$set_price = update_post_meta( $vid, '_regular_price', $price );

	if($set_price)
	{
		echo '1';
		update_range($pid, $price);
	}
	else
		echo '0';

	wp_die();
}
/***********************************/
/* /ajax-запрос на обновление цены */
/***********************************/


/************************************/
/* ajax-запрос на удаление вариации */
/************************************/
function del_var()
{
	
	global $wpdb;

	$res = '0';

	if($_POST['vid'])
	{
		$vid 	= intval( $_POST['vid'] );

		$sql = 'DELETE FROM `gn_posts` WHERE id= '.$vid;
		$res = $wpdb->get_results($sql);

		

		$sql .= 'DELETE FROM `gn_postmeta` WHERE post_id= '.$vid;
		$res = $wpdb->get_results($sql);
		

		$sql = "SELECT * FROM `gn_posts`
				WHERE id = ".$vid;
		$res = $wpdb->get_results($sql);

		if(empty($res))
			$res = '1'; // вариация удалена успешно
	}

	echo $res;
	
	wp_die();
}
/*************************************/
/* /ajax-запрос на удаление вариации */
/*************************************/

