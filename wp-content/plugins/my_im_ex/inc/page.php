<?

require_once 'class.prlist.php';

$icon_view      = '<img title="Просмотр страницы продукта"  src="/wp-content/themes/gantil/img/icon/view7.png">';
$icon_new_win   = '<img title="Редактировать продукт (в новом окне)"  src="/wp-content/themes/gantil/img/icon/new_win.png">';

$arr 		= array();
$list 		= array();
$arr_root 	= array();
$butik      = false;

$prlist 	= new PRLIST();

$prlist->cid  = 79; // по умолчанию - УСЛУГИ

if($_POST['salon'])
    $prlist->salon  = $_POST['salon'];
else
    $prlist->salon 	= '';

// получим массив специальностей вида array( stilist => '')
$arrSpec = $prlist -> getSpec();

$arr_s_n = array(
    'salon_leninsky'    => 'в салоне на Ленинском',
    'salon_bratis'      => 'в салоне на Братиславской',
    'salon_sokol'       => 'в салоне на Соколе',
    'salon_kolom'       => 'в салоне на Коломенской',
    'salon_shodnya'     => 'в салоне на Сходненской',
    'salon_dom_krasoty' => 'в салоне Дом Красоты'
    );



/* получим все КОРНЕВЫЕ КАТЕГОРИИ каталога УСЛУГИ в виде массива
Array
(
    [0] => WP_Term Object
        (
            [term_id] => 46
            [name] => Парикмахерские услуги
            [slug] => parikmaherskie-uslugi
            [term_group] => 0
            [term_taxonomy_id] => 46
            [taxonomy] => product_cat
            [description] => 
            [parent] => 79
            [count] => 0
            [filter] => raw
            [term_order] => 1
        )

    [1] => WP_Term Object
        (
            [term_id] => 47
            [name] => Ногтевой сервис
            [slug] => nogtevoj-servis
            [term_group] => 0
            [term_taxonomy_id] => 47
            [taxonomy] => product_cat
            [description] => 
            [parent] => 79
            [count] => 0
            [filter] => raw
            [term_order] => 2
        )

    [2] => WP_Term Object
        (
            [term_id] => 48
            [name] => Косметология
            [slug] => kosmetologija
            [term_group] => 0
            [term_taxonomy_id] => 48
            [taxonomy] => product_cat
            [description] => 
            [parent] => 79
            [count] => 0
            [filter] => raw
            [term_order] => 3
        )

    [3] => WP_Term Object
        (
            [term_id] => 49
            [name] => Студия загара
            [slug] => studija-zagara
            [term_group] => 0
            [term_taxonomy_id] => 49
            [taxonomy] => product_cat
            [description] => 
            [parent] => 79
            [count] => 2
            [filter] => raw
            [term_order] => 4
        )

    [4] => WP_Term Object
        (
            [term_id] => 50
            [name] => Тайский и балийский массаж
            [slug] => tajskij-i-balijskij-massazh
            [term_group] => 0
            [term_taxonomy_id] => 50
            [taxonomy] => product_cat
            [description] => 
            [parent] => 79
            [count] => 0
            [filter] => raw
            [term_order] => 5
        )

    [5] => WP_Term Object
        (
            [term_id] => 183
            [name] => Имиджконсультирование
            [slug] => imidzhkonsultirovanie
            [term_group] => 0
            [term_taxonomy_id] => 183
            [taxonomy] => product_cat
            [description] => 
            [parent] => 79
            [count] => 0
            [filter] => raw
            [term_order] => 6
        )
)*/



$arr_root = $prlist->getRootCats(); 

// получим раздел каталога УСЛУГИ по его ID
// если его нет в GET, то возьмем первый из массива корневых категорий 

if($_POST['product-category'])
    $prlist->pid  = $_POST['product-category'];
else
    $prlist->pid  = $arr_root[0]->term_id;


/* получим массив подкатегорий категории PID вида
Array
(
    [0] => Array
        (
            [term_id] => 51
            [name] => Для господ
            [slug] => dlja-gospod
            [parent] => 46
            [arr_child] => 
        )

    [1] => Array
        (
            [term_id] => 160
            [name] => Стрижки и укладки
            [slug] => strizhki-i-ukladki
            [parent] => 46
            [arr_child] => 
        )

    [2] => Array
        (
            [term_id] => 161
            [name] => Окрашивание
            [slug] => okrashivanie
            [parent] => 46
            [arr_child] => 
        )

    [3] => Array
        (
            [term_id] => 162
            [name] => Уходы, лечение и восстановление
            [slug] => uhody-lechenie-i-vosstanovlenie
            [parent] => 46
            [arr_child] => 
        )

    [4] => Array
        (
            [term_id] => 163
            [name] => Лечебная стрижка горячими ножницами
            [slug] => lechebnaya-strizhka-goryachimi-nozhnitsami
            [parent] => 46
            [arr_child] => 
        )

    [5] => Array
        (
            [term_id] => 164
            [name] => Макияж и оформление бровей
            [slug] => makiyazh-i-oformlenie-brovej
            [parent] => 46
            [arr_child] => 
        )

    [6] => Array
        (
            [term_id] => 165
            [name] => Колорирование и Блондирование
            [slug] => kolorirovanie-i-blondirovanie
            [parent] => 46
            [arr_child] => 
        )

    [7] => Array
        (
            [term_id] => 166
            [name] => Мелирование и Брондирование
            [slug] => melirovanie-i-brondirovanie
            [parent] => 46
            [arr_child] => 
        )

    [8] => Array
        (
            [term_id] => 167
            [name] => Ламинирование и биоламинирование
            [slug] => laminirovanie-i-biolaminirovanie
            [parent] => 46
            [arr_child] => 
        )

    [9] => Array
        (
            [term_id] => 168
            [name] => Химия
            [slug] => himiya
            [parent] => 46
            [arr_child] => 
        )

    [10] => Array
        (
            [term_id] => 169
            [name] => Наращивание волос
            [slug] => narashhivanie-volos
            [parent] => 46
            [arr_child] => 
        )
)
*/
$arr = $prlist->getCat();


/* получим дерево категории в упрощенном виде
Array
(
    [0] => Array
        (
            [lvl] => 0
            [id] => 51
            [name] => Для господ
        )

    [1] => Array
        (
            [lvl] => 0
            [id] => 160
            [name] => Стрижки и укладки
        )

    [2] => Array
        (
            [lvl] => 0
            [id] => 161
            [name] => Окрашивание
        )

    [3] => Array
        (
            [lvl] => 0
            [id] => 162
            [name] => Уходы, лечение и восстановление
        )

    [4] => Array
        (
            [lvl] => 0
            [id] => 163
            [name] => Лечебная стрижка горячими ножницами
        )

    [5] => Array
        (
            [lvl] => 0
            [id] => 164
            [name] => Макияж и оформление бровей
        )

    [6] => Array
        (
            [lvl] => 0
            [id] => 165
            [name] => Колорирование и Блондирование
        )

    [7] => Array
        (
            [lvl] => 0
            [id] => 166
            [name] => Мелирование и Брондирование
        )

    [8] => Array
        (
            [lvl] => 0
            [id] => 167
            [name] => Ламинирование и биоламинирование
        )

    [9] => Array
        (
            [lvl] => 0
            [id] => 168
            [name] => Химия
        )

    [10] => Array
        (
            [lvl] => 0
            [id] => 169
            [name] => Наращивание волос
        )
)
*/
if(empty($arr))
    $list[] = array(
        'lvl'   => 0,
        'id'    => $prlist->pid,
        'name'  => '',
        'slug'  => ''
        );
else
    $list = $prlist->getCatElem($arr);


?>
<link rel="stylesheet" href="/wp-content/plugins/my_im_ex/lib/css/theme.default.css">
<link rel="stylesheet" href="/wp-content/plugins/my_im_ex/lib/css/style.css">

<script src="http://code.jquery.com/jquery.min.js"></script>
<script src="/wp-content/plugins/my_im_ex/lib/js/jquery.tablesorter.min.js"></script>
<script src="/wp-content/plugins/my_im_ex/lib/js/script.js"></script>

<div class="wrap">
	<h1></h1>
						<!-- content -->						
						<div class="row-fluid">
							<div class="container-fluid content">
								<div class="content-article price-list">
								<div>
									<div class="row-fluid">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<h1>Цены на услуги <?=$arr_s_n[$prlist->salon]?> <?php /*the_title();*/?> </h1>	
										</div>
											
										<div class="col-md-6 col-sm-6 col-xs-12">
											

                                            <!-- форма выбора -->
		                                    <div style="clear:both">
		                                        <form method="post" id="form-price">
		                                            
                                                    <!-- выбор салона -->    			                                        
													<select id="select-salon" name="salon">
														<option value="">Выберите салон</option>											
														<?php

														foreach ($prlist->getSalons() as $k => $v) 
														{
															$sel = '';
															if(isset($_POST['salon']) && $_POST['salon'] == $v->slug) 
																$sel = 'selected';
															?>
															
															<option value="<?=$v->slug?>" <?=$sel?>><?=$v->name?></option>
															<?	
														}
														?>
													</select> 
                                                    <!-- /выбор салона -->



                                                    <!-- выбор категории услуг-->
                                                    <?php
                                                    //printArray($arr_root);
                                                    ?>
                                                    <select id="select-category" name="product-category">
                                                        <option value="">Выберите категорию услуг</option> 
                                                        <?
                                                        $arr_full = $prlist->getFullTree( $prlist->cid );

                                                        foreach($arr_full as $k => $v)
                                                        {
                                                            $sel = '';

                                                            if(isset($_POST['product-category']) && $_POST['product-category'] == $v['id']) 
                                                                $sel = 'selected';
                                                            ?>
                                                            <option value="<?=$v['id']?>" <?=$sel?>><?=$v['step'].$v['name'].'('.$v['count'].')'?></option> 
                                                            <?
                                                        }

                                                        /*foreach($arr_root as $k => $v)
                                                        {
                                                            $sel = '';

                                                            if(isset($_POST['product-category']) && $_POST['product-category'] == $v->term_id) 
                                                                $sel = 'selected';
                                                            ?>
                                                            <option value="<?=$v->term_id?>" <?=$sel?>><?=$v->name?></option> 
                                                            <?
                                                        }*/
                                                        ?>
                                                       <!--  <option value="80">Бутик</option> -->
                                                    </select>

                                                    <!-- /выбор категории услуг-->

                                                    <input type="submit" value="OK">

		                                        </form>                                        
		                                    </div>
		                                    <div style="clear:both"></div>
		                                    <!-- /форма выбора -->


										</div>

									</div>
								</div>
								<div style="clear:both"></div>


									
									
									<div>
										<table id="table-prlist" align="center" border=1 width=100% cellpadding=10>	
											<!-- шапка таблицы -->
                                            <thead>
											<tr align=center>
												<th class="item-num"></th>												
												<th class="item-name">Услуга</th>												
												<!-- <th class="item-param">Инфо</th> -->
												<th class="item-param">Параметр</th>
												<?
                                                    // специализации
													foreach($prlist->arr_spec as $k => $v)
													{
														?><th class="item-spec"><?=$v?></th><?
													}
												?>																					
											</tr>	
                                        </thead>
											<!-- /шапка таблицы -->		

                                        <tbody>
							   				<?
							   				//$i = 1;

							   				$empty = "Нет услуг";

							   				if($prlist->salon)
							   				{
							   					
							   					foreach($list as $k => $v)
												{
													
													$goods = array();

													// услуги подкатегории
													$goods = $prlist -> getCatItems($v['id']);

													
													foreach($goods as $obj)
													{													
															
														$n = $obj->post_title;
														$m = '';	
														
														
														$arr_str = $prlist->getVariations($obj->ID, $arrSpec);

																												
														foreach($arr_str as $main_key => $pr)
														{
                                                            $arr = $prlist->arr_spec;
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
																	<td><? /*$i++*/ ?></td>	
                                                                    <!-- /wp-admin/post.php?post=1486&action=edit -->																
																	<!-- <td class="item-name"><a href="/product/<?=$obj->post_name?>/"><?=$m?></a></td> -->
                                                                    <td class="item-name">
                                                                        <a href="/wp-admin/post.php?post=<?=$obj->ID?>&action=edit" title="Редактировать продукт"><?=$m?></a>
                                                                        <a href="/wp-admin/post.php?post=<?=$obj->ID?>&action=edit" title="Редактировать продукт в новом окне" target="blank"><?=$icon_new_win?></a>
                                                                        
                                                                        <a href="/product/<?=$obj->post_name?>/" target="_blank" class="icon-view"><?=$icon_view?></a>
                                                                        <!-- <a href="/product/<?=$obj->post_name?>/"><?=$m?></a> -->
                                                                    </td>
																	<!-- <td><?=$pr['_variation_description']?></td> -->
																	<?
																}
																else
																	echo '
																	<td></td>
																	<td class="item-name-hide">'.$m.'</td>
																	<!--<td>'.$pr['_variation_description'].'</td>-->';
																?>
																
																<td>
																	<?
																	// ключевой параметр товара
																	$a = get_term_by('slug', $main_key, 'pa_main-key' );
																	echo $a->name;
																	?>
																</td>
																
																<?
																// цены
                                                                

                                                                

																foreach($pr as $s => $p)
																{
																	if($s == '_variation_description')
																		continue;
																	?>
																	<td align="center"><? 
                                                                     
                                                                    $prlist->getPriceCell($p['vid'], $p['price'], $obj->ID);?></td>
																	<?
																}
																?>
															</tr>
															<?
														}
													}											
												}
							   				}
							   				else
							   				{
							   					echo 'Выберите салон';
							   				}							   					
											
									   		?>
                                        </tbody>
									   	</table>


										


											

							   		</div>									
								</div>
							</div>
						</div>
						<!-- /content -->
					


</div>

