<?

//require_once "plugin/Mobile_Detect.php";

//echo 'wp_is_mobile = '.wp_is_mobile();

add_shortcode( 'promo', array( 'Promo', 'renderBanner' ) );

add_shortcode( 'referal', array( 'Referal', 'renderForm' ) );

// Для скриптов
function my_deregister_javascript () {
    if ( !is_page ('154') ) {
        wp_deregister_script ( 'contact-form-7' );
    }
}
//add_action ( 'wp_print_scripts', 'my_deregister_javascript', 100 );

// Для стилей
function my_deregister_styles() {
    if ( !is_page ('154') ) {
        wp_deregister_style ( 'contact-form-7' );
    }
}
//add_action('wp_print_styles', 'my_deregister_styles', 100);
//---------


function woocommerce_single_variation() {
        echo '<div class="salon-name"></div>
        	<div class="woocommerce-variation single_variation">    

        </div>';
    }


function get_master_realname($slug)
{
	$args = array(
		'numberposts' => 1,
		'name'        => $slug,
		'post_type'   => 'stm_masters',
		'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
	);

	$posts = get_posts( $args );
	$slug = $posts[0]->post_title;
	return $slug;
}

 function user_admin() 
{
    global $wp_roles;

    $current_user = wp_get_current_user();
    $roles = $current_user->roles;
    $role = array_shift($roles);

    if( $role ) {
    	$current_user_role =  $wp_roles->role_names[$role];

	    //get_current_user_role();

	    //echo 'это администратор';
		if ($current_user_role == 'Administrator') 
			return true;		
		else
			return false;
    }
    else
    	return false;
    	
}




/* Генерация монохромного изображения из цветного и возврат ссылки на это изображение */
// пример использования makeGrayPic('http://test.gantil.ru/wp-content/uploads/2017/06/len-490x325.jpg');
function makeGrayPic($filename)
{

	$path = $resultName = $filename;
	
	// разберем URL картинки на составляющие
	$url = parse_url($filename); 
	
	// /wp-content/uploads/2017/06/len-490x325.jpg
	$fpath = $url['path']; 

	// найдем имя файла (len-490x325.jpg)
	$fname = explode('/', $url['path']);
	$fname = $fname[count($fname) - 1];

	//$file_parts = explode('.', $fpath);



	// найдем путь к файлу (/wp-content/uploads/2017/06/)
	$fpath = str_replace($fname, '', $fpath);

	// создадим имя новго файла (/home/gantil/test.gantil.ru/docs/wp-content/uploads/2017/06/len-490x325-mono.jpg)
	$fmono = str_replace('.', '-mono.', $fname);
	$resultName = $_SERVER['DOCUMENT_ROOT'].$fpath.$fmono;
	
	

	if(!file_exists($resultName))
	{
		// echo 'resultName = '.$resultName.' exists = '.file_exists($resultName).'<br>';
		// получаем размеры исходного изображения

		$original = $_SERVER['DOCUMENT_ROOT'].$url['path'];

		if (file_exists( $original )) {
			$imgSize = getimagesize( $original );
			$width = $imgSize[0];
			$height = $imgSize[1];

			//echo $imgSize[2]; die;

			// создаем новое изображение
			$img = imagecreate($width, $height);

			// задаем серую палитру для нового изображения
			for ($color = 0; $color <= 255; $color++) 
			{
				imagecolorallocate($img, $color, $color, $color);
			}

			// создаем изображение из исходного
            switch($imgSize[2]){
                case 2 :
                    $img2 = imageCreateFromJpeg($_SERVER['DOCUMENT_ROOT'].$url['path']);
                    // объединяем исходное изображение и серое
                    imageCopyMerge($img, $img2,0,0,0,0, $width, $height, 100);
                    // сохраняем изображение
                    imagejpeg($img, $resultName);
                    break;

                case 3 :
                    $img2 = imageCreateFromPng($_SERVER['DOCUMENT_ROOT'].$url['path']);
                    // объединяем исходное изображение и серое
                    imageCopyMerge($img, $img2,0,0,0,0, $width, $height, 100);
                    // сохраняем изображение
                    imagepng($img, $resultName);
                    break;
            }

			/*// объединяем исходное изображение и серое
			imageCopyMerge($img, $img2,0,0,0,0, $width, $height, 100);

			// сохраняем изображение
			imagejpeg($img, $resultName);*/

			// очищаем память
			imagedestroy($img);		
		}
		
	}

	// /wp-content/uploads/2017/06/len-490x325-mono.jpg
	$url_mono = $fpath.$fmono;

	return $url_mono;
}
/* /Генерация монохромного изображения из цветного и возврат ссылки на это изображение */


/* получим название ролика с YOUTUBE */
function get_ydata($vid) 
{
	$url = "https://www.googleapis.com/youtube/v3/videos?id=".$vid."&key=AIzaSyDb4fDfRvQGb_Jqg4x8Jt0zy_ddqL8fYr4&fields=*&part=snippet";
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

/* shortcode вставки галереи видео */
/*function short_code_video($atts)
{
	$arr = explode(',', $atts['urls']);
	
	

	foreach($arr as $a)
	{
		$b = explode('/', trim($a));
		$arr2[] = $b[count($b) - 1];		
	}

	
	$data = get_ydata($arr2[0]);
	$youtube = json_decode($data);
	$title = $youtube->items[0]->snippet->title;
	$dscr = $youtube->items[0]->snippet->description;

	$code = '<h2>'.$title.'</h2>
	<p>'.htmlspecialchars($dscr).'</p>
	<iframe id="video-player" width="640" height="390" src="https://www.youtube.com/embed/'.$arr2[0].'" frameborder="0" allowfullscreen></iframe>';

	$code .= '<div class="slick-video">';
	foreach($arr2 as $a)
	{
		$path = 'https://www.youtube.com/embed/'.$a;
		$data = get_ydata($a);		
		
		$youtube = json_decode($data);

		
		
		
		$title = $youtube->items[0]->snippet->title;
		$dscr = $youtube->items[0]->snippet->description;
		
		if (preg_match("/\/(embed|v)\/(.+)\/?/i", $path, $matches)) 
		{
            $url = "http://img.youtube.com/vi/".$matches[2]."/0.jpg";
        }        

      

		$code .=  '<div class="video-item" style=""><a href="'.$path.'" data="'.$a.'" data-dscr="'.htmlspecialchars($dscr).'"><img title="'.$title.'" src="'.$url.'"></a></div>';
	}
	$code .= '</div>';

	return $code;
}

add_shortcode('video_gallery', 'short_code_video');*/
/* /shortcode вставки галереи видео */





/******************************************************/
/* short_code вставки галереи видео (youtube + vimeo) */
/******************************************************/
add_shortcode('video_gallery', 'short_code_video');


function short_code_video($atts)
{
	// разберем строку шорткода (вида [video_gallery_2 urls="https://youtu.be/Zqe9zx-fa9E, https://vimeo.com/248496167, https://youtu.be/lChw9saimkQ"]) на ссылки
	$arr = explode(',', $atts['urls']);
	
	// и сведем их  в массив вида 
	// array([0] => array('hosting' => 'youyu.be', 'source' => 'hgkhgsdfks'))
	foreach($arr as $a)
	{
		$b = explode('/', trim($a));
		$arr2[] = array(
			'hosting' 	=> $b[count($b) - 2],
			'source'	=> $b[count($b) - 1]
		);		
	}
	
	// получим превью и код первого в списке видео	
	$code = getSourceFirst($arr2[0]);
	
	// сформируем карусель превью видео-роликов
	$code .= '<div class="slick-video">';

	foreach($arr2 as $a)
	{
		if($a['hosting'] == 'youtu.be')
		{
			$path 		= 'https://www.youtube.com/embed/'.$a['source'];
			$data 		= get_ydata($a['source']);				
			$youtube 	= json_decode($data);				
			$title 		= $youtube->items[0]->snippet->title;
			$dscr 		= $youtube->items[0]->snippet->description;
			
			if (preg_match("/\/(embed|v)\/(.+)\/?/i", $path, $matches)) 
	            $url = "http://img.youtube.com/vi/".$matches[2]."/0.jpg";
		}

		elseif($a['hosting'] == 'vimeo.com')
		{			
			$path = 'http://player.vimeo.com/video/'.$a['source'];			
			
			if ($xml = simplexml_load_file('http://vimeo.com/api/v2/video/'.$a['source'].'.xml')) 
			{
				$url 	= $xml->video->thumbnail_large ? (string) $xml->video->thumbnail_large: (string) $xml->video->thumbnail_medium;
				$title 	= $xml->video->title;
				$dscr 	= $xml->video->description;					
			}
		}		

		$code .=  '<div class="video-item" style=""><a href="'.$path.'" data="'.$a['source'].'" data-dscr="'.htmlspecialchars($dscr).'"><img title="'.$title.'" src="'.$url.'"></a></div>';
	}
	$code .= '</div>';

	return $code;
}

function getSourceFirst($source)
{
	$title = $dscr = '';

	if($source['hosting'] == 'youtu.be')
	{
		$data 		= get_ydata($source['source']);
		$youtube 	= json_decode($data);
		$title 		= $youtube->items[0]->snippet->title;
		$dscr 		= $youtube->items[0]->snippet->description;

		$src = 'https://www.youtube.com/embed/'.$source['source'];
	}
	elseif($source['hosting'] == 'vimeo.com')
	{
		if ($xml = simplexml_load_file('http://vimeo.com/api/v2/video/'.$source['source'].'.xml')) 
		{			
			$title 	= $xml->video->title;
			$dscr 	= $xml->video->description;					
		}
		
		$src = 'https://player.vimeo.com/video/'.$source['source'];
	}

	$code = '<h2>'.$title.'</h2>
		<p>'.htmlspecialchars($dscr).'</p>
		<iframe id="video-player" src="'.$src.'" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
	
	return $code;
}


/******************************************************/
/* short_code вставки галереи видео (youtube + vimeo) */
/******************************************************/


/**************************************************/
/* short_code вставки галереи видео в виде блоков */
/**************************************************/
add_shortcode('video_gallery_blocks', 'short_code_video_blocks');


function short_code_video_blocks($atts)
{
	// разберем строку шорткода (вида [video_gallery_2 urls="https://youtu.be/Zqe9zx-fa9E, https://vimeo.com/248496167, https://youtu.be/lChw9saimkQ"]) на ссылки
	$arr = explode(',', $atts['urls']);
	
	// и сведем их  в массив вида 
	// array([0] => array('hosting' => 'youyu.be', 'source' => 'hgkhgsdfks'))
	foreach($arr as $a)
	{
		$b = explode('/', trim($a));
		$arr2[] = array(
			'hosting' 	=> $b[count($b) - 2],
			'source'	=> $b[count($b) - 1]
		);		
	}
	
	$code = '<div class="row-fluid">';
	
	foreach($arr2 as $a){

		if($a['hosting'] == 'youtu.be'){
			$path = 'https://www.youtube.com/embed/'.$a['source'];			
		}
			
		//$code .= '<div class="col-sm-6 col-xs-12"><iframe class="v-pl" src="'.$path.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';
		$code .= '<div style="float:left"><iframe class="v-pl" src="'.$path.'?rel=0" frameborder="0" width="560" height="315" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';
	}

	$code .= '</div>';

	return $code;
}

/**************************************************/
/* short_code вставки галереи видео в виде блоков */
/**************************************************/




// WooCommerce products and categories/subcategories separately in archive pages
function mynew_product_subcategories( $args = array() ) {
	$parentid = get_queried_object_id();
	$args = array(
	    'parent' => $parentid
	);
	$terms = get_terms( 'product_cat', $args );
	if ( $terms ) {   
	    echo '<ul class="product-cats">';
	        foreach ( $terms as $term ) {              
	            echo '<li class="category">';                        
	                woocommerce_subcategory_thumbnail( $term ); 
	                echo '<h2>';
	                    echo '<a href="' .  esc_url( get_term_link( $term ) ) . '" class="' . $term->slug . '">';
	                        echo $term->name;
	                    echo '</a>';
	                echo '</h2>';                                                        
	            echo '</li>';                                                        
	    }
	    echo '</ul>';
	}
}
 
//add_action( 'woocommerce_before_shop_loop', 'mynew_product_subcategories', 50 );




function get_name_by_slug($slug)
{
	$param = array(
        'posts_per_page' => 1000,
        'post_type' => ST_Masters::POST_TYPE           
    );

    $a = get_posts($param);

    //printArray($a);

    foreach($a as $pst)
    {
    	if($pst->post_name == $slug)
    	{
    		//echo $pst->post_title;
    		return $pst->post_title;
    	}    		
    }    
}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/


// перенос галерей - обновление даты галереи
function update_gallery_date()
{
	global $wpdb;

	$file = $_SERVER['DOCUMENT_ROOT']."/wp-content/themes/gantil/string.txt";

	$f = fopen($file, "r");

	$arr = file($file);



	foreach($arr as $s)
	{

		$n = explode('|', $s);

		$fivesdrafts = $wpdb->get_results("
			SELECT ID, post_title
			FROM $wpdb->posts
			WHERE post_type = 'stm_gallery' 
			AND post_status = 'publish'
			AND post_title = '".trim($n[0])."'");

		
		$d = explode('.', trim($n[1]));
		$date = $d[2].'-'.$d[1].'-'.$d[0];
	
		foreach ( $fivesdrafts as $fivesdraft ) 
		{
			echo $fivesdraft->post_title.'['.$fivesdraft->ID.']'.'<br>';

			wp_update_post(
			    array (
			        'ID'            => $fivesdraft->ID, // ID of the post to update
			        'post_date'     => $date,
			        'post_date_gmt' => get_gmt_from_date($date)
			    )
			);
		}		
	}
}


/* перенос пользователей из списка */
function set_users()
{
	
	global $wpdb;

	$file = $_SERVER['DOCUMENT_ROOT']."/wp-content/themes/gantil/string.txt";

	$f = fopen($file, "r");

	$arr = file($file);

	foreach($arr as $s)
	{
		$n = explode('#', $s);

		//val.zhanna2012@yandex.ru# 290566# val.zhanna2012@yandex.ru# val.zhanna2012@yandex.ru# 2013-03-16 14:40:04# Жанна Валиуллина
		//
		/*
		0 val.zhanna2012@yandex.ru# 
		1 290566# 
		2 val.zhanna2012@yandex.ru# 
		3 val.zhanna2012@yandex.ru# 
		4 2013-03-16 14:40:04# 
		5 Жанна Валиуллина# 
		6 Жанна# 
		7 Валиуллина# 
		8 910|4215512

		*/
		/*$sql = 'INSERT INTO `gn_users` (user_login, user_pass, user_nicename, user_email, user_registered, display_name)
						VALUES ('.$n[0].', '.$n[1].', '.$n[2].', '.$n[3].', '.$n[4].', '.$n[5].')';
*/


		$wpdb->insert(
			'gn_users',
			array( 
				'user_login' => $n[2], 
				'user_pass' => $n[1],
				'user_nicename' => $n[2],
				'user_email' => $n[3],
				'user_registered' => $n[4],
				'display_name' => $n[5]
				)
		);

		$user_id = $wpdb->insert_id;

		wp_set_password($n[1], $user_id);

		/*
		nickname
		first_name
		last_name
		description
		rich_editing
		comment_shortcuts
		admin_color
		use_ssl
		show_admin_bar_front
		locale
		gn_capabilities
		gn_user_level
		dismissed_wp_pointers
		*/

		/*
		0 val.zhanna2012@yandex.ru# 
		1 290566# 
		2 val.zhanna2012@yandex.ru# 
		3 val.zhanna2012@yandex.ru# 
		4 2013-03-16 14:40:04# 
		5 Жанна Валиуллина# 
		6 Жанна# 
		7 Валиуллина# 
		8 910|4215512
		*/

		$phone = explode('|',$n[8]);

		$cast = array('customer' => 1);


		$arr_meta = array(
			'nickname' 			=> $n[2],
			'first_name' 		=> $n[6],
			'last_name' 		=> $n[7],			
			'show_admin_bar_front' => 'false',
			'billing_first_name'=> $n[6],
			'billing_last_name' => $n[7],
			'gn_user_level' 	=> 0,
			'billing_phone' 	=> '+7 ('.$phone[0].') '.$phone[1],
			'billing_email' 	=> $n[3],
			'gn_capabilities' 	=> serialize($cast),
			'user_card'			=> $n[9]
			);

		foreach($arr_meta as $k => $v)
		{
			add_user_meta( $user_id, $k, $v);
		}	

		//echo $user_id.' - '.$n[3].'<br>';
	}
}
/*~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*/
//set_users();


function printArray($arr)
{
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}

$start_time = 0;

function start()
{
	global $start_time;
	// считываем текущее время
	$start_time = microtime();
	// разделяем секунды и миллисекунды
	//(становятся значениями начальных ключей массива-списка)
	$start_array = explode(" ",$start_time);
	// это и есть стартовое время
	$start_time = $start_array[1] + $start_array[0];
}

function stop()
{
	global $start_time;
	// делаем то же, что и в start.php, только используем другие переменные
	$end_time = microtime();
	$end_array = explode(" ",$end_time);
	$end_time = $end_array[1] + $end_array[0];
	// вычитаем из конечного времени начальное
	$time = $end_time - $start_time;
	// выводим в выходной поток (браузер) время генерации страницы
	printf("Страница сгенерирована за %f секунд",$time);
}


/* функция получения следующей родительской категории */
function g_get_top_cat($id)
{
	
	$cat = get_term($id, 'product_cat');
	 
	return array($cat->parent, $cat->slug);
}
/* /функция получения родительской категории */

function g_get_top_cat_slug($product)
{
	//printArray($product);
	// родительская категория товара
	$cat_id = $product->get_category_ids()[0];
	// родительская категория верхнего уровня

	$top_cat_id = g_get_top_cat($cat_id);

	if($top_cat_id[0] > 0)
	{
		while($top_cat_id[0] > 0)
		{
			$a = $top_cat_id[0];
			$top_cat_id = g_get_top_cat($top_cat_id[0]);
		}
	}	

	$top_cat_slug = $top_cat_id[1];

	return $top_cat_slug;
}



class ControlPanel 
{
	// Устанавливаем значения по умолчанию
	var $default_settings = array(
		
	 );

	 var $options;

	 function ControlPanel() 
	 {
		 add_action('admin_menu', array(&$this, 'add_menu'));

		 if (!is_array(get_option('g_options')))
		 	add_option('g_options', $this->default_settings);

		 $this->options = get_option('g_options');
	 }

	 function add_menu() 
	 {
	 	add_theme_page('WP Theme Options', 'Опции сайта', 8, "g_options", array(&$this, 'optionsmenu'));
	 }

	 // Сохраняем значения формы с настройками 
	 function optionsmenu() 
	 {

	 	$arr_options = array(
	 		'Email-адреса салонов' => array(
	 				array(
	 					'title' =>'Email салона на Ленинском',
	 					'name' => 'email_salon_leninsky',
	 					'type' => 'text'
	 					),
	 				array(
	 					'title' =>'Email салона на Коломенской',
	 					'name' => 'email_salon_kolom',
	 					'type' => 'text'
	 					),
	 				array(
	 					'title' =>'Email салона на Братиславской',
	 					'name' => 'email_salon_bratis',
	 					'type' => 'text'
	 					),
	 				array(
	 					'title' =>'Email салона на Соколе',
	 					'name' => 'email_salon_sokol',
	 					'type' => 'text'
	 					),
	 				array(
	 					'title' =>'Email салона на Сходненской',
	 					'name' => 'email_salon_shodnya',
	 					'type' => 'text'
	 					),
	 				array(
	 					'title' =>'Email Дом красоты на м. Аэропорт',
	 					'name' => 'email_salon_dom_krasoty',
	 					'type' => 'text'
	 					)
	 				
	 			),

	 		'Email-адреса администратора(ов)' => array(
	 				array(
	 					'title' =>'Email администратора(ов)',
	 					'name' => 'email_admin',
	 					'type' => 'text'
	 					)				
	 				
	 			),

	 		'Опции' => array(
	 				array(
	 					'title' =>'Отправлять письма только администратору(ам)',
	 					'name' => 'mail_to_admin_only',
	 					'type' => 'checkbox'
	 					)
	 			),

	 		'Социальные сети' => array(
	 				array(
	 					'title' =>'OK',
	 					'name' => 'social_ok',
	 					'type' => 'text'
	 					),
	 				array(
	 					'title' =>'VK',
	 					'name' => 'social_vk',
	 					'type' => 'text'
	 					),	
	 				array(
	 					'title' =>'Twitter',
	 					'name' => 'social_tw',
	 					'type' => 'text'
	 					),
	 				array(
	 					'title' =>'Facebook',
	 					'name' => 'social_fb',
	 					'type' => 'text'
	 					),
	 				array(
	 					'title' =>'Youtube',
	 					'name' => 'social_yt',
	 					'type' => 'text'
	 					),
	 				array(
	 					'title' =>'Instagram',
	 					'name' => 'social_in',
	 					'type' => 'text'
	 					)		
	 				
	 			),

	 		'Блоки на главной' => array(
	 				array(
	 					'title' =>'Слайдер Промо',
	 					'name' => 'on_main_promo',
	 					'type' => 'checkbox'
	 					),
	 				array(
	 					'title' =>'Сертификаты',
	 					'name' => 'on_main_sertif',
	 					'type' => 'checkbox'
	 					),	
	 				array(
	 					'title' =>'Новости',
	 					'name' => 'on_main_news',
	 					'type' => 'checkbox'
	 					),
	 				array(
	 					'title' =>'Услуги',
	 					'name' => 'on_main_service',
	 					'type' => 'checkbox'
	 					),
	 				array(
	 					'title' =>'Дизайнеры',
	 					'name' => 'on_main_designers',
	 					'type' => 'checkbox'
	 					),
	 				array(
	 					'title' =>'Блок Имидж',
	 					'name' => 'on_main_image',
	 					'type' => 'checkbox'
	 					),
	 				array(
	 					'title' =>'Бутик',
	 					'name' => 'on_main_butik',
	 					'type' => 'checkbox'
	 					),
	 				array(
	 					'title' =>'Салоны',
	 					'name' => 'on_main_salons',
	 					'type' => 'checkbox'
	 					),	
	 				array(
	 					'title' =>'Галерея',
	 					'name' => 'on_main_gallery',
	 					'type' => 'checkbox'
	 					),
	 				array(
	 					'title' =>'Блок "Свяжитесь с нами"',
	 					'name' => 'on_main_callus',
	 					'type' => 'checkbox'
	 					),
	 				
	 			),

	 		);

		 if ($_POST['ss_action'] == 'save') 
		 {

		 	foreach($arr_options as $block => $opts)
		 	{
		 		foreach($opts as $opt)
		 		{
		 			$this->options[$opt['name']] = $_POST[$opt['name']];
		 		}
		 	}

			 update_option('g_options', $this->options);
			 echo '<div class="updated fade" id="message" style="background-color: rgb(255, 251, 204); width: 400px; margin: 25px 20px 0 2px;"><p>Ваши изменения <strong>сохранены</strong>.</p></div>';
		 }

		 // Создаем форму для настроек
		 echo '<form action="" method="post" class="themeform">';
		 echo '<input type="hidden" id="ss_action" name="ss_action" value="save">';

		 print '<div class="cptab"><br />';

		 foreach($arr_options as $block => $opts)
		 {
		 	?><h3><?=$block?></h3><?

		 	foreach($opts as $opt)
		 	{
		 		switch($opt['type'])
		 		{
		 			case 'text':
			 			?><p><input placeholder="<?=$opt['title']?>" style="width:300px;" name="<?=$opt['name']?>" id="<?=$opt['name']?>" value="<?=$this->options[$opt['name']]?>">
			 			<label for="<?=$opt['name']?>"> - <?=$opt['title']?> [<?=$opt['name']?>]</label></p><?
			 			break;
			 		case 'checkbox':
			 			?><p><input type="checkbox" name="<?=$opt['name']?>" id="<?=$opt['name']?>" <? if($this->options[$opt['name']]) echo 'checked';?> > <label  for="<?=$opt['name']?>"> - <?=$opt['title']?> [<?=$opt['name']?>]</label></p><?
			 			break;

			 		default: break;
		 		}
		 		
		 	}
		 }
		
		 print '</div><br />';
		 echo '<input type="submit" value="Сохранить" name="cp_save" class="dochanges" />';
		 echo '</form>';

		 echo '<div class="update-nag">Код вставки опции &lt;?=get_option(&#039;g_options&#039;)[&#039;option_name&#039;]?&gt;</div>';
	 }
}

$cpanel = new ControlPanel();
$mytheme = get_option('g_options');
?>