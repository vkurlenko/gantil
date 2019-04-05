<?
$post = get_post(1053);
setup_postdata( $post );
?>

<div class="container-fluid block-image">
	<div class="row-fluid ">

		<a class="image-img" href="<?php echo get_page_link( $post->ID ); ?>">

			<!-- 
			удалено из function.php
			add_image_size( 'imageconsult_thumb', 1530, 240, true );
			add_image_size( 'imageconsult_thumb_mobi', 460, 307, true );
			  -->

			<?php echo the_post_thumbnail('imageconsult_thumb') ?>
			<!-- <img src="/wp-content/uploads/2017/08/image.jpg"> -->
		</a>
		 <div class="image-name">Имиджконсультирование как искусство создания вашего имиджа</div>
		
		
		<div class="image-menu">
			<ul>
				<li class="menu-left"><a href="#">Цена</a></li>
				<li class="menu-center"><a href="<?php echo get_page_link( $post->ID ); ?>">Подробнее</a></li>
				<li class="menu-right"><a href="#">Записаться</a></li>
				<div style="clear:both"></div>
			</ul>
		</div> 
	</div>
</div>