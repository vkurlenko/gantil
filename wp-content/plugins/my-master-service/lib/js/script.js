$(document).ready(function()
{
    $('ul.child').each(function () {
        $(this).parent('li').prepend('<input type="checkbox">');

        var ul = $(this);

        $(ul).find('li').each(function(){
            if($(this).find('input').is(':checked')){
                $(ul).addClass('visible');
            }

        })
    })


    $('.parent > li > input').click(function(e){
        var obj = $(this);

        if($(this).is(':checked')){
            $(obj).nextAll('ul').find('li').each(function(){
                $(this).find('label input').prop('checked', true);
            })
        }
        else{
            $(obj).nextAll('ul').find('li').each(function(){
                $(this).find('label input').prop('checked', false);
            })
        }
    })

    $('.parent > li.header span').click(function (event) {
        $(this).nextAll("ul").slideToggle();
        event.stopPropagation();
        $(this).next('ul').removeClass('visible');
    });

    /*$('.child input').click(function (e) {
        if(!$(this).is(':checked')){
            $(this).parents('.parent > li > input').prop('checked', false);
        }
    })*/

    $('#view-all').click(function(){
        $('ul.child').removeClass('visible');
        $('ul.child').slideToggle();//addClass('visible');
        return false;
    })

});