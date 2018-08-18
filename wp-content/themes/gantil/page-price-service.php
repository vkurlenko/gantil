<?php
/*
Template Name: Цены на услуги
*/

$salon = '';
if(isset($_SESSION['salon']))
	//$_GET['salon'] = $_SESSION['salon'];
	$salon = $_SESSION['salon'];


get_header(); 
?>


<?
start();
?>

<?php
$arr_s_n = array(
	'salon_leninsky' => 'в салоне на Ленинском',
	'salon_bratis' 	 => 'в салоне на Братиславской',
	'salon_sokol' 	 => 'в салоне на Соколе',
	'salon_kolom' 	 => 'в салоне на Коломенской',
	'salon_shodnya'  => 'в салоне на Сходненской',
	'salon_dom_krasoty' => 'в салоне Дом Красоты'
	);

$arr_spec = array(
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

$arr3 = array();
foreach($arr_spec as $k => $v)
{
	$arr3[$k] = '';
}



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



/**
* сформируем массив вариаций
* Array
* (
*    [dlina-volos-do-30-sm] => Array
*        (
*            [veduschiispetcialist] => 
*            [topstilist] => 1000
*            [stilist] => 700
*            [modelier] => 
*            [universal] => 
*            [veduschiispetcialistnogtevogoservisa] => 
*            [spetcialistnogtevogoservisa] => 
*            [masternogtevogoservisa] => 
*            [kosmetolog] => 
*            [potayuibali] => 
*            [mastertaiskogomassaga] => 
*            [balimaster] => 
*        )
*
* )
*/
function get_item_data2($id)
{
	global $arr3;
	global $wpdb;
	global $salon;

	$sql = "SELECT * FROM `gn_postmeta` 
		WHERE post_id IN (SELECT post_id 
			FROM gn_postmeta 
			WHERE post_id IN (SELECT ID 
				FROM gn_posts 
				WHERE post_parent = ".$id.") 
			AND meta_value = '".$salon."') 
		AND meta_key IN ('_regular_price', 'attribute_pa_main-key', 'attribute_pa_item_spec', 'attribute_pa_item_salon', '_variation_description')";

	$res = $wpdb->get_results($sql);

	/*echo $sql;
	die;*/
	
	$arr1 = $arr2 = array();


	foreach ($res as $row) 
	{
		if($row->meta_key == 'attribute_pa_main-key')		
			$arr2[$row->meta_value] = $arr3;				
				
		$arr1[$row->post_id][$row->meta_key] = $row->meta_value;		
	}

	foreach($arr1 as $var => $param)
	{
		$arr2[$param['attribute_pa_main-key']][$param['attribute_pa_item_spec']] = $param['_regular_price'];	

		if(empty($arr2[$param['attribute_pa_main-key']]['_variation_description'])){

			if(empty($param['_variation_description']))
				$param['_variation_description'] = '';

			$arr2[$param['attribute_pa_main-key']]['_variation_description'] = $param['_variation_description'];	
		}
			
	}
	
	return $arr2;
}

$arr = array();
$list = array();
$arr_root = array();

// получим все корневые разделы каталога УСЛУГИ
$arr_root = get_root_c(79); 


// получим раздел каталога УСЛУГИ по его ID
if(!$_GET['cid'])
	$_GET['cid'] = $arr_root[0]->term_id;

$arr = get_c($_GET['cid']);

//printArray($arr);

if(empty($arr)){
	$arr[] = array(
		'term_id' => $_GET['cid'],
		'name' => '',
		'slug' => '',
		'parent' => 79,
		'arr_child' => array()

		);
	/*
(
            [term_id] => 67
            [name] => Маникюр
            [slug] => manikjur
            [parent] => 47
            [arr_child] => Array
                (
                )

        )
	*/
}
//printArray($arr);

$list = get_c_elem($arr);
//printArray($list);
?>


						<!-- content -->
						
						<div class="row-fluid">
							<div class="container-fluid content">
								
																
								<!-- breadcrumbs -->
								<?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(' > '); ?>
								<!-- /breadcrumbs -->
	
								<div class="content-article price-list">
													
								   		
							   		
									
								<div>
									<div class="row-fluid">
										<div class="col-md-6 col-sm-6 col-xs-12">											
											<h1>Цены на услуги <?=$arr_s_n[$salon]?></h1>	
										</div>
											
										<div class="col-md-6 col-sm-6 col-xs-12">
											<!-- форма выбора салона -->
		                                    <div style="clear:both">
		                                        <form method="post" id="form-price">
		                                            
			                                        <?php 
			                                        $args = array(
													    'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
													    'parent'   => 26,
													    'orderby'  => 'name',
													    'order'    => 'ASC'
													);

													$categories = get_categories($args);

													?>
													<select id="select-salon" name="salon">
														<option value="all">Выберите салон</option>											
														<?php
														foreach ($categories as $k => $v) 
														{
															$sel = '';
															if(isset($_SESSION['salon']) && $_SESSION['salon'] == $v->slug) 
																$sel = 'selected';
															?>
															<!-- <option value="/price/price-service/?salon=<?=$v->slug?>&cid=<?=$_GET['cid']?>" <?=$sel?>><?=$v->name?></option> -->
															<option value="<?=$v->slug?>" <?=$sel?>><?=$v->name?></option>
															<?	
														}
														?>
													</select>                                       
		                                        </form>                                        
		                                    </div>
		                                    <div style="clear:both"></div>
		                                    <!-- /форма выбора салона -->
										</div>

									</div>
								</div>
								<div style="clear:both"></div>
									
									<!-- подменю (категории услуг + БУТИК) -->
									<ul class="submenu">
									<?
									foreach($arr_root as $k => $v)
									{
										?>
										<li ><a <? if($_GET['cid'] == $v->term_id) echo 'class = "active"'; ?> href="/price/price-service/?cid=<?=$v->term_id?>"><?=$v->name?></a></li>
										<?
									}
									?>
										<li ><a href="/price/price-butik/">Бутик</a></li>
									</ul>
									<div style="clear:both"></div>
									<!-- /подменю (категории услуг + БУТИК) -->
									



									<div>
										<table align="center">	
											<!-- шапка таблицы -->
											<tr align=center>
												<th class="item-num"></th>
												<th class="item-name">Услуга</th>
												<th class="item-param">Инфо</th>
												<th class="item-param">Параметр</th>
												<?
													foreach($arr_spec as $k => $v)
													{
														?><th class="item-spec"><?=$v?></th><?
													}
												?>	
												<th></th>												
											</tr>	
											<!-- /шапка таблицы -->		

							   				<?
							   				$i = 1;

							   				$empty = "Нет услуг";

							   				if($salon)
							   				{
							   					//echo count($list);
							   					foreach($list as $k => $v)
												{
													
													$goods = array();

													$goods = get_c_items($v['id']);
													foreach($goods as $obj)
													{													
															
														$n = $obj->post_title;
														$m = '';	
														
														$arr_str = get_item_data2($obj->ID);															
														
														foreach($arr_str as $main_key => $pr)
														{

															$arr = $arr_spec;
                                                            foreach($arr as $k=>$v)
                                                            {
                                                                if(isset($pr[$k]))
                                                                    $arr[$k] = $pr[$k];
                                                                else
                                                                    $arr[$k] = '';
                                                            }

                                                            $pr = $arr;

															?>
															<tr>
																<?
																if($m != $n)
																{
																	$m = $n;
																	?>
																	<td><?=$i++?></td>
																	<td class="item-name"><a href="/product/<?=$obj->post_name?>/"><?=$m?></a></td>
																	<td><?=@$pr['_variation_description']?></td><?
																}
																else
																	echo '
																	<td></td><td class="item-name-hide">'.$m.'</td><td>'.@$pr['_variation_description'].'</td>';
																?>
																
																<td>
																	<?
																	// ключевой параметр товара
																	$a = get_term_by('slug', $main_key, 'pa_main-key' );
																	echo @$a->name;
																	?>
																</td>
																
																<?
																// цены
																foreach($pr as $s => $p)
																{
																	if($s == '_variation_description')
																		continue;
																	?><td><?=$p?></td><?
																}
																?>
																<td><a href="/product/<?=$obj->post_name?>/">заказать</a></td>															
															</tr>
															<?
														}
														
													}											
												}
							   				}
							   				else
							   				{
							   					//echo 'Выберите салон';
							   				}
							   					
											
									   		?>
									   	</table>

									   	<? get_template_part('inc/popup_set_salon');?>

										


											<script language="javascript">

											function set_salon2(s)
											{
												//alert('set');
												$.ajax({
													type: "POST",
												  	url: '/wp-content/themes/gantil/ajax/set.salon.php',
												  	data: "salon="+s,
												  	success: function(data)
												  	{
												  		//alert('succes');
												    	location.reload();
												  	},
												  	error: function()
												  	{
												  		alert('Ошибка сохранения салона');
												  	}
												});
											}

											$(document).ready(function()
											{			
												/* popup выбор салона */

											    //----- OPEN
											    var save_salon = false;
											    <?
											    if(!$_SESSION['salon'])
											    {
											    	?>
											    	var save_salon = true;												 
											    	<?
											    }
											    ?>

											    if(save_salon)
											    	$('.popup').fadeIn(350);
											 
											    //----- CLOSE
											    $('[data-popup-close]').on('click', function(e)  
											    {
											        var targeted_popup_class = jQuery(this).attr('data-popup-close');
											        $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
											 
											        e.preventDefault();
											    });

											    /* /popup выбор салона */
												

												/* удалим пустые столбцы таблицы */

												var i,empty=[];
											    var tr =$('.price-list table tr');
											    for (i=1;i<tr.length;i++){
											         $(tr[i]).children().each(function(j){
											             empty[j]=empty[j] || $(this).html().length;
											        });
											    }
											    for (i=0;i<tr.length;i++){
											         $(tr[i]).children().each(function(j){
											             if (!empty[j]) $(this).remove();
											        });
											    }

											    /* /удалим пустые столбцы таблицы */

											    /* подсветка строк */
											    $(".price-list table tr:even").addClass("even");
												$(".price-list table tr:odd").addClass("odd");
												/* /подсветка строк */

											    $('.price-list table').show()


											    /* смена салона */
											    $('#select-salon').change(function()
                                                {//alert($(this).val())
                                                	if($(this).val() != 'all'){
                                                		//alert($(this).val())
                                                		set_salon2($(this).val())
                                                	}                                                	
                                                		                                                    
                                                })
                                                /* /смена салона */
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
