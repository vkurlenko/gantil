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

// сделаем редактируемым поле цены
function do_editable(vid, copy_price, save)
{
    var obj = $('#'+vid).find('.var-price')

    // цена в активной ячейке
    var price = $(obj).text()

    // id вариации
    var vid   = $(obj).parent('div').find('.var-id').val()

    //remove_edit_controls(vid) 

    // удалим иконку OK, если ранее уже было успешное сохранение
    $(obj).parent('div').find('.icon-ok').remove()                                                                                         
    
    // добавим в активную ячейку поле ввода и иконку SAVE и скроем текстовое поле цены
    var icon_save   = '<a class="icon-save icon" title="Сохранить" href="" onclick="save_price('+vid+'); return false"><img src="/wp-content/themes/gantil/img/icon/save.png"></a>';
    var icon_cancel = '<a class="icon-cancel icon" title="Отменить" href="" onclick="remove_edit_controls('+vid+'); return false"><img src="/wp-content/themes/gantil/img/icon/cancel.png"></a>';

    $('#'+vid+' input.var-edit').remove();

    if(copy_price)
        price = copy_price;

    $(obj).parent('div').append('<input class="var-edit" type="text" size=5 value="'+price+'">'+icon_save+icon_cancel).find('.var-edit').select()

    $(obj).hide()  

    if(save){
        save_price(vid);
        close_popup();
    }
}

function close_popup(){
    $('.popup, .overlay').css({'opacity': 0, 'visibility': 'hidden'});
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

    // при наведении на ячейку таблицы покажем иконку УДАЛИТЬ
    $('.var-cell').mouseover(function(){
        $(this).find('.icon-del').show()
    }).mouseout(function(){
        $(this).find('.icon-del').hide()
    })

	// при клике на цену в ячейке
	$('.var-price').click(function ()
	{
        var vid = $(this).parent('div.var-cell').attr('id');
        do_editable(vid, null, false);
		/*// цена в активной ячейке
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
		$(this).hide()	*/													
	})

   
    /* popup окно с ценами в других салонах */
    $('.popup .close_window, .overlay').click(function (){
        $('.popup, .overlay').css({'opacity': 0, 'visibility': 'hidden'});
    });

    $('.var-otherprice').click(function (e){
        $('.popup, .overlay').css({'opacity': 1, 'visibility': 'visible'});
        e.preventDefault();

        var salons = new Array('salon_leninsky', 'salon_kolom', 'salon_bratis', 'salon_sokol', 'salon_shodnya', 'salon_dom_krasoty');
        var names = new Array('на Ленинском', 'на Коломенской', 'на Братиславской', 'на Соколе', 'на Сходненской', 'на м.Аэропорт');

        var string = '<table>';

        for( i = 0; i < salons.length; i++ ){

            var price = $(this).data(salons[i]);

            var vid = $(this).data('vid');
            var obj = $('#'+vid).find('.var-price');

            string += '<tr><td>'
                +names[i]
                +'</td><td>'
                +price+'</td>'
                +'<td>';

            if( price != '-' ){
                string += '<a class="copy" onclick="do_editable('+vid+', '+price+', true); return false;" href="#" data-price="'+price+'">скопировать</a>';
            }
                string += '</td></tr>';
        }

        string += '</table>';

        $('.popup p').html(string);        
    });
    /* /popup окно с ценами в других салонах */

   

	/* /редактирование цены вариации */



	/* удалим пустые столбцы таблицы */

	var i,empty = [];
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
    }

    /* /удалим пустые столбцы таблицы */


    /* сортировка таблицы */
    $("#table-prlist").tablesorter({
        theme : 'blue',
        // sort on the first column and second column in ascending order
        sortList: [[0,0], [1,0]]
      }); 
    /* /сортировка таблицы */

    /* подсветка строк */
    $("#table-prlist tr:even").addClass("even");
	$("#table-prlist tr:odd").addClass("odd");
	/* /подсветка строк */

    $('.price-list > table').show()


    /* смена салона */
    /*$('#select-salon').change(function()
    {
    	if($(this).val() != 'all')                                                	
    		set_salon($(this).val())                                                    
    })*/
    /* /смена салона */
})