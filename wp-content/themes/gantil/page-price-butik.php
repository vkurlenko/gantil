<?php
/*
Template Name: Цены бутика
*/

get_header(); 
?>


<?
start();
?>

<?php

$big_table = false;


function get_root_c($cid)
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
		'parent'        => $cid, // родительская категория
		'hierarchical'  => true, 
		'child_of'      => $cid, 
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


// получим все КАТЕГОРИИ товаров (дерево)
function get_c($pid)
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
		'parent'        => $pid, // родительская категория
		'hierarchical'  => true, 
		'child_of'      => $pid, 
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
		$arr_child[] = array(
			'term_id' => $term->term_id,
			'name' => $term->name,
			'slug' => $term->slug,
			'parent' => $term->parent,
			'arr_child' => get_c($term->term_id)
			);
	}

	return $arr_child;
}


// список (дерево) категорий в облегченном виде
function get_c_elem($a)
{		
	//echo 'list';
	$list = array();
	//printArray($a);
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
function get_c_items($slug)
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


function get_item_data2($id)
{
	global $arr3;
	global $wpdb;
	global $big_table;

	$product = wc_get_product($id);
	$t = $product->get_type();

	if($product->is_type('variable'))
	{
		$big_table = true;

		$res = $wpdb->get_results("SELECT * FROM `gn_postmeta` 
			WHERE post_id IN (SELECT post_id 
				FROM gn_postmeta 
				WHERE post_id IN (SELECT ID 
					FROM gn_posts 
					WHERE post_parent = ".$id.") ) 
			AND meta_key IN ('_regular_price', 'attribute_pa_obem')");

		$arr1 = $arr2 = array();


		foreach($res as $row) 
		{
			if($row->meta_key == 'attribute_pa_obem')		
				$arr2[$row->meta_value] = $arr3;			
			
			$arr1[$row->post_id][$row->meta_key] = $row->meta_value;																	
		}

		foreach($arr1 as $var => $param){
			if(empty($param['attribute_pa_obem'])){
				$param['attribute_pa_obem'] = '';
			}
			$arr2[$param['attribute_pa_obem']] = $param['_regular_price'];	
		}
			
	}
	else
	{
		$res = $wpdb->get_results("SELECT meta_value FROM `gn_postmeta` 
				WHERE post_id = ".$id." AND meta_key = '_regular_price'");

		foreach($res as $row)
		{
			$arr2[''] = $row->meta_value;	
		}
	}
	return $arr2;
}

$arr_root = array();

// получим все корневые разделы каталога УСЛУГИ
$arr_root = get_root_c(80); 

// получим раздел каталога УСЛУГИ по его ID
if(!@$_GET['cid'])
	$_GET['cid'] = $arr_root[0]->term_id;

$arr = get_c($_GET['cid']);

$list = get_c_elem($arr);


?>


						<!-- content -->
						
						<div class="row-fluid">
							<div class="container-fluid content">
								
																
								<!-- breadcrumbs -->
								<?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(' > '); ?>
								<!-- /breadcrumbs -->
	
								<div class="content-article price-list">
													
								   		
							   		<h1><?php the_title();?></h1>	
									
									<ul class="submenu">
									<?
									foreach($arr_root as $k => $v)
									{
										?>
										<li ><a <? if($_GET['cid'] == $v->term_id) echo 'class = "active"'; ?> href="/price/price-butik/?cid=<?=$v->term_id?>"><?=$v->name?></a></li>
										<?
									}
									?>
									<li ><a href="/price/price-service/">Услуги</a></li>
									</ul>
									<div style="clear:both"></div>
									<div>
										<table align="center">	
											<!-- шапка таблицы -->
											<tr align=center>
												<th class="item-num"></th>
												<th class="item-name">Наименование товара</th>
												<th class="item-param"></th>
												<th class="item-param">Цена</th>
												
												<th></th>												
											</tr>	
											<!-- /шапка таблицы -->		

							   				<?
							   				$i = 1;
											foreach($list as $k => $v)
											{
												
												$goods = array();

												$goods = get_c_items($v['id']);
																								
												foreach($goods as $obj)
												{													
														
														$n = $obj->post_title;
														$m = '';	

														//echo $obj->ID.' '.$n.'<br>';
														$arr_str = array();
														$arr_str = get_item_data2($obj->ID);

														//printArray($arr_str);
														
														foreach($arr_str as $main_key => $pr)
														{
															?><tr>
																	<?
																	if($m != $n)
																	{
																		$m = $n;
																		?><td><?=$i++?></td><td class="item-name"><a href="/product/<?=$obj->post_name?>/"><?=$m?></a></td><?
																	}
																	else
																		echo '<td></td><td></td>';
																	?>
																
																<td>
																	<?
																	// ключевой параметр товара
																	$a = get_term_by('slug', $main_key, 'pa_obem' );
																	echo @$a->name;
																	?>
																</td>
																<td><?=$pr?></td>
																<td><a href="/product/<?=$obj->post_name?>/">заказать</a></td>
															
															</tr><?


														}
													
												}											
											}
							   				
									   		?>
									   	</table>


											<script language="javascript">
											$(document).ready(function()
											{									

											    $(".price-list table tr:even").addClass("even");
												$(".price-list table tr:odd").addClass("odd");

											    $('.price-list table').show()
											})
											</script>

							   		</div>									
								</div>
							</div>
						</div>
						<!-- /content -->
					</div>
					<!-- /left-block -->
<?
stop();
?>
	<?php
get_footer()
?>
