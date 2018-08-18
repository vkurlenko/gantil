<?

class PRLIST
{
	// салон
	public $salon;

	// массив специальностей
	public $arr_spec = array(
		'veduschiispetcialist' 	=> 'Индивидуальный специалист',
		'topstilist' 			=> 'Топ-стилист',
		'stilist' 				=> 'Стилист',
		'modelier' 				=> 'Модельер',
		'universal'				=> 'Универсал',
		'veduschiispetcialistnogtevogoservisa' => 'Ведущий специалист ногтевого сервиса',
		'spetcialistnogtevogoservisa' => 'Специалист ногтевого сервиса',
		'masternogtevogoservisa' => 'Мастер ногтевого сервиса',
		'kosmetolog' 			=> 'Косметолог',
		'potayuibali' 			=> 'Топ-мастер тайского массажа',
		'mastertaiskogomassaga' => 'Мастер тайского массажа',
		'balimaster' 			=> 'Бали-мастер'	
	);

	// id КОРНЕВОЙ категории 
	public $cid;

	// id категории 
	public $pid;

	
	/* получим массив специальностей для его дальнейшего заполнения ценами вида
	Array
	(
	    [veduschiispetcialist] => 
	    [topstilist] => 
	    [stilist] => 
	    [modelier] => 
	    [universal] => 
	    [veduschiispetcialistnogtevogoservisa] => 
	    [spetcialistnogtevogoservisa] => 
	    [masternogtevogoservisa] => 
	    [kosmetolog] => 
	    [potayuibali] => 
	    [mastertaiskogomassaga] => 
	    [balimaster] => 
	)*/
	public function getSpec()
	{
		$arr = array();
		
		foreach($this->arr_spec as $k => $v)
		{
			$arr[$k] = '';
		}

		return $arr;
	}

	// получим список салонов
	public function getSalons()
	{
		$id = 26;

		$args = array(
		    'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
		    'parent'   => $id,
		    'orderby'  => 'name',
		    'order'    => 'ASC'
		);

		$arr = get_categories($args);

		return $arr;
	}

	// определим название салона по его slug (salon_sokol => Салон на Соколе)
	public function getSalonName($slug)
	{
		$name = '';

		$arr = $this->getSalons();

		foreach ($arr as $k => $v) {
			if ($v->slug == $slug) {
				$name = $v->name;
				break;
			}				
		}

		return $name;
	}



	public function getRootCats()
	{
		$args = array(
			'taxonomy'      => array( 'product_cat'), // название таксономии с WP 4.5
			'orderby'       => 'menu_order', 
			'order'         => 'ASC',
			'hide_empty'    => false, 
			'object_ids'    => null, // 
			'include'       => array(),
			'exclude'       => array(), 
			'exclude_tree'  => array(), 
			'number'        => '', 
			'fields'        => 'all', 
			'count'         => false,
			'slug'          => '', 
			'parent'        => $this->cid, // родительская категория
			'hierarchical'  => true, 
			'child_of'      => $this->cid, 
			'get'           => '', // ставим all чтобы получить все термины
			'name__like'    => '',
			'pad_counts'    => true, 
			'offset'        => '', 
			'search'        => '', 
			'cache_domain'  => 'core',
			'name'          => '', // str/arr поле name для получения термина по нему. C 4.2.
			'childless'     => false, // true не получит (пропустит) термины у которых есть дочерние термины. C 4.2.
			'update_term_meta_cache' => true, // подгружать метаданные в кэш
			'meta_query'    => ''
		); 

		$a = get_terms( $args );

		return $a;
	}


	public function getCat()
	{
		$arr_child = array();

		$args = array(
			'taxonomy'      => array( 'product_cat'), // название таксономии с WP 4.5
			'orderby'       => 'menu_order', 
			'order'         => 'ASC',
			'hide_empty'    => false, 
			'object_ids'    => null, // 
			'include'       => array(),
			'exclude'       => array(), 
			'exclude_tree'  => array(), 
			'number'        => '', 
			'fields'        => 'all', 
			'count'         => false,
			'slug'          => '', 
			'parent'        => $this->pid, // родительская категория
			'hierarchical'  => true, 
			'child_of'      => $this->pid, 
			'get'           => '', // ставим all чтобы получить все термины
			'name__like'    => '',
			'pad_counts'    => true, 
			'offset'        => '', 
			'search'        => '', 
			'cache_domain'  => 'core',
			'name'          => '', // str/arr поле name для получения термина по нему. C 4.2.
			'childless'     => false, // true не получит (пропустит) термины у которых есть дочерние термины. C 4.2.
			'update_term_meta_cache' => true, // подгружать метаданные в кэш
			'meta_query'    => ''
		); 

		$a = get_terms( $args );

		foreach( $a as $term )
		{
			$this->pid = $term->term_id;
			$arr_child[] = array(
				'term_id' 	=> $term->term_id,
				'name' 		=> $term->name,
				'slug' 		=> $term->slug,
				'parent' 	=> $term->parent,
				'arr_child' => $this->getCat()
				);
		}

		return $arr_child;
	}


	// список (дерево) категорий в облегченном виде
	public function getCatElem($a)
	{
		
		$list = array();
		

		foreach($a as $k => $v)
		{
			$list[] = array(
				'lvl'	=> 0,
				'id'	=> $v['term_id'],
				'name' 	=> $v['name'],
				/*'slug'	=> $v['slug'],*/
				);

			if(!empty($v['arr_child']))
			{
				foreach($v['arr_child'] as $k1 => $v1)
				{
					$list[] = array(
						'lvl'	=> 1,
						'id'	=> $v1['term_id'],
						'name'  => $v1['name'],
						'slug'	=> $v1['slug']
						);

					if(!empty($v1['arr_child']))
					{
						foreach($v1['arr_child'] as $k2 => $v2)
						{
							$list[] = array(
								'lvl'	=> 2,
								'id'	=> $v2['term_id'],
								'name'  => $v2['name'],
								'slug'	=> $v2['slug']
								);

							if(!empty($v2['arr_child']))
							{
								foreach($v2['arr_child'] as $k3 => $v3)
								{
									$list[] = array(
										'lvl'	=> 3,
										'id'	=> $v3['term_id'],
										'name'  => $v3['name'],
										'slug'	=> $v3['slug']

										);
									if(!empty($v3['arr_child']))
									{
										foreach($v3['arr_child'] as $k4 => $v4)
										{
											$list[] = array(
												'lvl'	=> 4,
												'id'	=> $v4['term_id'],
												'name' => $v4['name'],
												'slug'	=> $v4['slug']
												);
										}
									}
								}
							}						
						}
					}
				}
			}
		}

		return $list;
	}


	// список услуг (товаров) категории $slug
	public function getCatItems($slug)
	{
		$args = array(
			'tax_query' => array(
				array(
					'taxonomy' => 'product_cat',
					//'field'    => 'slug',
					'field'    => 'term_id',
					'terms'    => $slug,
					'include_children' => false
				)
			),
			'post_type' => 'product',
			'posts_per_page' => -1,
			'meta_key'    => '',
			'meta_value'  =>'',
			'orderby'       => 'menu_order', 
			'order'         => 'ASC',
		);

		$goods = get_posts( $args );

		
		return $goods;
	}


	// получим все вариации продукта
	public function getVariations($product_id, $arrSpec, $butik=false)
	{
		global $wpdb;
		
		$sql = "SELECT * FROM `gn_postmeta` where post_id=".$product_id."
				AND meta_key = '_sku'";


		
		$res = $wpdb->get_results($sql);

		$sku = $res[0]->meta_value;		

		$sql = "SELECT * FROM `gn_postmeta` 
				WHERE post_id IN (SELECT post_id 
					FROM gn_postmeta 
					WHERE post_id IN (SELECT ID 
						FROM gn_posts 
						WHERE post_parent = ".$product_id.") 
					AND meta_value = '".$this->salon."') 
				AND meta_key IN ('_regular_price', 'attribute_pa_main-key', 'attribute_pa_item_spec', 'attribute_pa_item_salon')";
				
		$res = $wpdb->get_results($sql);
		/*printArray($res);
		echo $res; die;*/
		
		$arr1 = $arr2 = array();


		foreach ($res as $row) 
		{
			if($row->meta_key == 'attribute_pa_main-key')	
			{				
				$arr2[$row->meta_value] = $arrSpec;
			}			
					

			$arr1[$row->post_id][$row->meta_key] = $row->meta_value;
			$arr1[$row->post_id]['variation_id'] = $row->post_id;				
		}

		foreach($arr1 as $var => $param)
		{
			$arr2[$param['attribute_pa_main-key']][$param['attribute_pa_item_spec']] = array(
				'vid' 	=> $param['variation_id'], 
				'price' => $param['_regular_price']
			);					
		}


		return $arr2;
	}



	// получим все вариации продукта (Бутик)
	public function getVariations3($product_id, $arrSpec, $butik=false)
	{
		global $wpdb;
		
		$sql = "SELECT * FROM `gn_postmeta` where post_id=".$product_id."
				AND meta_key = '_sku'";

		
		$res = $wpdb->get_results($sql);

		$sku = $res[0]->meta_value;		

		$sql = "SELECT * FROM `gn_postmeta` 
				WHERE post_id IN (SELECT post_id 
					FROM gn_postmeta 
					WHERE post_id IN (SELECT ID 
						FROM gn_posts 
						WHERE post_parent = ".$product_id.") 
					) 
				AND meta_key IN ('_regular_price', 'attribute_pa_obem', 'attribute_pa_item_salon')";
				//echo $sql;
		$res = $wpdb->get_results($sql);

		
		$arr1 = $arr2 = array();


		foreach ($res as $row) 
		{
			if($row->meta_key == 'attribute_pa_obem')	
			{				
				$arr2[$row->meta_value] = $arrSpec;
			}			
					

			$arr1[$row->post_id][$row->meta_key] = $row->meta_value;
			$arr1[$row->post_id]['variation_id'] = $row->post_id;			
		}

		foreach($arr1 as $var => $param)
		{
			//if(isset($param['attribute_pa_obem']))	{		
				$arr2[@$param['attribute_pa_obem']][$param['attribute_pa_item_salon']] = array(
					'vid' 	=> $param['variation_id'], 
					'price' => $param['_regular_price']
				);	
			//}				
		}

		return $arr2;
	}

	/*  
		получим диапазон цен на услугу в зависимости от выбранного салона, если он есть,
		или диапазон цен по всем салонам (array)
	*/	
	public function getPriceRange($product_id, $salon = '')
	{
		global $wpdb;

		$sql = "SELECT * FROM `gn_postmeta` 
				WHERE post_id IN (SELECT post_id 
					FROM gn_postmeta 
					WHERE post_id IN (SELECT ID 
						FROM gn_posts 
						WHERE post_parent = ".$product_id.")";
		if($salon)
			$sql .= "AND meta_value = '".$salon."'";

		$sql .= ") AND meta_key IN ('_regular_price', 'attribute_pa_main-key', 'attribute_pa_item_spec', 'attribute_pa_item_salon')";"
				AND meta_value = '".$salon."') 
			AND meta_key IN ('_regular_price', 'attribute_pa_main-key', 'attribute_pa_item_spec', 'attribute_pa_item_salon')";
		
		$res = $wpdb->get_results($sql);

		$range = array();

		foreach ($res as $k => $v) {
			if ($v->meta_key == '_regular_price') {
				if(!in_array($v->meta_value, $range) && $v->meta_value != '' && $v->meta_value > 0)
						$range[] = $v->meta_value;
			}
		}

		return $range;
	}

	// получим корневую категорию услуги или товара
	public function get_top_term( $taxonomy, $post_id = 0 ) 
	{
		/*if( isset($post_id->ID) ) 
			$post_id = $post_id->ID;

		if( ! $post_id )          
			$post_id = get_the_ID();*/

		$terms = get_the_terms( $post_id, $taxonomy );

		if( ! $terms || is_wp_error($terms) ) return $terms;

		// только первый
		$term = array_shift( $terms );

		// найдем ТОП
		$parent_id = $term->parent;
		while( $parent_id ){
			$term = get_term_by( 'id', $parent_id, $term->taxonomy );
			$parent_id = $term->parent;
		}

		return $term;
	}


	// ячейка таблицы с ценой вариации
	// getPriceCell(id вариации продукта, цена вариации, id продукта)
	public function getPriceCell($vid, $price, $pid)
	{
		if(!$price)
			$price = '-';
		if($vid)
			echo '
		<div id="'.$vid.'" data-pid="'.$pid.'" class="var-cell">
			<input class="var-id" type="hidden"  value="'.$vid.'">
			<span class="var-id-span">vid='.$vid.'</span>
			<span class="var-price">'.$price.'</span>			
		</div>';
	}


	/* полный список категорий корневого раздела (все УСЛУГИ, весь БУТИК) */
	public function getFullTree( $service_id )
	{

		$arr = array();

		$args = array(
		    'taxonomy'      => array( 'product_cat' ), // название таксономии с WP 4.5
		    'orderby'       => 'id', 
		    'order'         => 'ASC',
		    'hide_empty'    => true, 
		    'object_ids'    => null, // 
		    'include'       => array(),
		    'exclude'       => array(), 
		    'exclude_tree'  => array(), 
		    'number'        => '', 
		    'fields'        => 'all', 
		    'count'         => false,
		    'slug'          => '', 
		    'parent'        => '',
		    'hierarchical'  => true, 
		    'child_of'      => $service_id, 
		    'get'           => '', // ставим all чтобы получить все термины
		    'name__like'    => '',
		    'pad_counts'    => false, 
		    'offset'        => '', 
		    'search'        => '', 
		    'cache_domain'  => 'core',
		    'name'          => '', // str/arr поле name для получения термина по нему. C 4.2.
		    'childless'     => false, // true не получит (пропустит) термины у которых есть дочерние термины. C 4.2.
		    'update_term_meta_cache' => true, // подгружать метаданные в кэш
		    'meta_query'    => '',
		); 

		$myterms = get_terms( $args );
		
		foreach( $myterms as $term ){  
		   
		    $step = '';
		    for($i = 0; $i < count(get_ancestors( $term->term_id, 'category')); $i++)
		        $step .= '&nbsp;&nbsp;&nbsp;';

		    $arr[] = array(
		    	'step' 	=> $step,
		    	'id'	=> $term->term_id,
		    	'name'	=> $term->name,
		    	'count'	=> $term->count
		    	);
		}

		return $arr;
	}
	/* /полный список категорий корневого раздела (все УСЛУГИ, весь БУТИК) */	
}







