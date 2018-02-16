<?
$args = array(
	'sort_order'   => 'ASC',
	'sort_column'  => 'menu_order',
	'hierarchical' => 1,
	'exclude'      => '',
	'include'      => '',
	'meta_key'     => '',
	'meta_value'   => '',
	'authors'      => '',
	'child_of'     => 0,
	'parent'       => 117,
	'exclude_tree' => '',
	'number'       => '',
	'offset'       => 0,
	'post_type'    => 'page',
	'post_status'  => 'publish'
); 
$pages = get_pages( $args );
$arr_s = array();
foreach( $pages as $post )
{
	$arr_s[$post->post_name] = $post->post_title;	
}  
wp_reset_postdata();
?>




<div class="col-md-9 col-sm-9 col-xs-12 main-menu">

	<nav class="navbar navbar-expand-lg navbar-light bg-light menu-salon">  
	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	    <ul class="navbar-nav mr-auto">	      
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          Ваш салон: <? if(@$_SESSION['salon']) echo $arr_s[$_SESSION['salon']]; else echo 'не выбран';?>
	        </a>
	        <div class="dropdown-menu" id="inline" aria-labelledby="navbarDropdown">
				<ul>
				<?
				foreach($arr_s as $k => $v)
				{
					?><li><a class="dropdown-item" href="#" data-name="<?=$k?>" data-title="<?=$v?>"><?=str_replace(' ', '&nbsp;', $v)?></a></li>
					<?
				}
				?>
				</ul>
              
	        </div>
	      </li>	      
	    </ul>	    
	  </div>
	</nav>
		
	<div>
		
		

		<?php 

		$icons = '
		<li class="soc"><a target="_blank" href="'.get_option('g_options')['social_in'].'"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
		<li class="soc"><a target="_blank" href="'.get_option('g_options')['social_fb'].'"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
		<li class="soc"><a target="_blank" href="'.get_option('g_options')['social_vk'].'"><i class="fa fa-vk" aria-hidden="true"></i></a></li>';

		$call = '<li class="li-call menu-item menu-item-type-custom menu-item-object-custom fancybox-inline"><a data-salon="" href="#contact_form_pop_up_4" onclick="return false;" class=" arrow" >Заказать звонок</a></li>';
		/*if(user_admin())
		{
			$call = '<li class="li-call menu-item menu-item-type-custom menu-item-object-custom fancybox-inline"><a data-salon="" href="#contact_form_pop_up_4" onclick="return false;" class=" arrow" >Заказать звонок</a></li>';
		}
		else
			$call = '<li class="li-call menu-item menu-item-type-custom menu-item-object-custom"><a href="#" onclick="return false;" class="ecp-trigger arrow" data-modal="modal" >Заказать звонок</a></li>';*/
		// <li class="box-menu-right fancybox-inline "><a onclick="return false;" class="order-to-salon " data-salon="" href="#contact_form_pop_up_4">Звонок</a></li>

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
			'items_wrap'      => '<ul id="%1$s" class="%2$s">'.$call.'%3$s'.$icons.'</ul>',
			'depth'           => 0,
			'walker'          => ''
			);

		$m = wp_nav_menu( $args );
		//print_r($m);
		?>

	<div style="clear:both"></div>
	</div>
<!-- <a href="#" class="ecp-trigger" data-modal="modal" id="onload"> Заказать звонок</a> -->

	<nav class="navbar navbar-default ">
		<!-- <div class="container-fluid"> -->
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header ">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<!-- <a class="navbar-brand" href="/"><img src="/wp-content/themes/gantil/img/logo_m_8.png"></a> -->
			<a class="navbar-brand" href="/"><img src="https://pp.userapi.com/c824600/v824600908/3d471/FM0kSULZX-o.jpg" width=65></a>
			
			<!-- fich -->
			<!-- <a href="/cart/" class="fich fich-basket"><i class="fa fa-lg fa-shopping-basket" aria-hidden="true"></i></a> -->
			<a href="/calendar/" class="fich fich-theme fich-calendar"><i class="fa fa-lg fa-calendar" aria-hidden="true"></i></a>
			<!-- <a href="#"  onclick="return false;" class="fich fich-theme fich-phone ecp-trigger arrow" data-modal="modal"><i class="fa fa-lg fa-phone" aria-hidden="true"></i></a>  -->
			<li class="fancybox-inline" style=" list-style:none"><a data-salon="" href="#contact_form_pop_up_4" onclick="return false;"  class="fich fich-theme fich-phone" ><i class="fa fa-lg fa-phone" aria-hidden="true"></i></a></li>
			<!-- /fich -->


		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->


		<?php 

		$args = array(
			'theme_location'  => 'top',
			'menu'            => '', 
			'container'       => 'div', 
			'container_class' => 'collapse navbar-collapse', 
			'container_id'    => 'bs-example-navbar-collapse-1',
			'menu_class'      => 'nav navbar-nav', 
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

	<!-- /.navbar-collapse -->
			<!-- /.container-fluid -->
	</nav>
	
</div>

