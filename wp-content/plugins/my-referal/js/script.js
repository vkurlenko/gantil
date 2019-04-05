function initMask() {
    var maskOptions = {
        mask: '+{7}(000)000-00-00'
    };

    var arr = new Array('r_phone');

    for(i = 0; i < arr.length; i++)
    {
        var element3 = document.getElementById(arr[i]);

        if(element3)
            var mask = new IMask(element3, maskOptions);
    }
}

$(document).ready(function(){

        initMask();
})