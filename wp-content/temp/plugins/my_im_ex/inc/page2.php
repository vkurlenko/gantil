<?
require_once 'class.prlist.php';

$icon_view      = '<img title="Просмотр страницы продукта"  src="/wp-content/themes/gantil/img/icon/view7.png">';
$icon_new_win   = '<img title="Редактировать продукт (в новом окне)"  src="/wp-content/themes/gantil/img/icon/new_win.png">';

$arr 		= array();
$list 		= array();
$arr_root 	= array();

$prlist 	= new PRLIST();



/* получим все КОРНЕВЫЕ КАТЕГОРИИ каталога БУТИК в виде массива
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

$prlist->cid  = 80; // по умолчанию - БУТИК

$arr_root = $prlist->getRootCats(); 


// получим раздел каталога БУТИК по его ID
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

//printArray($arr);


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
$list = $prlist->getCatElem($arr);
//printArray($list);

?>
<link rel="stylesheet" href="/wp-content/plugins/my_im_ex/lib/css/theme.default.css">
<script src="http://code.jquery.com/jquery.min.js"></script>
<script src="/wp-content/plugins/my_im_ex/lib/js/jquery.tablesorter.min.js"></script>

<div class="wrap">
	<h1></h1>
						<!-- content -->						
						<div class="row-fluid">
							<div class="container-fluid content">
								<div class="content-article price-list">
								<div>
									<div class="row-fluid">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<h1>Цены бутика</h1>	
										</div>
											
										<div class="col-md-6 col-sm-6 col-xs-12">
											

                                            <!-- форма выбора -->
		                                    <div style="clear:both">
		                                        <form method="post" id="form-price">                   
                                                    
                                                    <!-- выбор категории услуг-->
                                                    <select id="select-category" name="product-category">
                                                        <option value="">Выберите категорию товаров бутика</option> 
                                                        <?
                                                        foreach($arr_root as $k => $v)
                                                        {
                                                            $sel = '';

                                                            if(isset($_POST['product-category']) && $_POST['product-category'] == $v->term_id) 
                                                                $sel = 'selected';
                                                            ?>
                                                            <option value="<?=$v->term_id?>" <?=$sel?>><?=$v->name?></option> 
                                                            <?
                                                        }
                                                        ?>
                                                        
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
												<th class="item-name">Товар</th>												
												<th class="item-param">Параметр</th>																																
											</tr>	
                                        </thead>
											<!-- /шапка таблицы -->		

                                        <tbody>
							   				<?
							   				//$i = 1;

							   				$empty = "Нет товаров";

							   									   					
							   					foreach($list as $k => $v)
												{
													
													$goods = array();

													// товары подкатегории
													$goods = $prlist -> getCatItems($v['id']);

                                                    /*printArray($goods);
                                                    die;*/
													
													foreach($goods as $obj)
													{													
															
														$n = $obj->post_title;
														$m = '';	
														
														
														$arr_str = $prlist->getVariations2($obj->ID);

                                                        printArray($arr_str);
                                                        die;
																												
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
                                                                    
                                                                    <td class="item-name">
                                                                        <a href="/wp-admin/post.php?post=<?=$obj->ID?>&action=edit" title="Редактировать продукт"><?=$m?></a>
                                                                        <a href="/wp-admin/post.php?post=<?=$obj->ID?>&action=edit" title="Редактировать продукт в новом окне" target="blank"><?=$icon_new_win?></a>
                                                                        
                                                                        <a href="/product/<?=$obj->post_name?>/" target="_blank" class="icon-view"><?=$icon_view?></a>
                                                                        
                                                                    </td>
																	
																	<?
																}
																else
																	echo '
																	<td></td>
																	<td class="item-name-hide">'.$m.'</td>
																	';
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
							   				
							   											   					
											
									   		?>
                                        </tbody>
									   	</table>


										


											<script language="javascript">	                                            

                                            var icon_ok         = '<a class="icon-ok icon" title="Сохранено успешно" href="#" onclick="return false"><img src="/wp-content/themes/gantil/img/icon/ok.png"></a>';
                                            var icon_warn       = '<a class="icon-warning icon" title="Ошибка сохранения или новое значение равно старому" href="#" onclick="return false"><img src="/wp-content/themes/gantil/img/icon/warning.png"></a>';
                                            var icon_process    = '<div class="icon-process icon"><img src="/wp-content/themes/gantil/img/icon/process.gif" width=50></div>';
                                            var icon_del        = '<div class="icon-del icon"><img src="/wp-content/themes/gantil/img/icon/del.gif" width=50></div>';

                                            // AJAX-запись новой цены в БД
											function save_price(vid)		
											{

                                                // ячейка вариации по ее id (vid)
                                                var obj = $('#'+vid);

                                                
                                                $(obj).append(icon_process)

                                                var data = {
                                                    action  : 'set_price',                      // ajax-функция обработки (/wp-content/plugins/my_im_ex/inc/function.php)
                                                    pid     : $(obj).attr('data-pid'),          // id продукта
                                                    vid     : vid,                              // id вариации продукта
                                                    price   : $(obj).find('.var-edit').val()    // цена в вариации продукта
                                                };

                                                
                                                jQuery.post(ajaxurl, data, function(response) 
                                                {
                                                    console.log(response)   
                                                    if(response == '1')
                                                    {
                                                        //alert('Сохранено успешно')
                                                        $(obj).find('.var-price').text($(obj).find('.var-edit').val())
                                                        $(obj).find('.icon-warning').remove()                                                        
                                                        $(obj).append(icon_ok)                                                        
                                                    }                                                    
                                                        
                                                    else
                                                    {
                                                        //alert('Ошибка сохранения или новое значение == старому')
                                                        $(obj).append(icon_warn)                                                        
                                                    }
                                                        

                                                    remove_edit_controls(vid)
                                                });  
												
											}


                                            // очистим ячейку от кнопок управления
                                            function remove_edit_controls(vid)
                                            {
                                                var obj = $('#'+vid);

                                                // удалим все кнопки
                                                $(obj).find('.icon-save').remove()
                                                $(obj).find('.icon-cancel').remove()
                                                $(obj).find('.var-edit').remove()
                                                $(obj).find('.icon-process').remove()

                                                // покажем все скрытые текстовые цены, если такие есть
                                                $(obj).find('.var-price').show()
                                            }


                                            // получим ID вариации
                                            function get_vid(obj)
                                            {
                                                var vid;
                                                vid = $(obj).find('.var-id').val()
                                                return vid;
                                            }


                                            // удаление вариации из БД
                                            function del_var(vid)
                                            {
                                                //alert(vid)
                                                var obj = $('#'+vid);

                                                var data = {
                                                    action  : 'del_var',    // ajax-функция обработки (/wp-content/plugins/my_im_ex/inc/function.php)                                                   
                                                    vid     : vid           // id вариации продукта                                                    
                                                };

                                                if(confirm('Удалить эту вариацию?'))
                                                {
                                                    $(obj).append(icon_process)

                                                    jQuery.post(ajaxurl, data, function(response) 
                                                    {
                                                        console.log(response)   

                                                        if(response == '1')
                                                        {
                                                            //alert('Сохранено успешно')
                                                            $(obj).find('.var-price').remove()
                                                            $(obj).find('.icon-del').remove()   
                                                            $(obj).find('.icon-process').remove()  
                                                            $(obj).text('Удалено')                                                      
                                                            $(obj).append(icon_ok)                                                        
                                                        }                                                    
                                                            
                                                        else
                                                        {
                                                            //alert('Ошибка сохранения или новое значение == старому')
                                                            $(obj).append(icon_warn)                                                        
                                                        }
                                                        
                                                    });  
                                                }                                                
                                            }


											$(document).ready(function()
											{			


												/* редактирование цены вариации */
												
                                                $('.var-cell').each(function()
                                                {
                                                    // id вариации
                                                    var vid   = get_vid($(this));

                                                    // добавим иконку УДАЛИТЬ ВАРИАЦЦИЮ
                                                    $(this).append('<a class="icon-del icon" title="Удалить вариацию" href="" onclick="del_var('+vid+'); return false"><img src="/wp-content/themes/gantil/img/icon/del.png" ></a>')
                                                })

                                                // при навеении на ячейку таблицы покажем иконку УДАЛИТЬ
                                                $('.var-cell').mouseover(function(){
                                                    $(this).find('.icon-del').show()
                                                }).mouseout(function(){
                                                    $(this).find('.icon-del').hide()
                                                })

												// при клике на цену в ячейке
												$('.var-price').click(function ()
												{
													// цена в активной ячейке
													var price = $(this).text()

                                                    // id вариации
                                                    var vid   = $(this).parent('div').find('.var-id').val()

                                                    //remove_edit_controls(vid)	

                                                    // удалим иконку OK, если ранее уже было успешное сохранение
                                                    $(this).parent('div').find('.icon-ok').remove()                                            												
													
													// добавим в активную ячейку поле ввода и иконку SAVE и скроем текстовое поле цены
                                                    var icon_save   = '<a class="icon-save icon" title="Сохранить" href="" onclick="save_price('+vid+'); return false"><img src="/wp-content/themes/gantil/img/icon/save.png"></a>';
                                                    var icon_cancel = '<a class="icon-cancel icon" title="Отменить" href="" onclick="remove_edit_controls('+vid+'); return false"><img src="/wp-content/themes/gantil/img/icon/cancel.png"></a>';
													$(this).parent('div').append('<input class="var-edit" type="text" size=5 value="'+price+'">'+icon_save+icon_cancel).find('.var-edit').select()
													$(this).hide()														
												})

												/* /редактирование цены вариации */



												/* удалим пустые столбцы таблицы */

												/*var i,empty = [];
											    var tr = $('.price-list table tr');
											    for (i = 1; i < tr.length; i++)
											    {
											         $(tr[i]).children().each(function(j)
											         {
											             empty[j] = empty[j] || $(this).html().length;
											        });
											    }
											    for (i = 0; i < tr.length; i++)
											    {
											         $(tr[i]).children().each(function(j){
											             if (!empty[j]) $(this).remove();
											        });
											    }*/

											    /* /удалим пустые столбцы таблицы */


                                                /* сортировка таблицы */
                                                $("#table-prlist").tablesorter({
                                                    theme : 'blue',
                                                    // sort on the first column and second column in ascending order
                                                    sortList: [[0,0]]
                                                  }); 
                                                /* /сортировка таблицы */

											    /* подсветка строк */
											    $("#table-prlist tr:even").addClass("even");
												$("#table-prlist tr:odd").addClass("odd");
												/* /подсветка строк */

											    $('.price-list table').show()


											    /* смена салона */
											    /*$('#select-salon').change(function()
                                                {
                                                	if($(this).val() != 'all')                                                	
                                                		set_salon($(this).val())                                                    
                                                })*/
                                                /* /смена салона */
											})
											</script>

							   		</div>									
								</div>
							</div>
						</div>
						<!-- /content -->
					


</div>

<style>
#table-prlist tr:hover{background: #fff}

.var-cell{height: 50px; min-width: 50px; position: relative;}
.var-price{color:#000; font-weight: bold; font-size: 20px}
.var-edit{text-align: center;}
.var-id{background: #eee}
.var-id-span{display: block; font-size: 9px; text-align: left; color:#ccc;}

.icon{position: absolute; display:block;}
.icon-edit{top:0; right:0; }
.icon-ok{top:0; right:0;  }
.icon-warning{top:0; right:0;  }
.icon-save{bottom:0; right:0;   }
.icon-cancel{bottom:0; left:0;  }
.icon-del{top:0; left:0; display:none; }
.icon-process{top:0; left:0;}
.icon-view img{width:16px; /* display:block; position:relative; top:0; right:0; */}
</style>