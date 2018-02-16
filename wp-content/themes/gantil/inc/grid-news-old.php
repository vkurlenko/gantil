<style type="text/css">
	.grid-news-slider{display: none;}
	
</style>
<div class="container-fluid grid-news">
	<div class="row-fluid grid-news-slider">


		<?
		$args = array(
			'numberposts' => 9,
			'category' 	  => '12, 13, 18, 19', // новости, новинки, статьи, акции
			'orderby'     => 'date',
			'order'       => 'DESC',
			'include'     => array(),
			'exclude'     => array(),
			'meta_key'    => '',
			'meta_value'  =>'',
			'post_type'   => 'post',
			'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
		);
		
		$posts = get_posts( $args );

		$i = 0; $j = 0;
		?>
		<div class="grid-col grid-col-left">
		<?
		foreach( $posts as $post )
		{ 
			setup_postdata($post);

			if($i == 3 || $i == 6)
			{
				$i == 3 ? $class = 'grid-col-center' : $class = 'grid-col-right';
				?></div><div class="grid-col <?=$class?>"><?
			}

			if($i == 0 || $i == 8)			
				$size = 'news_thumb_b';
			elseif($i == 2 || $i == 6)
				$size = 'news_thumb_s';
			else
				$size = 'news_thumb_m';
			

			?>
			<div class="grid-item">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail($size, array("class"=>"grid-item-img"));?><!-- <img class="grid-item-img" src="/wp-content/uploads/2017/08/grid_b-e1503656734687.jpg"> --></a>
				<div class="grid-item-name"><?php the_title(); ?></div>				
			</div>			
			<?php
			$i++;
		}
		wp_reset_postdata();
		?>
		</div>


		<!-- <div class="grid-col ">
			<div class="grid-item">
				<a href="#"><img class="grid-item-img" src="/wp-content/uploads/2017/08/grid_b-e1503656734687.jpg"></a>
				<div class="grid-item-name">Дни марки Kerastase</div>				
			</div>
			<div class="grid-item ">
				<a href="#"><img class="grid-item-img" src="/wp-content/uploads/2017/08/grid_m.jpg"></a>
				<div class="grid-item-name">Дни марки Kerastase</div>				
			</div>
			<div class="grid-item ">
				<a href="#"><img class="grid-item-img" src="/wp-content/uploads/2017/08/grid_s.jpg"></a>
				<div class="grid-item-name">Дни марки Kerastase</div>				
			</div>
			
		</div>
		
		<div class="grid-col ">
			<div class="grid-item ">
				<a href="#"><img class="grid-item-img" src="/wp-content/uploads/2017/08/grid_m.jpg"></a>
				<div class="grid-item-name">Дни марки Kerastase</div>				
			</div>
			<div class="grid-item ">
				<a href="#"><img class="grid-item-img" src="/wp-content/uploads/2017/08/grid_m.jpg"></a>
				<div class="grid-item-name">Дни марки Kerastase</div>				
			</div>
			<div class="grid-item ">
				<a href="#"><img class="grid-item-img" src="/wp-content/uploads/2017/08/grid_m.jpg"></a>
				<div class="grid-item-name">Дни марки Kerastase</div>				
			</div>
		</div>
		
		<div class="grid-col ">
			<div class="grid-item ">
				<a href="#"><img class="grid-item-img" src="/wp-content/uploads/2017/08/grid_s.jpg"></a>
				<div class="grid-item-name">Дни марки Kerastase</div>				
			</div>
			<div class="grid-item ">
				<a href="#"><img class="grid-item-img" src="/wp-content/uploads/2017/08/grid_m.jpg"></a>
				<div class="grid-item-name">Дни марки Kerastase</div>				
			</div>
			<div class="grid-item ">
				<a href="#"><img class="grid-item-img" src="/wp-content/uploads/2017/08/grid_b-e1503656734687.jpg"></a>
				<div class="grid-item-name">Дни марки Kerastase</div>				
			</div>
		</div> -->
	</div>

	<div class="grid-news-menu">
		<ul>
			<li class="menu-left"><a href="/newss/">Все новости</a></li>
			<li class="menu-center fancybox-inline"><a href="#contact_form_pop_up_2">Подписаться</a></li>
			<li class="menu-right"><a href="/actions/">Все акции</a></li>
			<div style="clear:both"></div>
		</ul>
	</div>

</div>

<script type="text/javascript">
$(document).ready(function(){
  $('.grid-news-slider').show().slick({
    dots: true,
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
      settings: {slidesToShow: 2, slidesToScroll: 2 }
    },
    {
      breakpoint: 480,
      settings: { slidesToShow: 1, slidesToScroll: 1, arrows: false }
    }]
    // prevArrow : '<button type="button" class="slick-prev slick-prev-my">Prev</button>',
    
  });

max = 0;
$('.grid-item-name').each(function()
{
	//alert($(this).height())

	if($(this).height() > max)
		max = $(this).height()
})
$('.grid-item-name').height(max)
});</script>