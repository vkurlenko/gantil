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
                    <img class="grid-item-img <?=wp_is_mobile() ? '' : 'img-mono';?>" src="<?=makeGrayPic($thumb_url[0])?>" alt="<?php the_title(); ?>" data-imgcolor="<?=wp_is_mobile() ? '' : $thumb_url[0];?>">
					<div class="grid-item-name grid-block-button"><?php the_title(); ?></div>
				</a>			
			</div>
			<?

		}
		wp_reset_postdata();
		?>		
	</div>

	<div class="grid-news-menu">
		<ul>
			<li class="menu-left"><a class="grid-block-button" href="/newss/">Все новости</a></li>
			<li class="menu-center fancybox-inline"><a class="grid-block-button" href="#contact_form_pop_up_2">Подписаться</a></li>
			<!-- <li class="menu-center fancybox-inline"><a class="grid-block-button" href="">Подписаться</a></li> -->
			<li class="menu-right"><a class="grid-block-button" href="/actions/">Все акции</a></li>
			<div style="clear:both"></div>
		</ul>
	</div>

</div>
