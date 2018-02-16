<div class="col-md-2 col-sm-2 right-block right0">
	<div>
		<!-- <ul class="menu-service">
			<li class="li-lk"><a href="">Личный кабинет</a></li>
			<li class="li-bsc"><a href="">Ваша корзина</a></li>									
			<li class="li-cl"><a href="">Заявка на услугу</a></li>
			<li class="li-call"><a href="">Заказать звонок</a></li>
		</ul> -->


		<?php 

		$args = array(
			'theme_location'  => 'right',
			'menu'            => '', 
			'container'       => '', 
			'container_class' => '', 
			'container_id'    => '',
			'menu_class'      => 'menu-service', 
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth'           => 0,
			'walker'          => ''
			);

		wp_nav_menu( $args );
		?>

		<i class="fa fa-instagram" aria-hidden="true"></i>

		
		<div style="clear:both"></div>

		<!-- <ul class="menu-fich">
			<li><a href=""><i class="fa fa-lg fa-shopping-basket" aria-hidden="true"></i></a></li>
			<li><a href=""><i class="fa fa-lg fa-venus-mars" aria-hidden="true"></i></a></li>
		</ul> -->
		
		<div style="clear:both"></div>
		
		<!-- widgets-block -->
		<?php get_template_part('inc/widgets-block');?>
		<!-- /widgets-block -->


	</div>
</div>
<div style="clear:both"></div>