<?php

/* Initials*/
require_once( 'f.php' );

	add_action('init', 'myStartSession', 1);
	function myStartSession() 
	{
	    if(!session_id()) {
	        session_start();
	    }
	}

	/* явно укажем MAX размер загружаемого файла */
	add_filter( 'upload_size_limit', 'PBP_increase_upload' );
	 function PBP_increase_upload( $bytes )
	 {
	 	return 6291456; // 6 megabyte
	 }

	define('STM_DOMAIN', 'stm_domain');
	require_once( 'post_types.class.php' );

	//require_once( 'posts/news.php' );	

	require_once( 'posts/galleries.php' );

	require_once( 'posts/masters.php' );

	require_once( 'posts/designers.php' );

	//require_once( 'posts/sertif.php' );

	add_image_size( 'sertif_thumb', 275, 180, true );
	add_image_size( 'news_thumb_b', 515, 515, true );
	add_image_size( 'news_thumb_s', 485, 185, true );
	add_image_size( 'news_thumb_m', 485, 290, true );

	add_image_size( 'salon_thumb', 490, 325, true );

	add_image_size( 'imageconsult_thumb', 1530, 240, true );
	add_image_size( 'imageconsult_thumb_mobi', 460, 307, true );

	add_image_size( 'gallery_thumb', 490, 490, true );

	add_image_size( 'partners_thumb', 210, 250, true );

	add_image_size( 'subscr_thumb', 1600, 375, true );

	add_image_size( 'master_thumb', 211, 211, true );

	//add_image_size( 'shop_catalog', 353, 253, true );

	/* подключение UI */

	/*if (!is_admin()) 
	{
   		wp_enqueue_script("jquery-ui-core", array('jquery'));
  	}*/

	if (!is_admin()) 
	{
		wp_enqueue_script("jquery-ui-dialog", array('jquery','jquery-ui-core'));
   	}	

   /* /подключение UI */

   if ( function_exists('register_sidebars') )
		register_sidebars(2, array(
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
		));




	/* WOOCOMMERCE */

	/*add_action('wc_add_notice', 'my');
	function my()
	{
		wc_add_notice( 'test', 'success' );
	}*/

	// Display variation's price even if min and max prices are the same
	/*add_filter('woocommerce_available_variation', function ($value, $object = null, $variation = null) {
	  if ($value['price_html'] == '') {
	    $value['price_html'] = '<span class="price">' . $variation->get_price_html() . '</span>';
	  }
	  return $value;
	}, 10, 3);*/
	

	// сделаем woocommerce поддерживаемым плагином
	add_action( 'after_setup_theme', 'woocommerce_support' );
	function woocommerce_support() 
	{
	    add_theme_support( 'woocommerce' );
	}



	// уберем счетчик товаров в категория/подкатегориях
	add_filter( 'woocommerce_subcategory_count_html', 'jk_hide_category_count' );
	function jk_hide_category_count() 
	{
	}

	add_filter ('woocommerce_ajax_variation_threshold','woocommerce_ajax_variation_threshold_more',10,2);
	function woocommerce_ajax_variation_threshold_more($count,$product) {
	return 500;
	}


	// уберем из карточки услуги выбор количества
	add_filter( 'woocommerce_is_sold_individually', 'wc_remove_all_quantity_fields', 10, 2 );
	function wc_remove_all_quantity_fields( $return, $product ) 
	{

		//return true;
	}

	// ???
	// add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );  
	// function custom_override_checkout_fields( $fields ) {
	 
	// 	// unset($fields['billing']['billing_first_name']);
	// 	// return $fields;
	// }

	// со страницы услуги (карточки товара) уберем вкладку ДОП.ИНФ-Я и ПОХОЖИЕ
	add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tab', 98);
	function woo_remove_product_tab($tabs) {

	    //unset( $tabs['description'] );              // Remove the description tab
	    unset( $tabs['reviews'] );                     // Remove the reviews tab
	    unset( $tabs['additional_information'] );      // Remove the additional information tab

	   	return $tabs;
	}
		
	// уберем ПОХОЖИЕ ТОВАРЫ
	remove_action( 'woocommerce_after_single_product_summary','woocommerce_output_related_products', 20);

	// уберем ссылки КАТЕГОРИИ/ПОДКАТЕГОРИИ данной услуги
	remove_action( 'woocommerce_single_product_summary','woocommerce_template_single_meta', 40);


	// заменить ВЫБРАТЬ ОПЦИЮ на -----
	add_filter('woocommerce_dropdown_variation_attribute_options_args','my_variation_attribute_options_args',10,1);
	function my_variation_attribute_options_args($args){
		$args['show_option_none'] = '------';
		return $args;
	}



	// вывод название категорий/подкатегорий услуг
	remove_action('woocommerce_shop_loop_subcategory_title','woocommerce_template_loop_category_title', 10);
	add_action('woocommerce_shop_loop_subcategory_title','gantil_woocommerce_template_loop_category_title', 10);
	function gantil_woocommerce_template_loop_category_title($category)
	{
		?>
		<h2 class="woocommerce-loop-category__title box">
			<?php echo $category->name;	?>
		</h2>
		<?php
	}

	add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
  
	function custom_override_checkout_fields( $fields ) {
	 
	 	/*unset($fields['billing']['billing_first_name']);
		unset($fields['billing']['billing_last_name']);*/
		unset($fields['billing']['billing_company']);
		unset($fields['billing']['billing_address_1']);
		unset($fields['billing']['billing_address_2']);
		unset($fields['billing']['billing_city']);
		unset($fields['billing']['billing_postcode']);
		unset($fields['billing']['billing_country']);
		unset($fields['billing']['billing_state']);
	    return $fields;
	}




	
	/**
 * Load jQuery datepicker.
 *
 * By using the correct hook you don't need to check `is_admin()` first.
 * If jQuery hasn't already been loaded it will be when we request the
 * datepicker script.
 */
function wpse_enqueue_datepicker() {
    // Load the datepicker script (pre-registered in WordPress).
    wp_enqueue_script( 'jquery-ui-datepicker' );

    // You need styling for the datepicker. For simplicity I've linked to Google's hosted jQuery UI CSS.
    wp_register_style( 'jquery-ui', 'http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css' );
    wp_enqueue_style( 'jquery-ui' );  
}
add_action( 'wp_enqueue_scripts', 'wpse_enqueue_datepicker' );

	/* /WOOCOMMERCE */

	

/* Зададим области меню */
register_nav_menus(array(
	'top'    => 'Верхнее меню',    //Название месторасположения меню в шаблоне
	'right' => 'Правое меню',      //Название другого месторасположения меню в шаблоне
	'bottom' => 'Нижнее меню',      //Название другого месторасположения меню в шаблоне
	'menu-news'	=> 'Подменю Новости'
));
/* /Зададим области меню */


/* Включим миниатюры постов */
if ( function_exists( 'add_theme_support' ) )
	add_theme_support( 'post-thumbnails' ); 
/* /Включим миниатюры постов */

//add_filter( 'pre_option_link_manager_enabled', '__return_true' );


add_action('init', 'rewrite_rule_my');  
function rewrite_rule_my(){
    //add_rewrite_tag('%salon%','([^&]+)'); // Регистрируем параметр genre
    add_rewrite_tag('%salon%', '([^&]+)');
    //add_rewrite_tag('%country%','([^&]+)'); // // Регистрируем параметр country
    add_rewrite_rule('^/price-service/([^/]*)/?$','index.php?pagename=price-service&salon=$matches[1]','top'); // Добавляем новое правило, 3-й параметр top говорит о том, что правило необходимо проверять первым.
}


/*```````````````````````````*/
/* Создание новой таксономии */
/*```````````````````````````*/

function add_new_taxonomies() {	
/* создаем функцию с произвольным именем и вставляем 
в неё register_taxonomy() */	
	register_taxonomy('master',
		array('page'),
		array(
			'hierarchical' => false,
			/* true - по типу рубрик, false - по типу меток, 
			по умолчанию - false */
			'labels' => array(
				/* ярлыки, нужные при создании UI, можете
				не писать ничего, тогда будут использованы
				ярлыки по умолчанию */
				'name' => 'Мастера',
				'singular_name' => 'Мастер',
				'search_items' =>  'Найти мастера',
				'popular_items' => 'Популярные мастера',
				'all_items' => 'Все мастера',
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => 'Редактировать мастера', 
				'update_item' => 'Обновить мастера',
				'add_new_item' => 'Добавить нового мастера',
				'new_item_name' => 'Название нового мастера',
				'separate_items_with_commas' => 'Разделяйте мастеров запятыми',
				'add_or_remove_items' => 'Добавить или удалить мастера',
				'choose_from_most_used' => 'Выбрать из наиболее часто используемых мастеров',
				'menu_name' => 'Мастера'
			),
			'public' => true, 
			/* каждый может использовать таксономию, либо
			только администраторы, по умолчанию - true */
			'show_in_nav_menus' => true,
			/* добавить на страницу создания меню */
			'show_ui' => true,
			/* добавить интерфейс создания и редактирования */
			'show_tagcloud' => false,
			/* нужно ли разрешить облако тегов для этой таксономии */
			'update_count_callback' => '_update_post_term_count',
			/* callback-функция для обновления счетчика $object_type */
			'query_var' => true,
			/* разрешено ли использование query_var, также можно 
			указать строку, которая будет использоваться в качестве 
			него, по умолчанию - имя таксономии */
			'rewrite' => array(
			/* настройки URL пермалинков */
				'slug' => 'master', // ярлык
				'hierarchical' => false // разрешить вложенность
 
			),
		)
	);
}
//add_action( 'init', 'add_new_taxonomies', 1 );
/*```````````````````````````*/
/* /Создание новой таксономии */
/*```````````````````````````*/






/**
 * Хлебные крошки для WordPress (breadcrumbs)
 *
 * @param  string [$sep  = '']      Разделитель. По умолчанию ' » '
 * @param  array  [$l10n = array()] Для локализации. См. переменную $default_l10n.
 * @param  array  [$args = array()] Опции. См. переменную $def_args
 * @return string Выводит на экран HTML код
 *
 * version 3.3.1
 */
function kama_breadcrumbs( $sep = ' » ', $l10n = array(), $args = array() ){
	$kb = new Kama_Breadcrumbs;
	echo $kb->get_crumbs( $sep, $l10n, $args );
}

class Kama_Breadcrumbs {

	public $arg;

	// Локализация
	static $l10n = array(
		'home'       => 'Главная',
		'paged'      => 'Страница %d',
		'_404'       => 'Ошибка 404',
		'search'     => 'Результаты поиска по запросу - <b>%s</b>',
		'author'     => 'Архив автора: <b>%s</b>',
		'year'       => 'Архив за <b>%d</b> год',
		'month'      => 'Архив за: <b>%s</b>',
		'day'        => '',
		'attachment' => 'Медиа: %s',
		'tag'        => 'Записи по метке: <b>%s</b>',
		'tax_tag'    => '%1$s из "%2$s" по тегу: <b>%3$s</b>',
		// tax_tag выведет: 'тип_записи из "название_таксы" по тегу: имя_термина'.
		// Если нужны отдельные холдеры, например только имя термина, пишем так: 'записи по тегу: %3$s'
	);

	// Параметры по умолчанию
	static $args = array(
		'on_front_page'   => false,  // выводить крошки на главной странице
		'show_post_title' => true,  // показывать ли название записи в конце (последний элемент). Для записей, страниц, вложений
		'show_term_title' => true,  // показывать ли название элемента таксономии в конце (последний элемент). Для меток, рубрик и других такс
		'title_patt'      => '<span class="kb_title active">%s</span>', // шаблон для последнего заголовка. Если включено: show_post_title или show_term_title
		'last_sep'        => true,  // показывать последний разделитель, когда заголовок в конце не отображается
		'markup'          => 'schema.org', // 'markup' - микроразметка. Может быть: 'rdf.data-vocabulary.org', 'schema.org', '' - без микроразметки
										   // или можно указать свой массив разметки:
										   // array( 'wrappatt'=>'<div class="kama_breadcrumbs">%s</div>', 'linkpatt'=>'<a href="%s">%s</a>', 'sep_after'=>'', )
		'priority_tax'    => array('category'), // приоритетные таксономии, нужно когда запись в нескольких таксах
		'priority_terms'  => array(), // 'priority_terms' - приоритетные элементы таксономий, когда запись находится в нескольких элементах одной таксы одновременно.
									  // Например: array( 'category'=>array(45,'term_name'), 'tax_name'=>array(1,2,'name') )
									  // 'category' - такса для которой указываются приор. элементы: 45 - ID термина и 'term_name' - ярлык.
									  // порядок 45 и 'term_name' имеет значение: чем раньше тем важнее. Все указанные термины важнее неуказанных...
		'nofollow' => false, // добавлять rel=nofollow к ссылкам?

		// служебные
		'sep'             => '',
		'linkpatt'        => '',
		'pg_end'          => '',
	);

	function get_crumbs( $sep, $l10n, $args ){
		global $post, $wp_query, $wp_post_types;

		self::$args['sep'] = $sep;

		// Фильтрует дефолты и сливает
		$loc = (object) array_merge( apply_filters('kama_breadcrumbs_default_loc', self::$l10n ), $l10n );
		$arg = (object) array_merge( apply_filters('kama_breadcrumbs_default_args', self::$args ), $args );

		$arg->sep = '<span class="kb_sep">'. $arg->sep .'</span>'; // дополним

		// упростим
		$sep = & $arg->sep;
		$this->arg = & $arg;

		// микроразметка ---
		if(1){
			$mark = & $arg->markup;

			// Разметка по умолчанию
			if( ! $mark ) $mark = array(
				'wrappatt'  => '<div class="breadcrumb">%s</div>',
				'linkpatt'  => '<a href="%s">%s</a>',
				'sep_after' => '',
			);
			// rdf
			elseif( $mark === 'rdf.data-vocabulary.org' ) $mark = array(
				'wrappatt'   => '<div class="breadcrumb" prefix="v: http://rdf.data-vocabulary.org/#">%s</div>',
				'linkpatt'   => '<span typeof="v:Breadcrumb"><a href="%s" rel="v:url" property="v:title">%s</a>',
				'sep_after'  => '</span>', // закрываем span после разделителя!
			);
			// schema.org
			elseif( $mark === 'schema.org' ) $mark = array(
				'wrappatt'   => '<div class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">%s</div>',
				'linkpatt'   => '<span itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="%s" itemprop="item"><span itemprop="name">%s</span></a></span>',
				'sep_after'  => '',
			);

			elseif( ! is_array($mark) )
				die( __CLASS__ .': "markup" parameter must be array...');

			$wrappatt  = $mark['wrappatt'];
			$arg->linkpatt  = $arg->nofollow ? str_replace('<a ','<a rel="nofollow"', $mark['linkpatt']) : $mark['linkpatt'];
			$arg->sep      .= $mark['sep_after']."\n";
		}

		$linkpatt = $arg->linkpatt; // упростим

		$q_obj = get_queried_object();

		// может это архив пустой таксы?
		$ptype = null;
		if( empty($post) ){
			if( isset($q_obj->taxonomy) )
				$ptype = & $wp_post_types[ get_taxonomy($q_obj->taxonomy)->object_type[0] ];
		}
		else $ptype = & $wp_post_types[ $post->post_type ];

		// paged
		$arg->pg_end = '';
		if( ($paged_num = get_query_var('paged')) || ($paged_num = get_query_var('page')) )
			$arg->pg_end = $sep . sprintf( $loc->paged, (int) $paged_num );

		$pg_end = $arg->pg_end; // упростим

		// ну, с богом...
		$out = '';

		if( is_front_page() ){
			return $arg->on_front_page ? sprintf( $wrappatt, ( $paged_num ? sprintf($linkpatt, get_home_url(), $loc->home) . $pg_end : $loc->home ) ) : '';
		}
		// страница записей, когда для главной установлена отдельная страница.
		elseif( is_home() ) {
			$out = $paged_num ? ( sprintf( $linkpatt, get_permalink($q_obj), esc_html($q_obj->post_title) ) . $pg_end ) : esc_html($q_obj->post_title);
		}
		elseif( is_404() ){
			$out = $loc->_404;
		}
		elseif( is_search() ){
			$out = sprintf( $loc->search, esc_html( $GLOBALS['s'] ) );
		}
		elseif( is_author() ){
			$tit = sprintf( $loc->author, esc_html($q_obj->display_name) );
			$out = ( $paged_num ? sprintf( $linkpatt, get_author_posts_url( $q_obj->ID, $q_obj->user_nicename ) . $pg_end, $tit ) : $tit );
		}
		elseif( is_year() || is_month() || is_day() ){
			$y_url  = get_year_link( $year = get_the_time('Y') );

			if( is_year() ){
				$tit = sprintf( $loc->year, $year );
				$out = ( $paged_num ? sprintf($linkpatt, $y_url, $tit) . $pg_end : $tit );
			}
			// month day
			else {
				$y_link = sprintf( $linkpatt, $y_url, $year);
				$m_url  = get_month_link( $year, get_the_time('m') );

				if( is_month() ){
					$tit = sprintf( $loc->month, get_the_time('F') );
					$out = $y_link . $sep . ( $paged_num ? sprintf( $linkpatt, $m_url, $tit ) . $pg_end : $tit );
				}
				elseif( is_day() ){
					$m_link = sprintf( $linkpatt, $m_url, get_the_time('F'));
					$out = $y_link . $sep . $m_link . $sep . get_the_time('l');
				}
			}
		}
		// Древовидные записи
		elseif( is_singular() && $ptype->hierarchical ){
			$out = $this->_add_title( $this->_page_crumbs($post), $post );
		}
		// Таксы, плоские записи и вложения
		else {
			$term = $q_obj; // таксономии

			// определяем термин для записей (включая вложения attachments)
			if( is_singular() ){
				// изменим $post, чтобы определить термин родителя вложения
				if( is_attachment() && $post->post_parent ){
					$save_post = $post; // сохраним
					$post = get_post($post->post_parent);
				}

				// учитывает если вложения прикрепляются к таксам древовидным - все бывает :)
				$taxonomies = get_object_taxonomies( $post->post_type );
				// оставим только древовидные и публичные, мало ли...
				$taxonomies = array_intersect( $taxonomies, get_taxonomies( array('hierarchical' => true, 'public' => true) ) );

				if( $taxonomies ){
					// сортируем по приоритету
					if( ! empty($arg->priority_tax) ){
						usort( $taxonomies, function($a,$b)use($arg){
							$a_index = array_search($a, $arg->priority_tax);
							if( $a_index === false ) $a_index = 9999999;

							$b_index = array_search($b, $arg->priority_tax);
							if( $b_index === false ) $b_index = 9999999;

							return ( $b_index === $a_index ) ? 0 : ( $b_index < $a_index ? 1 : -1 ); // меньше индекс - выше
						} );
					}

					// пробуем получить термины, в порядке приоритета такс
					foreach( $taxonomies as $taxname ){
						if( $terms = get_the_terms( $post->ID, $taxname ) ){
							// проверим приоритетные термины для таксы
							$prior_terms = & $arg->priority_terms[ $taxname ];
							if( $prior_terms && count($terms) > 2 ){
								foreach( (array) $prior_terms as $term_id ){
									$filter_field = is_numeric($term_id) ? 'term_id' : 'slug';
									$_terms = wp_list_filter( $terms, array($filter_field=>$term_id) );

									if( $_terms ){
										$term = array_shift( $_terms );
										break;
									}
								}
							}
							else
								$term = array_shift( $terms );

							break;
						}
					}
				}

				if( isset($save_post) ) $post = $save_post; // вернем обратно (для вложений)
			}

			// вывод

			// все виды записей с терминами или термины
			if( $term && isset($term->term_id) ){
				$term = apply_filters('kama_breadcrumbs_term', $term );

				// attachment
				if( is_attachment() ){
					if( ! $post->post_parent )
						$out = sprintf( $loc->attachment, esc_html($post->post_title) );
					else {
						if( ! $out = apply_filters('attachment_tax_crumbs', '', $term, $this ) ){
							$_crumbs    = $this->_tax_crumbs( $term, 'self' );
							$parent_tit = sprintf( $linkpatt, get_permalink($post->post_parent), get_the_title($post->post_parent) );
							$_out = implode( $sep, array($_crumbs, $parent_tit) );
							$out = $this->_add_title( $_out, $post );
						}
					}
				}
				// single
				elseif( is_single() ){
					if( ! $out = apply_filters('post_tax_crumbs', '', $term, $this ) ){
						$_crumbs = $this->_tax_crumbs( $term, 'self' );
						$out = $this->_add_title( $_crumbs, $post );
					}
				}
				// не древовидная такса (метки)
				elseif( ! is_taxonomy_hierarchical($term->taxonomy) ){
					// метка
					if( is_tag() )
						$out = $this->_add_title('', $term, sprintf( $loc->tag, esc_html($term->name) ) );
					// такса
					elseif( is_tax() ){
						$post_label = $ptype->labels->name;
						$tax_label = $GLOBALS['wp_taxonomies'][ $term->taxonomy ]->labels->name;
						$out = $this->_add_title('', $term, sprintf( $loc->tax_tag, $post_label, $tax_label, esc_html($term->name) ) );
					}
				}
				// древовидная такса (рибрики)
				else {
					if( ! $out = apply_filters('term_tax_crumbs', '', $term, $this ) ){
						$_crumbs = $this->_tax_crumbs( $term, 'parent' );
						$out = $this->_add_title( $_crumbs, $term, esc_html($term->name) );                     
					}
				}
			}
			// влоежния от записи без терминов
			elseif( is_attachment() ){
				$parent = get_post($post->post_parent);
				$parent_link = sprintf( $linkpatt, get_permalink($parent), esc_html($parent->post_title) );
				$_out = $parent_link;

				// вложение от записи древовидного типа записи
				if( is_post_type_hierarchical($parent->post_type) ){
					$parent_crumbs = $this->_page_crumbs($parent);
					$_out = implode( $sep, array( $parent_crumbs, $parent_link ) );
				}

				$out = $this->_add_title( $_out, $post );
			}
			// записи без терминов
			elseif( is_singular() ){
				$out = $this->_add_title( '', $post );
			}
		}

		// замена ссылки на архивную страницу для типа записи
		$home_after = apply_filters('kama_breadcrumbs_home_after', '', $linkpatt, $sep, $ptype );

		if( '' === $home_after ){
			// Ссылка на архивную страницу типа записи для: отдельных страниц этого типа; архивов этого типа; таксономий связанных с этим типом.
			if( $ptype && $ptype->has_archive && ! in_array( $ptype->name, array('post','page','attachment') )
				&& ( is_post_type_archive() || is_singular() || (is_tax() && in_array($term->taxonomy, $ptype->taxonomies)) )
			){
				$pt_title = $ptype->labels->name;

				// первая страница архива типа записи
				if( is_post_type_archive() && ! $paged_num )
					$home_after = $pt_title;
				// singular, paged post_type_archive, tax
				else{
					$home_after = sprintf( $linkpatt, get_post_type_archive_link($ptype->name), $pt_title );

					$home_after .= ( ($paged_num && ! is_tax()) ? $pg_end : $sep ); // пагинация
				}
			}
		}

		$before_out = sprintf( $linkpatt, home_url(), $loc->home ) . ( $home_after ? $sep.$home_after : ($out ? $sep : '') );

		$out = apply_filters('kama_breadcrumbs_pre_out', $out, $sep, $loc, $arg );

		$out = sprintf( $wrappatt, $before_out . $out );

		return apply_filters('kama_breadcrumbs', $out, $sep, $loc, $arg );
	}

	function _page_crumbs( $post ){
		$parent = $post->post_parent;

		$crumbs = array();
		while( $parent ){
			$page = get_post( $parent );
			$crumbs[] = sprintf( $this->arg->linkpatt, get_permalink($page), esc_html($page->post_title) );
			$parent = $page->post_parent;
		}


		return implode( $this->arg->sep, array_reverse($crumbs) );
	}

	function _tax_crumbs( $term, $start_from = 'self' ){
		$termlinks = array();
		$term_id = ($start_from === 'parent') ? $term->parent : $term->term_id;
		while( $term_id ){
			$term       = get_term( $term_id, $term->taxonomy );
			$termlinks[] = sprintf( $this->arg->linkpatt, get_term_link($term), esc_html($term->name) );
			$term_id    = $term->parent;
		}

		if( $termlinks )
			return implode( $this->arg->sep, array_reverse($termlinks) ) /*. $this->arg->sep*/;
		return '';
	}

	// добалвяет заголовок к переданному тексту, с учетом всех опций. Добавляет разделитель в начало, если надо.
	function _add_title( $add_to, $obj, $term_title = '' ){
		$arg = & $this->arg; // упростим...
		$title = $term_title ? $term_title : esc_html($obj->post_title); // $term_title чиститься отдельно, теги моугт быть...
		$show_title = $term_title ? $arg->show_term_title : $arg->show_post_title;

		// пагинация
		if( $arg->pg_end ){
			$link = $term_title ? get_term_link($obj) : get_permalink($obj);
			$add_to .= ($add_to ? $arg->sep : '') . sprintf( $arg->linkpatt, $link, $title ) . $arg->pg_end;
		}
		// дополняем - ставим sep
		elseif( $add_to ){
			if( $show_title )
				$add_to .= $arg->sep . sprintf( $arg->title_patt, $title );
			elseif( $arg->last_sep )
				$add_to .= $arg->sep;
		}
		// sep будет потом...
		elseif( $show_title )
			$add_to = sprintf( $arg->title_patt, $title );

		return $add_to;
	}

}

/* /Хлебные крошки для WordPress (breadcrumbs) */



/**
 * The separate sub-menu
 *
 * Optional $args contents:
 *
 * container - Whether to wrap the ul, and what to wrap it with. Defaults to 'nav'.
 * container_id - The ID that is applied to the container. Defaults to blank.
 * container_class - the class that is applied to the container. Defaults to 'sub-menu-container'.
 * submenu_class - CSS class to use for the ul element which forms the menu. Defaults to 'sub-menu'.
 * string xpath - xPath expression.
 * echo - Whether to echo the menu or return it. Defaults to echo.
 *
 * @author Oleg Murashov <o.murashov@gmail.com>
 * @link http://omurashov.ru/wordpress/separate-output-menu-and-submenu/ Documentation
 * @param array $args Arguments
 * @return string|void.
 */
// function get_submenu($args) {
//     $defaults = array(
//         'container' => 'nav',
//         'container_id' => '',
//         'container_class' => 'sub-menu-container',
//         'submenu_class' => 'sub-menu',
//         'submenu_id' => '',
//         'xpath' => "./li[contains(@class,'current-menu-item') or contains(@class,'current-menu-ancestor')]/ul",
//         'theme_location' => '',
//         'echo' => true
//     );

//     $args = wp_parse_args( $args, $defaults );
//     $args = (object) $args;
 
//     $menu = wp_nav_menu(
//         array(
//             'theme_location' => $args->theme_location,
//             'container' => '',
//             'echo' => false
//         )
//     );

//     $menu = simplexml_load_string($menu);

//     $submenu = $menu->xpath($args->xpath);

//     if (empty($submenu)) {
//         return;
//     }

//     // Set value of class attribute
//     $submenu[0]['class'] = $args->submenu_class;

//     // Add "id" attribute
//     if ($args->submenu_id) {
//         $submenu[0]->addAttribute('id', $args->submenu_id);
//     }

//     if ($args->container) {
//         $submenu_sxe = simplexml_load_string($submenu[0]->saveXML());
//         $sdm = dom_import_simplexml($submenu_sxe);

//         if ($sdm) {
//             $xmlDoc = new DOMDocument('1.0', 'utf-8');
//             $container = $xmlDoc->createElement($args->container);

//             // Add "class" attribute for container
//             if ($args->container_class) {
//                 $container->setAttribute('class', $args->container_class);
//             }

//             // Add "id" attribute for container
//             if ($args->container_id) {
//                 $container->setAttribute('id', $args->container_id);
//             }
    
//             $smsx = $xmlDoc->importNode($sdm, true);
//             $container->appendChild($smsx);
//             $xmlDoc->appendChild($container);
//         }
//     }

//     if (isset($xmlDoc)) {
//         $output = $xmlDoc->saveXML();
//     } else {
//         $output = $submenu[0]->saveXML();
//     }

//     if (!$args->echo) {
//         return $output;
//     }

//     echo $output;
// }


// заменяем [...] на далее... в цитате
add_filter('excerpt_more', 'new_excerpt_more');
function new_excerpt_more($more) {
	global $post;
	return ' <a href="'. get_permalink($post->ID) . '">далее...</a>';
}




/**
 * Возможность загружать изображения для элементов указанных таксономий: категории, метки.
 *
 * Пример получения ID и URL картинки термина:
 * $image_id = get_term_meta( $term_id, '_thumbnail_id', 1 );
 * $image_url = wp_get_attachment_image_url( $image_id, 'thumbnail' );
 *
 * @author: Kama (http://wp-kama.ru)
 *
 * @ver: 2.7
 */
if( is_admin() && ! class_exists('Term_Meta_Image') ){
	// init
	//add_action('current_screen', 'Term_Meta_Image_init');
	add_action('admin_init', 'Term_Meta_Image_init');
	function Term_Meta_Image_init(){
		$GLOBALS['Term_Meta_Image'] = new Term_Meta_Image();
	}

	class Term_Meta_Image {

		// для каких таксономий включить код. По умолчанию для всех публичных
		static $taxes = array(); // пример: array('category', 'post_tag');

		// название мета ключа
		static $meta_key = '_thumbnail_id';

		// URL пустой картинки
		static $add_img_url = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkAQMAAABKLAcXAAAABlBMVEUAAAC7u7s37rVJAAAAAXRSTlMAQObYZgAAACJJREFUOMtjGAV0BvL/G0YMr/4/CDwY0rzBFJ704o0CWgMAvyaRh+c6m54AAAAASUVORK5CYII=';

		public function __construct(){
			if( isset($GLOBALS['Term_Meta_Image']) ) return $GLOBALS['Term_Meta_Image']; // once

			$taxes = self::$taxes ? self::$taxes : get_taxonomies( array( 'public'=>true ), 'names' );

			foreach( $taxes as $taxname ){
				add_action("{$taxname}_add_form_fields",   array( & $this, 'add_term_image' ),     10, 2 );
				add_action("{$taxname}_edit_form_fields",  array( & $this, 'update_term_image' ),  10, 2 );
				add_action("created_{$taxname}",           array( & $this, 'save_term_image' ),    10, 2 );
				add_action("edited_{$taxname}",            array( & $this, 'updated_term_image' ), 10, 2 );

				add_filter("manage_edit-{$taxname}_columns",  array( & $this, 'add_image_column' ) );
				add_filter("manage_{$taxname}_custom_column", array( & $this, 'fill_image_column' ), 10, 3 );
			}
		}

		## поля при создании термина
		public function add_term_image( $taxonomy ){
			wp_enqueue_media(); // подключим стили медиа, если их нет

			add_action('admin_print_footer_scripts', array( & $this, 'add_script' ), 99 );
			$this->css();
			?>
			<div class="form-field term-group">
				<label><?php _e('Image', 'default'); ?></label>
				<div class="term__image__wrapper">
					<a class="termeta_img_button" href="#">
						<img src="<?php echo self::$add_img_url ?>" alt="">
					</a>
					<input type="button" class="button button-secondary termeta_img_remove" value="<?php _e( 'Remove', 'default' ); ?>" />
				</div>

				<input type="hidden" id="term_imgid" name="term_imgid" value="">
			</div>
			<?php
		}

		## поля при редактировании термина
		public function update_term_image( $term, $taxonomy ){
			wp_enqueue_media(); // подключим стили медиа, если их нет

			add_action('admin_print_footer_scripts', array( & $this, 'add_script' ), 99 );

			$image_id = get_term_meta( $term->term_id, self::$meta_key, true );
			$image_url = $image_id ? wp_get_attachment_image_url( $image_id, 'thumbnail' ) : self::$add_img_url;
			$this->css();
			?>
			<tr class="form-field term-group-wrap">
				<th scope="row"><?php _e( 'Image', 'default' ); ?></th>
				<td>
					<div class="term__image__wrapper">
						<a class="termeta_img_button" href="#">
							<?php echo '<img src="'. $image_url .'" alt="">'; ?>
						</a>
						<input type="button" class="button button-secondary termeta_img_remove" value="<?php _e( 'Remove', 'default' ); ?>" />
					</div>

					<input type="hidden" id="term_imgid" name="term_imgid" value="<?php echo $image_id; ?>">
				</td>
			</tr>
			<?php
		}

		public function css(){
			?><style>
			.termeta_img_button{ display:inline-block; margin-right:1em; }
			.termeta_img_button img{ display:block; float:left; margin:0; padding:0; min-width:100px; max-width:150px; height:auto; background:rgba(0,0,0,.07); }
			.termeta_img_button:hover img{ opacity:.8; }
			.termeta_img_button:after{ content:''; display:table; clear:both; }
			</style><?php
		}

		## Add script
		public function add_script(){
			// выходим если не на нужной странице таксономии
			//$cs = get_current_screen();
			//if( ! in_array($cs->base, array('edit-tags','term')) || ! in_array($cs->taxonomy, (array) $this->for_taxes) )
			//  return;

			$title = __('Featured Image', 'default');
			$button_txt = __('Set featured image', 'default');
			?>
			<script>
			jQuery(document).ready(function($){
				var frame,
					$imgwrap = $('.term__image__wrapper'),
					$imgid   = $('#term_imgid');

				// добавление
				$('.termeta_img_button').click( function(ev){
					ev.preventDefault();

					if( frame ){ frame.open(); return; }

					// задаем media frame
					frame = wp.media.frames.questImgAdd = wp.media({
						states: [
							new wp.media.controller.Library({
								title:    '<?php echo $title ?>',
								library:   wp.media.query({ type: 'image' }),
								multiple: false,
								//date:   false
							})
						],
						button: {
							text: '<?php echo $button_txt ?>', // Set the text of the button.
						}
					});

					// выбор
					frame.on('select', function(){
						var selected = frame.state().get('selection').first().toJSON();
						if( selected ){
							$imgid.val( selected.id );
							$imgwrap.find('img').attr('src', selected.sizes.thumbnail.url );
						}
					} );

					// открываем
					frame.on('open', function(){
						if( $imgid.val() ) frame.state().get('selection').add( wp.media.attachment( $imgid.val() ) );
					});

					frame.open();
				});

				// удаление
				$('.termeta_img_remove').click(function(){
					$imgid.val('');
					$imgwrap.find('img').attr('src','<?php echo self::$add_img_url ?>');
				});
			});
			</script>

			<?php
		}

		## Добавляет колонку картинки в таблицу терминов
		public function add_image_column( $columns ){
			// подправим ширину колонки через css
			add_action('admin_notices', function(){
				echo '<style>.column-image{ width:50px; text-align:center; }</style>';
			});

			$num = 1; // после какой по счету колонки вставлять

			$new_columns = array( 'image'=>'' ); // колонка без названия...

			return array_slice( $columns, 0, $num ) + $new_columns + array_slice( $columns, $num );
		}

		public function fill_image_column( $string, $column_name, $term_id ){
			// если есть картинка
			if( $image_id = get_term_meta( $term_id, self::$meta_key, 1 ) )
				$string = '<img src="'. wp_get_attachment_image_url( $image_id, 'thumbnail' ) .'" width="50" height="50" alt="" style="border-radius:4px;" />';

			return $string;
		}

		## Save the form field
		public function save_term_image( $term_id, $tt_id ){
			if( ! empty($_POST['term_imgid']) && $image = (int) $_POST['term_imgid'] )
				add_term_meta( $term_id, self::$meta_key, $image, true );

		}

		## Update the form field value
		public function updated_term_image( $term_id, $tt_id ){
			if( empty($_POST['term_imgid']) ) return;

			if( $image = (int) $_POST['term_imgid'] )
				update_term_meta( $term_id, self::$meta_key, $image );
			else
				delete_term_meta( $term_id, self::$meta_key );
		}

	}

}


// add_action('init', 'gantil_register_post_type_gallery');
// function gantil_register_post_type_gallery()
// {
// 	register_post_type('gantil_gallery',
// 		array(
// 			'labels' => array(
// 				'name' => 'Галереи'
// 				),
// 			'query_var' => true,
// 			'public' => true,
// 			'hierarchical'  => true,
// 			'taxonomies' => array('category '),
// 			'rewrite' => array('slug' => 'gallery'),
// 			'supports' => array(
// 				'title', 'editor', 'thumbnail')));
// }

// add_action('init', 'gantil_create_gallery_taxonomy');
// function gantil_create_gallery_taxonomy()
// {
// 	register_taxonomy('galleries', array('gantil_gallery'), array('hierarchical' => true));
// }
?>