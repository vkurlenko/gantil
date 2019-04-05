jQuery( function( $ ) {
    $('.correct').click(function () {
        //alert('correct')
        //"input[name*='man']"
        //attribute_pa_order_date
        $("select[name*='attribute_pa_order_date'], select[name*='attribute_pa_order_time']").each(function(){
            $(this).find('option').removeAttr('selected');
            $(this).find('option').eq(0).attr('selected', true);
        })
    })
})