


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
function make_sertif_slick()
{
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

	if($(window).width() <= '480')
	{
		initSlick();
		a = true;
		slick = true;
	}

	$(window).resize(function() 
	{

		if ($(window).width() <= '480')
		{

			a = true;

			if(a && !slick)
			{
				
				// do slick
				initSlick();
				slick = true;  
			}			 
		}
		else   
		{
			a = false;
			if(!a && slick)
			{
				// uslick
				
	  			$('.video-noslick').hide();

				$('.grid-salons-slider, .grid-gallery-slider').slick('unslick')
				$('.video').show();
				
				slick = false;
			}	
		}
	})


	/*  */
	$('.salons-item-menu .ord a').click(function()
	{	
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
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a("object"==typeof exports?require("jquery"):jQuery)}(function(a){var b,c=navigator.userAgent,d=/iphone/i.test(c),e=/chrome/i.test(c),f=/android/i.test(c);a.mask={definitions:{9:"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"},autoclear:!0,dataName:"rawMaskFn",placeholder:"_"},a.fn.extend({caret:function(a,b){var c;if(0!==this.length&&!this.is(":hidden"))return"number"==typeof a?(b="number"==typeof b?b:a,this.each(function(){this.setSelectionRange?this.setSelectionRange(a,b):this.createTextRange&&(c=this.createTextRange(),c.collapse(!0),c.moveEnd("character",b),c.moveStart("character",a),c.select())})):(this[0].setSelectionRange?(a=this[0].selectionStart,b=this[0].selectionEnd):document.selection&&document.selection.createRange&&(c=document.selection.createRange(),a=0-c.duplicate().moveStart("character",-1e5),b=a+c.text.length),{begin:a,end:b})},unmask:function(){return this.trigger("unmask")},mask:function(c,g){var h,i,j,k,l,m,n,o;if(!c&&this.length>0){h=a(this[0]);var p=h.data(a.mask.dataName);return p?p():void 0}return g=a.extend({autoclear:a.mask.autoclear,placeholder:a.mask.placeholder,completed:null},g),i=a.mask.definitions,j=[],k=n=c.length,l=null,a.each(c.split(""),function(a,b){"?"==b?(n--,k=a):i[b]?(j.push(new RegExp(i[b])),null===l&&(l=j.length-1),k>a&&(m=j.length-1)):j.push(null)}),this.trigger("unmask").each(function(){function h(){if(g.completed){for(var a=l;m>=a;a++)if(j[a]&&C[a]===p(a))return;g.completed.call(B)}}function p(a){return g.placeholder.charAt(a<g.placeholder.length?a:0)}function q(a){for(;++a<n&&!j[a];);return a}function r(a){for(;--a>=0&&!j[a];);return a}function s(a,b){var c,d;if(!(0>a)){for(c=a,d=q(b);n>c;c++)if(j[c]){if(!(n>d&&j[c].test(C[d])))break;C[c]=C[d],C[d]=p(d),d=q(d)}z(),B.caret(Math.max(l,a))}}function t(a){var b,c,d,e;for(b=a,c=p(a);n>b;b++)if(j[b]){if(d=q(b),e=C[b],C[b]=c,!(n>d&&j[d].test(e)))break;c=e}}function u(){var a=B.val(),b=B.caret();if(o&&o.length&&o.length>a.length){for(A(!0);b.begin>0&&!j[b.begin-1];)b.begin--;if(0===b.begin)for(;b.begin<l&&!j[b.begin];)b.begin++;B.caret(b.begin,b.begin)}else{for(A(!0);b.begin<n&&!j[b.begin];)b.begin++;B.caret(b.begin,b.begin)}h()}function v(){A(),B.val()!=E&&B.change()}function w(a){if(!B.prop("readonly")){var b,c,e,f=a.which||a.keyCode;o=B.val(),8===f||46===f||d&&127===f?(b=B.caret(),c=b.begin,e=b.end,e-c===0&&(c=46!==f?r(c):e=q(c-1),e=46===f?q(e):e),y(c,e),s(c,e-1),a.preventDefault()):13===f?v.call(this,a):27===f&&(B.val(E),B.caret(0,A()),a.preventDefault())}}function x(b){if(!B.prop("readonly")){var c,d,e,g=b.which||b.keyCode,i=B.caret();if(!(b.ctrlKey||b.altKey||b.metaKey||32>g)&&g&&13!==g){if(i.end-i.begin!==0&&(y(i.begin,i.end),s(i.begin,i.end-1)),c=q(i.begin-1),n>c&&(d=String.fromCharCode(g),j[c].test(d))){if(t(c),C[c]=d,z(),e=q(c),f){var k=function(){a.proxy(a.fn.caret,B,e)()};setTimeout(k,0)}else B.caret(e);i.begin<=m&&h()}b.preventDefault()}}}function y(a,b){var c;for(c=a;b>c&&n>c;c++)j[c]&&(C[c]=p(c))}function z(){B.val(C.join(""))}function A(a){var b,c,d,e=B.val(),f=-1;for(b=0,d=0;n>b;b++)if(j[b]){for(C[b]=p(b);d++<e.length;)if(c=e.charAt(d-1),j[b].test(c)){C[b]=c,f=b;break}if(d>e.length){y(b+1,n);break}}else C[b]===e.charAt(d)&&d++,k>b&&(f=b);return a?z():k>f+1?g.autoclear||C.join("")===D?(B.val()&&B.val(""),y(0,n)):z():(z(),B.val(B.val().substring(0,f+1))),k?b:l}var B=a(this),C=a.map(c.split(""),function(a,b){return"?"!=a?i[a]?p(b):a:void 0}),D=C.join(""),E=B.val();B.data(a.mask.dataName,function(){return a.map(C,function(a,b){return j[b]&&a!=p(b)?a:null}).join("")}),B.one("unmask",function(){B.off(".mask").removeData(a.mask.dataName)}).on("focus.mask",function(){if(!B.prop("readonly")){clearTimeout(b);var a;E=B.val(),a=A(),b=setTimeout(function(){B.get(0)===document.activeElement&&(z(),a==c.replace("?","").length?B.caret(0,a):B.caret(a))},10)}}).on("blur.mask",v).on("keydown.mask",w).on("keypress.mask",x).on("input.mask paste.mask",function(){B.prop("readonly")||setTimeout(function(){var a=A(!0);B.caret(a),h()},0)}),e&&f&&B.off("input.mask").on("input.mask",u),A()})}})});
jQuery(function($){
  // $(".wpcf7-tel").mask("+7(999) 999-99-99");
});
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
 	//alert($(obj));

 	//alert('work')
		/*
		mail_admin_salon_leninsky
		mail_admin_salon_kolom
		mail_admin_salon_bratis
		mail_admin_salon_schelk
		mail_admin_salon_sokol
		mail_admin_salon_shodnya
		mail_admin_salon_dom_krasoty
		*/
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
		$('#splite_popup_title').append('<div id="master_info">'+master_name+'<br>'+$.trim(master_salon)+'</div>');
		//$('#master_info').remove()
		//$('.wpcf7-form').find('p').eq(4).prepend('<p id="master_info" style="text-align:center"></p>');
		//$('#master_info').html('<p id=>'+master_name+'<br>'+$.trim(master_salon)+'</p>'+master_photo);
		//$('#master_info').html('<p id=>'+master_name+'<br>'+$.trim(master_salon)+'</p>');
		
		//$('.wpcf7-form img').attr('width', 200)
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



	/* выбор салона в формах CF7 */
	$('.order-to-salon').click(function()
	{
		var s = $(this).attr('data-salon');
		//alert(s)
		$('.cf7-select-salon option').attr('selected', false);

		$('.cf7-select-salon option').each(function()
		{
			var str = $(this).attr('value');
			if(str.toLowerCase() == s.toLowerCase())
			{
				$(this).attr('selected', 'selected');
				$('.cf7-salon-name').attr('value', str);
			}				
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
	//alert($('.video-item').eq(0).find('a').attr('data-dscr'))
	//get_video_title($('.video-item').eq(0).find('a').attr('data'));

	$('.video-item a').click(function()
	{
		$u = $(this).attr('href');
		$('iframe').attr('src', $u);

		$('.video-item').removeClass('video-item-selected');
		$(this).parent('.video-item').addClass('video-item-selected');
		
		$('h2').text($(this).find('img').attr('title'))
		$('#gallery-content p').eq(0).html($(this).attr('data-dscr'))
		

		return false;
	})
	/* /ВИДЕО ГАЛЕРЕЯ */



/* автоподстановка данных мастера в форме записи */
	$('.speaker-topic-title > h4 > a, .our-team .master-button').click(function()
		{
			obj = $(this);
			set_master_info(obj);
		})
	/* /автоподстановка данных мастера в форме записи */

})

