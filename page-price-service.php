<?php
/*
Template Name: Цены на услуги (test)
*/

require_once 'controllers/priceController.php';

$plist = new priceController;

$salon = '';

if(isset($_GET['salon'])){
    $_SESSION['salon'] = $_GET['salon'];
}


if(isset($_SESSION['salon']))
	$salon = $_SESSION['salon'];

get_header(); 
?>

<?
start();
?>

<?php
// массив салонов ('salon_leninsky' => 'в салоне на Ленинском',)
$arr_s_n = $plist->arr_s_n;

// массив специальностей ('veduschiispetcialist' => 'Индивидуальный специалист',)
$arr_spec = $plist->arr_spec;

// массив специальностей ('veduschiispetcialist')
$arr3 = array();
foreach($arr_spec as $k => $v)
	$arr3[$k] = '';

// получим все корневые разделы каталога УСЛУГИ
$arr_root = $plist -> getRootCat(79);

// получим раздел каталога УСЛУГИ по его ID
if(!$_GET['cid'])
	$_GET['cid'] = $arr_root[0]->term_id;

// получим дерево подкатегорий товаров категории $_GET['cid']
$arr = $plist->getCatTree($_GET['cid']);

if(empty($arr)){
	$arr[] = array(
		'term_id' => $_GET['cid'],
		'name' => '',
		'slug' => '',
		'parent' => 79,
		'arr_child' => array()
		);
}

// преобразуем дерево подкатегорий в простой список
$list = $plist->getCatElems($arr);
//printArray($list); //die;
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

                                        <div>
                                            <a href="#" class="show-all">Развернуть все</a>
                                            <a href="#" class="hide-all">Свернуть все</a>
                                        </div>

										<table align="center">	
											<!-- шапка таблицы -->
											<tr align=center id="header">
												<th class="item-num"></th>
												<th class="item-name">Услуга</th>
												<th class="item-param">Инфо</th>
												<th class="item-param">Параметр</th>
												<?
                                                foreach($arr_spec as $k => $v){
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
							   					foreach($list as $k => $v)
												{
                                                    $goods = $plist->getCatItems($v['id']);
                                                    $cat_id = $v['id'];

                                                    $num = 0;
                                                    foreach($goods as $obj){
                                                        $arr_num = $plist->getItemData($obj->ID);
                                                        $arr_obj[$obj->ID] = [];

                                                        if(count($arr_num)){
                                                            $num++;
                                                            $arr_obj[$obj->ID] = $arr_num;
                                                        }
                                                    }

                                                    if(!$num && $v['lvl'] > 0)
                                                        continue;

												    ?>
                                                    <tr class="category-name-tr" id="<?=$cat_id?>">
                                                        <td></td>
                                                        <td><h<?= 3+$v['lvl']?> class="category-name"><i class="fa fa-caret-right" style="padding:0 10px 0 0" aria-hidden="true"></i><?= $v['name']?> <?/*= $num*/?></h<?= 3+$v['lvl']?>></td>
                                                        <td></td>
                                                        <td></td>
                                                        <? for($j = 0; $j < count($arr_spec); $j++) echo '<td></td>'; ?>
                                                        <td></td>
                                                    </tr>
                                                    <?php
													foreach($goods as $obj)
													{
													    // наименование товара
														$n = $obj->post_title;
														$m = '';

														// все вариации товара
                                                        $arr_str = $arr_obj[$obj->ID];//$plist->getItemData($obj->ID);

														foreach($arr_str as $main_key => $pr)
														{
															$arr = $arr_spec;
                                                            foreach($arr as $k => $v)
                                                            {
                                                                if(isset($pr[$k]))
                                                                    $arr[$k] = $pr[$k];
                                                                else
                                                                    $arr[$k] = '';
                                                            }
                                                            $pr = $arr;
															?>
															<tr class="category-item-<?=$cat_id?>">
																<?
                                                                // наименование товара и описание товара
																if($m != $n)
																{
																	$m = $n;
																	?>
																	<td><?=$i++?></td>
																	<td class="item-name"><a href="/product/<?=$obj->post_name?>/"><?=$m?></a></td>
																	<td><?=@$pr['_variation_description']?></td>
                                                                    <?
																}
																else
																	echo '<td></td><td class="item-name-hide">'.$m.'</td><td>'.@$pr['_variation_description'].'</td>';
																?>

																<td><?= $plist->getMainKey($main_key); /* ключевой параметр товара */?></td>
																
																<?= $plist->getPriceString($pr); /* строка цен на товар для разных вариаций */?>

																<td><a href="/product/<?=$obj->post_name?>/">заказать</a></td>															
															</tr>
															<?
														}
														
													}
													//endif;
												}
							   				}
							   				else
							   				{
                                                $args = array(
                                                    'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
                                                    'parent'   => 26,
                                                    'orderby'  => 'name',
                                                    'order'    => 'ASC'
                                                );

                                                $categories = get_categories($args);
                                                ?>
                                                <!-- <a class="btn" data-popup-open="popup-1" href="#">Open Popup #1</a> -->

                                                <div class="form-set-salon">
                                                    <div class="">
                                                        <h3>Для продолжения выберите салон</h3>
                                                        <p>
                                                        <ul>
                                                            <?
                                                            foreach ($categories as $k => $v)
                                                            {
                                                                $sel = '';
                                                                if(isset($_SESSION['salon']) && $_SESSION['salon'] == $v->slug)
                                                                    $sel = 'active-salon';
                                                                ?>
                                                                <!--<li><a href="#" class="<?/*=$sel*/?>" data-name="<?/*=$v->slug*/?>"><?/*=$v->name*/?></a></li>-->
                                                                <li><a href="?salon=<?=$v->slug?>" class="<?=$sel?>" data-name="<?=$v->slug?>"><?=$v->name?></a></li>
                                                                <?
                                                            }
                                                            ?>
                                                        </ul>

                                                        </p>
                                                    </div>
                                                </div>

                                                <?php
							   				}
											
									   		?>
									   	</table>

									   	<? //get_template_part('inc/popup_set_salon');?>

										<script language="javascript">
											function set_salon2(s)
											{
												$.ajax({
													type: "POST",
												  	url: '/wp-content/themes/gantil/ajax/set.salon.php',
												  	data: "salon="+s,
												  	success: function(data)
												  	{
												    	//location.reload();
                                                        window.location.replace('/prices/price-service/');
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
											    /*var save_salon = false;*/
											    <?
											    /*if(!$_SESSION['salon'])
											    {*/
											    	?>
											    	//var save_salon = true;
											    	<?
											    /*}*/
											    ?>

											    /*if(save_salon)
											    	$('.popup').fadeIn(350);*/
											 
											    //----- CLOSE
											    /*$('[data-popup-close]').on('click', function(e)
											    {
											        var targeted_popup_class = jQuery(this).attr('data-popup-close');
											        $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
											 
											        e.preventDefault();
											    });*/

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
											    $(".price-list table tr:even").not('.price-list table tr.category-name-tr').addClass("even");
												$(".price-list table tr:odd").not('.price-list table tr.category-name-tr').addClass("odd");
												/* /подсветка строк */

												/* спойлеры */

												$('.show-all').click(function (e) {
                                                    $('.even, .odd').show();
                                                    $('.fa').removeClass('fa-caret-right').addClass('fa-caret-down');
                                                    return false;
                                                })

                                                $('.hide-all').click(function (e) {
                                                    $('.even, .odd').hide();
                                                    $('.fa').removeClass('fa-caret-down').addClass('fa-caret-right');
                                                    return false;
                                                })

											    $('.category-name-tr').click(function(e){

                                                    var obj = $(this).find('.fa').eq(0);
                                                    var block = $('.category-item-'+$(this).attr('id'));

                                                    if($(obj).hasClass('fa-caret-down')){
                                                        $(obj).removeClass('fa-caret-down').addClass('fa-caret-right');
                                                    }
                                                    else
                                                        $(obj).removeClass('fa-caret-right').addClass('fa-caret-down');


                                                    $(block).toggle('fast');
											    });

											    /* /спойлеры */

											    $('.even, .odd').not('#header').hide();

											    $('.price-list table').show();


											    /* смена салона */
											    $('#select-salon').change(function()
                                                {
                                                	if($(this).val() != 'all')
                                                		set_salon2($(this).val())   
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
<style>
    .show-all, .hide-all{
        margin:0 20px 0 0;
    }

table{min-width: 400px}
.category-name-tr h3,
.category-name-tr h4{cursor: pointer;}
.category-name-tr h3:hover,
.category-name-tr h4:hover{text-decoration: underline;}
.tr-hidden{display: none;}

/* tr.even, tr.odd{
	display: none;
}  */
</style>
