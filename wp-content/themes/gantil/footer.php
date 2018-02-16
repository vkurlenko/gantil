
	<?php /*get_template_part('inc/right-block');*/ ?>

	<?php get_template_part('inc/footer-block');?>
	

	<?php wp_footer(); ?>

	
	<?
	/*global $_GET;

	
	if($_GET['go'] == 1)
		set_users();//update_gallery_date();*/

	?>

	<!--<script src="https://unpkg.com/imask"></script>-->
	<script src="/wp-content/themes/gantil/js/mask.js"></script>
	<script>
	
	var maskOptions = {
	  mask: '+{7}(000)000-00-00'
	};

	var arr = new Array('input-tel', 'tel-698', 'tel-699', 'tel-568', 'billing_phone');

	for(i = 0; i < arr.length; i++)
	{
		var element3 = document.getElementById(arr[i]);
		if(element3)
			var mask = new IMask(element3, maskOptions);
	}	

	</script>

	
	<script type="text/javascript">

	$(document).ready(function()
	{

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
		
		$('.variations_form select').not('#pa_order_time').change(function()
		//$('form.variations_form  select').change(function()
		{

			console.log('ok')
			//alert('ok')

			if($(this).attr('id') == 'pa_item_salon')
			{
				set_salon($('#pa_item_salon').val())
			}
			

			if($(this).val() == '')
			{
				// если выбран пустой пункт, то последующие скроем и обнулим
				p = $(this).parents('tr');
				$(p).nextAll('tr').find('select').removeClass('visible').prop('selectedIndex',0);	

				//$(p).next('tr').find('select').addClass('visible');			
			}
			else
			{
				// если выбран НЕпустой пункт, то последующие покажем
				p = $(this).parents('tr');
				$(p).nextAll('tr').find('select').removeClass('visible').prop('selectedIndex',0);	
				$(p).next('tr').find('select').addClass('visible');

				if($(p).next('tr').find('select').attr('id') == 'pa_item_period')
					$('#pa_item_period').prop('selectedIndex',1);
			}

			$("#selectMaster").remove();
			
		})

		$('#pa_item_spec').change(function()
	  	{  		
	  		$("#selectMaster").remove();
	  		$("#pa_item_master").attr('value', '');
	  		//$('.single_add_to_cart_button').addClass('hidden-button')

	  		$("#pa_item_master").after('<div id="wait" ><img src="/wp-content/uploads/2017/08/wczytywanie.gif"></div>');

	  		var item_salon = $('#pa_item_salon').val(); // выбранный салон
	  		var item_spec  = $(this).val();				// выбранная специализация

	  		var data = {
				action : 'hello',
				salon  : item_salon,
				spec   : item_spec
	  		};

	  		// сделаем AJAX запрос на вывод мастеров в соотв. с критериями
	  		jQuery.get('/wp-admin/admin-ajax.php', data, function(response)
	  		{
	  			$('#wait').remove();
	  			$("#pa_item_master").after('<div id="selectMaster" class="visible"></div>');
	  			$(response).appendTo($("#selectMaster"));

	  			//$('.master_name, .item-master img').click(function()
	  			$('.item-master').click(function()
	  			{
	  				$("#pa_item_master").attr('value', $(this).parents('li').find('.master_name').text());
	  				$('.item-master').removeClass('item-master-selected');
	  				$(this).parents('.item-master').addClass('item-master-selected');
	  				$("#pa_item_master").attr('value', $(this).find('.master_name').text());
	  				$('.item-master').removeClass('item-master-selected');
	  				$(this).addClass('item-master-selected');

	  				// определим цвет смены выбранного мастера и сделаем неактивными другие смены
	  				if($(this).hasClass('watch-red'))
	  					setColor('watch-red');
	  					 
	  				if($(this).hasClass('watch-green'))
	  					setColor('watch-green');

	  				if($(this).hasClass('watch-all'))
	  					setColor('watch-all');	  				
	  				// /определим цвет смены выбранного мастера и сделаем неактивными другие смены
	  							
	  				if($("#pa_item_master").attr('value'))
	  					$('.single_add_to_cart_button').removeClass('hidden-button')		

	  				return false;
	  			})
	  			
	  			console.log(response);
	  		})
	  	
	  	})

		$("a.go-to-top").click(function() 
			{
		      $("html, body").animate({
		         scrollTop: $($(this).attr("href")).offset().top + "px"
		      }, {
		         duration: 500,
		         easing: "swing"
		      });
		      return false;
		   });
	})

	

	</script>




	</body>
</html>