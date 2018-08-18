<?
$args = array(
	'numberposts' => 10,
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

//$size = 'news_thumb_b';

?> 
<style type="text/css">
	.grid-news-slider{display: none;}

	.over-text {
	    display: block;
	    text-align: center;
	    font-size: 14px;
	    text-transform: none;
	    font-weight: normal;
	    margin-left: 0;
	    position: absolute;
	    bottom: 0;
	    background: rgba(96, 96, 96, 0.64);
	    padding: 10px;
	    color: #fff;
	    width: 100%;

	    /* background: rgba(96, 96, 96, 0.64); */
	    /* background: -webkit-linear-gradient(top, rgba(0,0,0,0) 0%,rgba(0,0,0,0.65) 100%); */
	    /* background: linear-gradient(to bottom, rgba(0,0,0,0) 0%,rgba(0,0,0,0.65) 100%); */
	}
	
</style>
<div class="container-fluid grid-news">

	<h2 class="frontpage-h2">Новости и акции</h2>

	<div class="row-fluid grid-news-slider">
		<?		
		foreach( $posts as $post )
		{ 
			setup_postdata($post);

			

			if( !is_sticky( $post->ID ) )
				continue;
			?>
	

			<?
			$thumb_id = get_post_thumbnail_id();
			$thumb_url = wp_get_attachment_image_src($thumb_id, 'news_thumb_b', true);
			?>
			


			<div class="grid-item grid-item-news">
				
				<a href="<?php the_permalink(); ?>">
					<img class="grid-item-img img-mono" src="<?=makeGrayPic($thumb_url[0])?>">
					<img class="grid-item-img img-color" src="<?=$thumb_url[0]?>">
					
					<?php 
					if( has_excerpt() ) :?>
						<div class="over-text"><?php the_excerpt()?></div>
					<?php endif;?>	
					
				</a>	

				<div class="grid-item-name grid-block-button" style="position: relative;"><?php the_title(); ?>
							
					</div>	
				
			</div>
			<?

		}
		wp_reset_postdata();
		?>		
	</div>

	<div class="grid-news-menu">
		<ul>
			<li class="menu-left"><a class="grid-block-button" href="/newss/">Все новости</a></li>
			<!-- <li class="menu-center fancybox-inline"><a class="grid-block-button" href="#contact_form_pop_up_2">Подписаться</a></li> -->
			<li class="menu-center fancybox-inline"><a class="grid-block-button" href="">Подписаться</a></li>
			<li class="menu-right"><a class="grid-block-button" href="/actions/">Все акции</a></li>
			<div style="clear:both"></div>
		</ul>
	</div>

</div>

<script type="text/javascript">
$(document).ready(function()
{
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

	max = 0;

	$('.grid-item-name').each(function()
	{

		if($(this).height() > max)
			max = $(this).height()
	})

	$('.grid-item-name').height(max)

	$('.grid-item-news').mouseenter(function()
	{
		$(this).find('.grid-block-button').css('color', '#000')
		
		
		$(this).find('.img-color').show()
		$(this).find('.img-mono').animate({opacity: 0}, 300);
	}).mouseleave (function()
	{
		$(this).find('.grid-block-button').css('color', '#606060')
		
		$(this).find('.img-mono').animate({opacity: 1}, 500);		
	})
});
</script>