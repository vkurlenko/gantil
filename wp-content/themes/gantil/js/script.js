

function initMask() {
	var maskOptions = {
	  mask: '+{7}(000)000-00-00'
	};

	var arr = new Array('input-tel', 'input-tel2', 'r_phone', 'tel-1', 'tel-697', 'tel-698', 'tel-699', 'tel-568', 'tel-700', 'billing_phone', 'vacancy-phone');

	for(i = 0; i < arr.length; i++)
	{
		var element3 = document.getElementById(arr[i]);
		if(element3)
			var mask = new IMask(element3, maskOptions);
	}	
}



function initSlick()
{

	 $('.video').hide();
	 $('.video-noslick').show();

	$('.grid-salons-slider, .grid-gallery-slider').slick({
	    dots: false,
	    infinite: false,				        
	    slidesToShow: 1,
	    slidesToScroll: 1,
	    //arrows: true	,
	    /*responsive: [
	    {
	      breakpoint: 980,
	      settings: {slidesToShow: 3, slidesToScroll: 3, dots: true }
	    },
	    {
	      breakpoint: 680,
	      settings: {slidesToShow: 2, slidesToScroll: 2, arrows: true }
	    },
	    {
	      breakpoint: 480,
	      settings: { slidesToShow: 1, slidesToScroll: 1, arrows: true }
	    }]*/		    
	  });	  
}


function video_slider()
{
	$('.slick-video').show().slick({
		dots: false,
		infinite: false,				        
		slidesToShow: 3,
		slidesToScroll: 3,
		arrows: true,

		responsive: [
		/*{
		  breakpoint: 980,
		  settings: {slidesToShow: 3, slidesToScroll: 3, dots: true }
		},*/
		{
		  breakpoint: 680,
		  settings: {slidesToShow: 3, slidesToScroll: 3 }
		},
		{
		  breakpoint: 480,
		  settings: { slidesToShow: 3, slidesToScroll: 3, arrows: false }
		}]
		// prevArrow : '<button type="button" class="slick-prev slick-prev-my">Prev</button>',

	});
}

function video_player_size()
{
	k = 640/390;
	if($('#video-player').width() < 640)
		$('#video-player').height($(this).width()/k);
}



function set_salon(obj)
{
	var s = $(obj).attr('data-salon');
	$('.input-salon').val(s)
}

/* slick-карусель сертификатов на главной */
function make_sertif_slick() {
	$('.slider-sertif').show().slick({
        dots: false,
        infinite: false,				        
        slidesToShow: 4,
        slidesToScroll: 4,
        //prevArrow: '<span class="my-arrow-prev"><img scr="/wp-content/themes/gantil/plugin/slick/prev.png"></span>',			
        //prevArrow : '<button type="button" class="">Prev</button>',
        responsive: [
	    {
	      breakpoint: 980,
	      settings: {slidesToShow: 3, slidesToScroll: 3, dots: true }
	    },
	    {
	      breakpoint: 680,
	      settings: {slidesToShow: 2, slidesToScroll: 2, arrows: true }
	    },
	    {
	      breakpoint: 480,
	      settings: { slidesToShow: 1, slidesToScroll: 1, arrows: true }
	    }]
      });


      	max = 0;
		$('.sertif-item-name').each(function()
		{
			if($(this).height() > max)
				max = $(this).height()
		})
		$('.sertif-item-name').height(max)
}
/* /slick-карусель сертификатов на главной */


/* slick-карусель ГАЛЕРЕЯ на главной */
function make_gallery_slick()
{
	a = false;
	slick = false;

	if($(window).width() <= '480')	{
		initSlick();
		a = true;
		slick = true;
	}

	$(window).resize(function() {

		if ($(window).width() <= '480')	{

			a = true;

			if(a && !slick)	{				
				// do slick
				initSlick();
				slick = true;  
			}			 
		}
		else {
			a = false;
			if(!a && slick)	{
				// uslick				
	  			$('.video-noslick').hide();

				$('.grid-salons-slider, .grid-gallery-slider').slick('unslick')
				$('.video').show();
				
				slick = false;
			}	
		}
	})


	/*  */
	$('.salons-item-menu .ord a').click(function()	{	
		set_salon($(this))		
	})
}
/* /slick-карусель ГАЛЕРЕЯ на главной */



/*
    jQuery Masked Input Plugin
    Copyright (c) 2007 - 2015 Josh Bush (digitalbush.com)
    Licensed under the MIT license (http://digitalbush.com/projects/masked-input-plugin/#license)
    Version: 1.4.1
*/
/*!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a("object"==typeof exports?require("jquery"):jQuery)}(function(a){var b,c=navigator.userAgent,d=/iphone/i.test(c),e=/chrome/i.test(c),f=/android/i.test(c);a.mask={definitions:{9:"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"},autoclear:!0,dataName:"rawMaskFn",placeholder:"_"},a.fn.extend({caret:function(a,b){var c;if(0!==this.length&&!this.is(":hidden"))return"number"==typeof a?(b="number"==typeof b?b:a,this.each(function(){this.setSelectionRange?this.setSelectionRange(a,b):this.createTextRange&&(c=this.createTextRange(),c.collapse(!0),c.moveEnd("character",b),c.moveStart("character",a),c.select())})):(this[0].setSelectionRange?(a=this[0].selectionStart,b=this[0].selectionEnd):document.selection&&document.selection.createRange&&(c=document.selection.createRange(),a=0-c.duplicate().moveStart("character",-1e5),b=a+c.text.length),{begin:a,end:b})},unmask:function(){return this.trigger("unmask")},mask:function(c,g){var h,i,j,k,l,m,n,o;if(!c&&this.length>0){h=a(this[0]);var p=h.data(a.mask.dataName);return p?p():void 0}return g=a.extend({autoclear:a.mask.autoclear,placeholder:a.mask.placeholder,completed:null},g),i=a.mask.definitions,j=[],k=n=c.length,l=null,a.each(c.split(""),function(a,b){"?"==b?(n--,k=a):i[b]?(j.push(new RegExp(i[b])),null===l&&(l=j.length-1),k>a&&(m=j.length-1)):j.push(null)}),this.trigger("unmask").each(function(){function h(){if(g.completed){for(var a=l;m>=a;a++)if(j[a]&&C[a]===p(a))return;g.completed.call(B)}}function p(a){return g.placeholder.charAt(a<g.placeholder.length?a:0)}function q(a){for(;++a<n&&!j[a];);return a}function r(a){for(;--a>=0&&!j[a];);return a}function s(a,b){var c,d;if(!(0>a)){for(c=a,d=q(b);n>c;c++)if(j[c]){if(!(n>d&&j[c].test(C[d])))break;C[c]=C[d],C[d]=p(d),d=q(d)}z(),B.caret(Math.max(l,a))}}function t(a){var b,c,d,e;for(b=a,c=p(a);n>b;b++)if(j[b]){if(d=q(b),e=C[b],C[b]=c,!(n>d&&j[d].test(e)))break;c=e}}function u(){var a=B.val(),b=B.caret();if(o&&o.length&&o.length>a.length){for(A(!0);b.begin>0&&!j[b.begin-1];)b.begin--;if(0===b.begin)for(;b.begin<l&&!j[b.begin];)b.begin++;B.caret(b.begin,b.begin)}else{for(A(!0);b.begin<n&&!j[b.begin];)b.begin++;B.caret(b.begin,b.begin)}h()}function v(){A(),B.val()!=E&&B.change()}function w(a){if(!B.prop("readonly")){var b,c,e,f=a.which||a.keyCode;o=B.val(),8===f||46===f||d&&127===f?(b=B.caret(),c=b.begin,e=b.end,e-c===0&&(c=46!==f?r(c):e=q(c-1),e=46===f?q(e):e),y(c,e),s(c,e-1),a.preventDefault()):13===f?v.call(this,a):27===f&&(B.val(E),B.caret(0,A()),a.preventDefault())}}function x(b){if(!B.prop("readonly")){var c,d,e,g=b.which||b.keyCode,i=B.caret();if(!(b.ctrlKey||b.altKey||b.metaKey||32>g)&&g&&13!==g){if(i.end-i.begin!==0&&(y(i.begin,i.end),s(i.begin,i.end-1)),c=q(i.begin-1),n>c&&(d=String.fromCharCode(g),j[c].test(d))){if(t(c),C[c]=d,z(),e=q(c),f){var k=function(){a.proxy(a.fn.caret,B,e)()};setTimeout(k,0)}else B.caret(e);i.begin<=m&&h()}b.preventDefault()}}}function y(a,b){var c;for(c=a;b>c&&n>c;c++)j[c]&&(C[c]=p(c))}function z(){B.val(C.join(""))}function A(a){var b,c,d,e=B.val(),f=-1;for(b=0,d=0;n>b;b++)if(j[b]){for(C[b]=p(b);d++<e.length;)if(c=e.charAt(d-1),j[b].test(c)){C[b]=c,f=b;break}if(d>e.length){y(b+1,n);break}}else C[b]===e.charAt(d)&&d++,k>b&&(f=b);return a?z():k>f+1?g.autoclear||C.join("")===D?(B.val()&&B.val(""),y(0,n)):z():(z(),B.val(B.val().substring(0,f+1))),k?b:l}var B=a(this),C=a.map(c.split(""),function(a,b){return"?"!=a?i[a]?p(b):a:void 0}),D=C.join(""),E=B.val();B.data(a.mask.dataName,function(){return a.map(C,function(a,b){return j[b]&&a!=p(b)?a:null}).join("")}),B.one("unmask",function(){B.off(".mask").removeData(a.mask.dataName)}).on("focus.mask",function(){if(!B.prop("readonly")){clearTimeout(b);var a;E=B.val(),a=A(),b=setTimeout(function(){B.get(0)===document.activeElement&&(z(),a==c.replace("?","").length?B.caret(0,a):B.caret(a))},10)}}).on("blur.mask",v).on("keydown.mask",w).on("keypress.mask",x).on("input.mask paste.mask",function(){B.prop("readonly")||setTimeout(function(){var a=A(!0);B.caret(a),h()},0)}),e&&f&&B.off("input.mask").on("input.mask",u),A()})}})});
jQuery(function($){
  // $(".wpcf7-tel").mask("+7(999) 999-99-99");
});*/
/*
    jQuery Masked Input Plugin    
*/

 
 // Grayscale w canvas method
 function grayscale(src)
 {
	 var canvas = document.createElement('canvas');
	 var ctx = canvas.getContext('2d');
	 var imgObj = new Image();
	 imgObj.src = src;
	 canvas.width = imgObj.width;
	 canvas.height = imgObj.height; 
	 ctx.drawImage(imgObj, 0, 0); 
	 var imgPixels = ctx.getImageData(0, 0, canvas.width, canvas.height);
	 for(var y = 0; y < imgPixels.height; y++)
	 {
		 for(var x = 0; x < imgPixels.width; x++)
		 {
			 var i = (y * 4) * imgPixels.width + x * 4;
			 var avg = (imgPixels.data[i] + imgPixels.data[i + 1] + imgPixels.data[i + 2]) / 3;
			 imgPixels.data[i] = avg; 
			 imgPixels.data[i + 1] = avg; 
			 imgPixels.data[i + 2] = avg;
		 }
	 }
	 ctx.putImageData(imgPixels, 0, 0, 0, 0, imgPixels.width, imgPixels.height);
	 return canvas.toDataURL();
 }

 /* /ДИНАМИЧЕСКОЕ ОБЕСЦВЕЧИВАНИЕ КАРТИНОК */

 function set_master_info(obj)
 {
 	
		var mail = new Array(
			'lnn@gantil.ru, 		4098569@mail.ru',
			'4996177337@mail.ru, 	klm@gantil.ru',
			'1536261@mail.ru,		brt@gantil.ru,	salon_bratislavskaya@bk.ru',
			'gabgeorge@gmail.com, 	shl@gantil.ru',
			'skl@gantil.ru, 		artem2006.04@mail.ru',
			'shd@gantil.ru, 		sx.gantil@mail.ru',
			'gentille.airport@mail.ru'			
		);
		
		var master_name = $(obj).parents('.our-team').find('h5').text();
		var str = $(obj).parents('.our-team').find('p').eq(1).html(); 
		var master_info = str.split("<br>");
		var master_salon = $.trim(master_info[1])

		//console.log(master_name);
		
		if(master_salon == 'Жантиль на Ленинском') var email = mail[0];
		if(master_salon == 'Жантиль на Коломенской') var email = mail[1];
		if(master_salon == 'Жантиль на Братиславской') var email = mail[2];
		if(master_salon == 'Жантиль на Щелковской') var email = mail[3];
		if(master_salon == 'Жантиль на Соколе') var email = mail[4];
		if(master_salon == 'Жантиль на Сходненской') var email = mail[5];
		if(master_salon == 'Жантиль м. Аэропорт') var email = mail[6];
		
		
		
		//alert(master_salon)
		var master_photo = $(obj).parents('.our-team').find('.team-member').html();
		
		$('.wpcf7-form').find('#master_name').attr('value', master_name);
		$('.wpcf7-form').find('#master_salon').attr('value', $.trim(master_salon));
		$('.wpcf7-form').find('#salon_email').attr('value', email);

		$('#master_info').remove()
		//$('#splite_popup_title').append('<div id="master_info">'+master_name+'<br>'+$.trim(master_salon)+'</div>');
		//alert('<div id="master_info">'+master_name+'<br>'+$.trim(master_salon)+'</div>')
		$('#contact_form_pop_up_5 > div > h3').append('<div id="master_info">'+master_name+'<br>'+$.trim(master_salon)+'</div>');
		
 }


function initVideo() {

    $('.video').css(
        {
            'height' : $('.img0').height(),
            'overflow' : 'hidden'
        })
}

/*function get_video_title(vid)
{
	APIKEY = 'AIzaSyDb4fDfRvQGb_Jqg4x8Jt0zy_ddqL8fYr4';
	title = 'title';
	//alert("https://www.googleapis.com/youtube/v3/videos?id="+vid+"&key="+APIKEY+"&fields=items(snippet(title))&part=snippet");

	$.ajax({
	      url: "https://www.googleapis.com/youtube/v3/videos?id="+vid+"&key="+APIKEY+"&fields=items(snippet(title))&part=snippet", 
	      dataType: "jsonp",

	      success: function(data){
	               
	               title = data.items[0].snippet.title;  
	               console.log(title); 
	               return title;
	               //title = $('h2').text(title);	               
	      },
	      error: function(jqXHR, textStatus, errorThrown) {
	          alert (textStatus, + ' | ' + errorThrown);
	          title = '';
	      }
	  });
}*/


 $(document).ready(function()
{
	/* инициализация маски ввода телефона */
	initMask();

    //mutation();


    /* 'Выберите салон' в форме промо баннера */
    $('.menu-888 > select > option:first').attr({
        'disabled' : 'disabled',
        'value' : ''
    });



    /* таймер обратного отсчета */
    $('#clock').countdown($('#clock').attr('data-date'), function(event) {

        var totalHours = event.offset.totalDays * 24 + event.offset.hours;

        var string = '<p>До окончания акции осталось:</p>' +
            '<span class="countdown countdown-h">' + totalHours + ' <span>часы</span></span>' +
            '<span class="delimiter">:</span>' +
            '<span class="countdown countdown-m">%M <span>минуты</span></span>' +
            '<span class="delimiter">:</span>' +
            '<span class="countdown countdown-m">%S <span>секунды</span></span>' +
            '<div style="clear: both"></div>';

        $(this).html(event.strftime(string));
    });
    /* /таймер обратного отсчета */




	$('img.img-mono').each(function(){

		if($(this).attr('data.data-imgcolor') != '')
		{
			$(this).after('<img class="grid-item-img img-color" src="'+$(this).attr('data-imgcolor')+'"  > ');
		}
	})


	/* смена салона в сессии */
	$('.dropdown-item, .popup li a').on('click', function(event)
	{
		var s = $(this).attr('data-name');
		
		$.ajax({
			type: "POST",
		  	url: '/wp-content/themes/gantil/ajax/set.salon.php',
		  	data: "salon="+s,
		  	success: function(data)
		  	{
		    	location.reload();
		  	},
		  	error: function()
		  	{
		  		alert('Ошибка сохранения салона');
		  	}
		});
		return false;
	})
	/* /смена салона в сессии */


	$('.grid-promo-item, .banner-align-left, .banner-align-right').mouseenter(function()
	{			
		$(this).find('.img-color').show()
		$(this).find('.img-mono').animate({opacity: 0}, 300);
	}).mouseleave (function()
	{		
		$(this).find('.img-mono').animate({opacity: 1}, 500);		
	})


	/* слайдер новостей на главной */
	$('.grid-news-slider').show().slick({
		dots: false,
		infinite: false,				        
		slidesToShow: 3,
		slidesToScroll: 3,

		responsive: [
		{
		  breakpoint: 980,
		  settings: {slidesToShow: 3, slidesToScroll: 3, dots: true }
		},
		{
		  breakpoint: 680,
		  settings: {slidesToShow: 2, slidesToScroll: 2, arrows: true  }
		},
		{
		  breakpoint: 480,
		  settings: { slidesToShow: 1, slidesToScroll: 1, arrows: true }
		}]
		// prevArrow : '<button type="button" class="slick-prev slick-prev-my">Prev</button>',
	});

	var max = 0;

	$('.grid-item-name').each(function(){
		if($(this).height() > max)
			max = $(this).height()
	})

	$('.grid-item-name').height(max)

	$('.grid-item-news').mouseenter(function()	{
		$(this).find('.grid-block-button').css('color', '#000');	
		$(this).find('.img-color').show();
		$(this).find('.img-mono').animate({opacity: 0}, 300);
	}).mouseleave (function()	{
		$(this).find('.grid-block-button').css('color', '#606060');		
		$(this).find('.img-mono').animate({opacity: 1}, 500);		
	})
	/* /слайдер новостей на главной */

	/* слайдер услуг на главной*/
	$('.grid-service-slider').show().slick({
	    dots: true,
	    infinite: false,				        
	    slidesToShow: 4,
	    slidesToScroll: 4,
	    arrows: false,
	    responsive: [
	    {
	      breakpoint: 980,
	      settings: {slidesToShow: 3, slidesToScroll: 3, dots: true }
	    },
	    {
	      breakpoint: 680,
	      settings: {slidesToShow: 2, slidesToScroll: 2, arrows: true }
	    },
	    {
	      breakpoint: 480,
	      settings: { slidesToShow: 1, slidesToScroll: 1, arrows: true }
	    }]
	    // prevArrow : '<button type="button" class="slick-prev slick-prev-my">Prev</button>',
	    
	  });

  	max = 0;
	$('.service-item-name').each(function()	{
		if($(this).height() > max)
			max = $(this).height();
	});
	$('.service-item-name').height(max)

	/* /слайдер услуг на главной */

	/* слайдер салонов на главной */
	$(window).on('resize', function(event) {
		$('.grid-salons-slick').slick('resize');	
	})

	$('.grid-salons-slick').slick({
	    dots: false,
	    infinite: false,				        
	    slidesToShow: 4,
	    slidesToScroll: 4,
	    arrows: true,
	    mobileFirst: true,
	    responsive: [	 
	    	{
		      breakpoint: 1024,
		      settings: "unslick"
		    },    	  
		    {
		      breakpoint: 980,
		      settings: {slidesToShow: 3, slidesToScroll: 3, dots: false }
		    },
		    {
		      breakpoint: 680,
		      settings: {slidesToShow: 2, slidesToScroll: 2, arrows: true }
		    },
		    {
		      breakpoint: 480,
		      settings: { slidesToShow: 1, slidesToScroll: 1, arrows: true }
		    },
		    {
		      breakpoint: 300,
		      settings: { slidesToShow: 1, slidesToScroll: 1, arrows: true }
		    }
		]
	    // prevArrow : '<button type="button" class="slick-prev slick-prev-my">Prev</button>',
	    
	  });



		$('.salons-item').mouseenter(function()
		{
			/*$(this).find('.salons-item-name').animate({bottom: '45px'}, 500);*///addClass('salons-item-name-over')
			$(this).find('.salons-address').animate({height: 'show'}, 500);//.toggle('slow')
			
			//$(this).find('.img-color').show()
			$(this).find('.img-color').animate({opacity: 1}, 300);
			$(this).find('.img-mono').animate({opacity: 0}, 100);
		}).mouseleave (function()
		{
			/*$(this).find('.salons-item-name').animate({bottom: '5px'}, 500);*///.removeClass('salons-item-name-over')
			$(this).find('.salons-address').animate({height: 'hide'}, 500);

			$(this).find('.img-color').animate({opacity: 0}, 100);
			$(this).find('.img-mono').animate({opacity: 1}, 300);		
		})
	/* /слайдер салонов на главной */


	/* выпадающее меню в форме заказа услуги */		
		
	$('.variations_form select').not('#pa_order_time').change(function()
	//$('form.variations_form  select').change(function()
	{

		$('#pa_item_salon option').each(function(){
			if($(this).attr('value') == $('#pa_item_salon').val())
				if($(this).attr('value') != ''){
					$('.salon-name').html('Цена в <span></span>:');
					$('.salon-name span').html($(this).text());
				}
				else
					$('.salon-name').html('');						
		})

		
		if($(this).attr('id') == 'pa_item_salon') {
			set_salon($('#pa_item_salon').val())
			//$('.woocommerce-variation-price').html($('#pa_item_salon').val())
		}
		

		if($(this).val() == '')	{
			// если выбран пустой пункт, то последующие скроем и обнулим
			p = $(this).parents('tr');
			$(p).nextAll('tr').find('select').removeClass('visible').prop('selectedIndex',0);	
			//$(p).next('tr').find('select').addClass('visible');			
		}
		else {
			// если выбран НЕпустой пункт, то последующие покажем
			p = $(this).parents('tr');
			$(p).nextAll('tr').find('select').removeClass('visible').prop('selectedIndex',0);	
			$(p).next('tr').find('select').addClass('visible');

			if($(p).next('tr').find('select').attr('id') == 'pa_item_period')
				$('#pa_item_period').prop('selectedIndex',1);
		}

		$("#selectMaster").remove();
		
	})


	/* список мастеров */
	$('#pa_item_spec').change(function()
  	{
  		// Очистим список
  		$("#selectMaster").remove();

  		// очистим скрытое поле, в котором хранится имя мастера после выбора из списка
  		$("#pa_item_master").attr('value', '');

  		// иконка ожидания
  		$("#pa_item_master").after('<div id="wait" ><img src="/wp-content/uploads/2017/08/wczytywanie.gif"></div>');

  		var item_salon = $('#pa_item_salon').val(); // выбранный салон
  		var item_spec  = $(this).val();				// выбранная специализация
        var item_id = $('.variations_form').attr('data-product_id'); // id услуги?

  		var data = {
			action : 'hello',
			salon  : item_salon,
			spec   : item_spec,
            product: item_id
  		};

  		// сделаем AJAX запрос на вывод мастеров в соотв. с критериями
  		jQuery.get('/wp-admin/admin-ajax.php', data, function(response)
  		{
  			$('#wait').remove();
  			$("#pa_item_master").after('<div id="selectMaster" class="visible"></div>');
  			$(response).appendTo($("#selectMaster"));

  			$('.item-master').not('.item-master-selected').click(function()
  			{
				// в скрытое поле поместим имя выбранного мастера
  				$("#pa_item_master").attr('value', $(this).find('.master_name').text());

                // выделим выбранного мастера в списке
  				$('.item-master').removeClass('item-master-selected');
  				$(this).addClass('item-master-selected');

  				// других спрячем

                $('.item-master').not('.item-master-selected').toggle( "fast", function() {
                    // Animation complete.
                });
                //$("<i class='up-down'></i>").insertAfter($(".item-master-selected a"));
                //$("<li class='item'>Тест</li>").insertAfter($(".it1"));

  				// определим цвет смены выбранного мастера и сделаем неактивными другие смены
  				/*if($(this).hasClass('watch-red'))
  					setColor('watch-red');

  				if($(this).hasClass('watch-green'))
  					setColor('watch-green');

  				if($(this).hasClass('watch-all'))
  					setColor('watch-all');	 */
  				// /определим цвет смены выбранного мастера и сделаем неактивными другие смены

  				if($("#pa_item_master").attr('value'))
  					$('.single_add_to_cart_button').removeClass('hidden-button')

  				return false;
  			})

            /*$( ".item-master" ).click(function() {
                alert('show')
                 $('.item-master').not('.item-master-selected').toggle( "slow", function() {
                     // Animation complete.
                 });
            });*/

           /* $('.up-down').click(function(){
                alert('show')
                $('.item-master').show();
            })*/




  			//console.log(response);
  		})


  	
  	})


    /* /список мастеров */
	/* /выпадающее меню в форме заказа услуги */


	
	/* выбор салона в формах CF7 */
	$('.order-to-salon').click(function()
	{
		var s = $(this).attr('data-salon');
		//$('.cf7-select-salon option').attr('selected', false);

		$('.cf7-select-salon option').each(function()
		{
			var str = $(this).attr('value');
			//alert(str)
			if(str.toLowerCase() == s.toLowerCase())
			{
				$(this).attr('selected', 'selected');
				$('.cf7-select-salon').prop("selectedIndex", $(this).index());
				
				$('.cf7-salon-name').attr('value', str);
			}	
			else
				$(this).attr('selected', false);			
		})		
	})

	$('.cf7-select-salon').change(function()
	{
		$('.cf7-salon-name').attr('value', $(this).val());
	})

	$('.cf7-select-salon-call').change(function()
	{
		$('.cf7-salon-name-call').attr('value', $(this).val());
	})

	/* /выбор салона в формах CF7 */



	/* ВИДЕО ГАЛЕРЕЯ */	
	video_player_size();

	$(window).resize(function() 
	{			
		video_player_size();
	})


	video_slider();

	$('.video-item').eq(0).addClass('video-item-selected');
	var dscr = $('.video-item').eq(0).find('a').attr('data-dscr');
	//$('#gallery-content').prepend('<p></p>');

	$('#gallery-content p').eq(0).html($('.video-item').eq(0).find('a').attr('data-dscr'))
	//get_video_title($('.video-item').eq(0).find('a').attr('data'));

	$('.video-item a').click(function()	{
		$u = $(this).attr('href');
		$('iframe').attr('src', $u);

		$('.video-item').removeClass('video-item-selected');
		$(this).parent('.video-item').addClass('video-item-selected');
		
		$('h2').text($(this).find('img').attr('title'))
		$('#gallery-content p').eq(0).html($(this).attr('data-dscr'))		

		return false;
	})
	/* /ВИДЕО ГАЛЕРЕЯ */

	$('.img0').load(function() 
	{
	  initVideo() // действия, в ответ на загрузку изображения
	});

	$(window).resize(function() 
	{
		initVideo()		
	})

	$('.gallery-item').mouseenter(function()
	{
		$(this).find('.grid-block-button').css('color', '#000')		
		$(this).find('.img-color').show()
		$(this).find('.img-mono').animate({opacity: 0}, 300);
	}).mouseleave (function()
	{
		$(this).find('.grid-block-button').css('color', '#606060')		
		$(this).find('.img-mono').animate({opacity: 1}, 500);		
	})



	/* автоподстановка данных мастера в форме записи */
	$('.speaker-topic-title > h4 > a, .speaker-topic-title > li > h4 > a, .our-team .master-button').click(function()
		{
			obj = $(this);
			set_master_info(obj);
		})
	/* /автоподстановка данных мастера в форме записи */


	/* форма заявки по условиям акции */
	$('.form7').click(function(e){
		var obj = $(this).find('a');
		var cf_form7 = $('#contact_form_pop_up_7');

		if(obj && cf_form7){
			var title = $(obj).attr('data-actiontitle');
			var content = $(obj).attr('data-actioncontent');
			var url = $(obj).attr('data-url');
			var salons = $(obj).attr('data-salons'); // строка вида "одне|Аэро" (склеенный массив обрезок строк названий салонов substr(2, 4))

			$('.cf7-action-title').val(title);
			$('.cf7-action-content').val(content);
			$('.cf7-action-url').val(url);


			if(salons != ''){
				var arr = salons.split('|');

				// сделаем все салоны недоступными
				$(cf_form7).find('.cf7-select-salon option').attr('disabled', 'disabled');


				$(cf_form7).find('.cf7-select-salon option').each(function(){
					var b = $(this).val().split(' ');
					var s = b[b.length - 1];

					// если есть салон в строке salons, то его сделаем доступным в select
					if($.inArray(s.substring(2,6), arr) > -1)
						$(this).attr('disabled', false);
				})
			}
		}
	})
	/* /форма заявки по условиям акции */


	/* fancybox-галерея инстаграм */
    $("a.grouped_elements").fancybox({
        'transitionIn'  :   'fade',
        'transitionOut' :   'fade',
        'speedIn'       :   600,
        'speedOut'      :   200,
        'overlayShow'   :   false,
		'padding'		: 0,
        'margin'		: 10
    });
    /* /fancybox-галерея инстаграм */


    /* кнопка НАВЕРХ */
	$("a.go-to-top").click(function() 	{
      $("html, body").animate({
         scrollTop: $($(this).attr("href")).offset().top + "px"
      }, {
         duration: 500,
         easing: "swing"
      });
      return false;
   });
	/* /кнопка НАВЕРХ */


    /* согласие с правилами использования сайта */
    $('.agree').click(function(){
        Cookies.set('agree', true, { expires: 30, path: '/' });
        $('#warning').remove();
    })
    /* /согласие с правилами использования сайта */

})

