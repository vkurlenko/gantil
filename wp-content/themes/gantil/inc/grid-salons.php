<?php
$post = get_post();
$post_name = $post->post_name;

$is_price = false;
if(@$post_name && $post_name == 'price')
	$is_price = true;

$arr_replace = array(
	'salon_leninsky' => 'На Ленинском',
	'salon_kolom' 	=> 'На Коломенской',
	'salon_bratis' => 'На Братиславской',
	'salon_sokol' => 'На Соколе',
	'salon_shodnya' => 'На Сходненской',
	'salon_dom_krasoty' => 'На м.Аэропорт'
	);

$arr_replace_2 = array(
	'salon_leninsky' => 'Жантиль на Ленинском',
	'salon_kolom' 	=> 'Жантиль на Коломенской',
	'salon_bratis' => 'Жантиль на Братиславской',
	'salon_sokol' => 'Жантиль на Соколе',
	'salon_shodnya' => 'Жантиль на Сходненской',
	'salon_dom_krasoty' => 'Жантиль м.Аэропорт'
	);

$arr_since = array(
    'salon_leninsky' => 2008,
    'salon_kolom' 	=> 2004,
    'salon_bratis' => 2005,
    'salon_sokol' => 2006,
    'salon_shodnya' => 2002,
    'salon_dom_krasoty' => 2015
);
?>

<style type="text/css">
	.grid-salons .salons-item-img{/* display: none; */}
    .salon-since{
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        padding: 2px 5px;
        color: #fff;
        background: #666;
        /*font-style: italic;
        font-weight: bold;*/
    }
</style>

<div class="container-fluid grid-salons">

	<h2 class="frontpage-h2">Наши салоны</h2>

	<!-- a = <div id="a"></div>
	slick = <div id="slick"></div> -->

	<div class="row-fluid grid-salons-slider grid-salons-slick">

		<?
		$args = array(
			'sort_order'   => 'ASC',
			'sort_column'  => 'menu_order',
			'hierarchical' => 0,
			'exclude'      => '',
			'include'      => '',
			'meta_key'     => '',
			'meta_value'   => '',
			'authors'      => '',
			'child_of'     => 117,
			'parent'       => -1,
			'exclude_tree' => '',
			'number'       => '',
			'offset'       => 0,
			'post_type'    => 'page',
			'post_status'  => 'publish',
		); 
		$pages = get_pages( $args );
		//shuffle($pages);

		foreach( $pages as $post )
		{
			setup_postdata( $post );

			$meta = get_metadata( 'post', $post->ID, 'salon_address', true);
			$salon_address_short = get_metadata( 'post', $post->ID, 'salon_address_short', true);
			
			

			// формат вывода
			?>
			<div class="col-md-4 col-sm-6 col-xs-6 salons-item ">
				<?
				$is_price ? $link = "/price/price-service/?salon=".$post->post_name : $link = get_page_link( $post->ID );
				?>
				<a href="<?php echo $link ?>">
					<?php //echo the_post_thumbnail('salon_thumb', array('class' => 'salons-item-img')) ?>

					<?
					$thumb_id = get_post_thumbnail_id();
					$thumb_url = wp_get_attachment_image_src($thumb_id,'salon_thumb', true);
					?>
					<img class="salons-item-img img-mono" src="<?=makeGrayPic($thumb_url[0])?>">
					<img class="salons-item-img img-color" src="<?=$thumb_url[0]?>">

	                <span class="salon-since">Since <? echo $arr_since[$post->post_name];?></span>
					
					<div class="salons-item-name grid-block-button"><? echo $arr_replace[$post->post_name];?>					
						<div class="salons-address"><?=$salon_address_short?></div>
					</div>	
					
				</a>
				


				<ul class="box-menu">
				
				<?
				if($is_price)
				{
					?>
					<li class="box-menu-left "><a class="" href="/price/price-service/?salon=<? echo $post->post_name;?>">Услуги</a></li>
					<li class="box-menu-right "><a class="" href="/price/price-butik/">Бутик</a></li>
					<?
				}
				else
				{
					?>
					<li class="box-menu-left "><a class="" href="<?php echo get_page_link( $post->ID ); ?>">Подробнее</a></li>
					<li class="box-menu-right fancybox-inline "><a onclick="return false;" class="order-to-salon " data-salon="<? echo $arr_replace_2[$post->post_name]; //$post->post_title;?>" href="#contact_form_pop_up">Записаться</a></li>
					
					<?php 
					/*if(user_admin())
					{
						?><li class="box-menu-right fancybox-inline "><a onclick="return false;" class="order-to-salon " data-salon="" href="#contact_form_pop_up_4">Звонок</a></li>
						<?php
					}*/
					?>
					<?
				}
				?>
				
					<div style="clear:both"></div>
				</ul>


				
			</div>	
			<?

			
		}  
		wp_reset_postdata();

		//printArray($pages);
		?> 
		
	</div>
</div>


<script type="text/javascript">



$(document).ready(function(){

	//make_gallery_slick();

	/*$('.salons-item').mouseenter(function()
	{
		
		$(this).find('.salons-address').animate({height: 'show'}, 500);
		
		$(this).find('.img-color').show()
		$(this).find('.img-mono').animate({opacity: 0}, 300);
	}).mouseleave (function()
	{
		
		$(this).find('.salons-address').animate({height: 'hide'}, 500);

		$(this).find('.img-mono').animate({opacity: 1}, 500);		
	})*/

//slick_salon();

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
		
});

</script>