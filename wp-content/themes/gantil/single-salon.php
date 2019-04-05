<?php
/*
Template Name: Страница салона
*/

get_header(); 
?>


						<!-- content -->
						<?php
						$post = get_post();
						
						
						?>
						<div class="row-fluid">
							<div class="container-fluid content">
								
																
								<!-- breadcrumbs -->
								<?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(' > '); ?>
								<!-- /breadcrumbs -->
	
								<div class="content-article salon-card">
									
									<?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>
								   		
								   		<h1><?php the_title();?></h1>	
										

										<!-- submenu -->
										<!--<ul class="submenu">
										<?php /*
										$arr_menu = wp_list_pages( 
										    array(
										        'title_li' => '',
										        'child_of' => $post->ID,
										        'depth' => 1,
										      	'echo' => false
										    ) 
										); 

										echo $arr_menu;										
										*/?>
										</ul>
										<div style="clear:both"></div>-->
										<!-- /submenu -->


										<div class="row-fluid">

											<!-- адрес -->
											<div class="col-md-6 left0">												
												<p class="salon-address">
												<?
												echo get_post_meta($post->ID, 'salon_address', true);
												?>												
												</p>												
											</div>
											<!-- /адрес -->

											<!-- <div class="col-md-12">
												<ul class="salons-item-menu">
													<li class="pr li-call"><a class="grid-block-button ecp-trigger arrow" data-modal="modal" onclick="return false;" href="#">Заказать звонок</a></li>
													<li class="ord fancybox-inline "><a onclick="return false;" class="order-to-salon grid-block-button" data-salon="<?=$post->post_title?>" href="#contact_form_pop_up">Записаться</a></li>
													
												</ul>
											</div>  -->

											<style>
											.salons-item-menu-2, .salons-item-menu-2 li{
												display: block;
												padding:0;
												margin:0;
											}
											.salons-item-menu-2{
												border:2px solid #606060;
											}
											.salons-item-menu-2 li{
												float: left;
												width: 20%;
												text-align: center;
											}

											.salons-item-menu-2 li a{color:#606060;
												text-transform: uppercase;}

											.salons-item-menu-2 li.dark{
												background: #606060;
												color:#fff;
												-webkit-transform: skewX(-15deg); 
												-moz-transform: skewX(-15deg); 
												-ms-transform: skewX(-15deg); 
												-o-transform: skewX(-15deg); 
												transform: skewX(-15deg); 
											}

											.salons-item-menu-2 li.dark > *{
												-webkit-transform: skewX(15deg); 
												-moz-transform: skewX(15deg); 
												-ms-transform: skewX(15deg); 
												-o-transform: skewX(15deg); 
												transform: skewX(15deg); 
											}


											.salons-item-menu-2 li.dark a{color:#fff;}

											.carousel-slider-outer{margin-bottom: 20px}

											.carousel-slider-nav-icon{background: #fff}
											</style>

											<div style="clear:both"></div>

											<div class="">
												<ul class="salons-item-menu-2">
													<li class="light li-call fancybox-inline"><a class="grid-block-button ecp-trigger arrow" data-modal="modal" data-salon="<?=$post->post_title?>" onclick="return false;" href="#contact_form_pop_up_4">Заказать звонок</a></li>
													<li class="dark fancybox-inline "><a onclick="return false;" class="order-to-salon grid-block-button" data-salon="<?=$post->post_title?>" href="#contact_form_pop_up">Записаться</a></li>
													<li class="light"><a class="grid-block-button" href="/product-category/service/">Услуги</a></li>
													<li class="dark "><a class="grid-block-button" href="/prices/price-service/">Цены</a></li>
													<li class="light"><a class="grid-block-button" href="/masters/?salon=<?=$post->post_name?>">Мастера</a></li>
													<div style="clear:both"></div>
												</ul>
											</div>
										
											<div style="clear:both"></div>

											<!-- контент -->
											<div style="clear:both">	
											<br>								
												<?php the_content();?>											 
											</div>
											<!-- /контент -->

											<!-- карта -->
											<div class="">												
												<div>
												<?
												echo get_post_meta($post->ID, 'salon_map', true);
												?>
												</div>												
											</div>
											<!-- /карта -->
											
										</div>
					
										

										

									<?php endwhile; ?>
									<?php endif; ?>
									
									
								</div>
							</div>
						</div>
						<!-- /content -->
					</div>
					<!-- /left-block -->

					<script type="text/javascript">
					$(document).ready(function()
					{

						$('.director').click(function()
						{
							var name = $(this).attr('data-person');
							var salon = $(this).attr('data-salon');
							$('#contact_form_pop_up_6').find('#master_name').attr('value', name);
							$('#contact_form_pop_up_6').find('#master_salon').attr('value', salon);
							$('#contact_form_pop_up_6').find('#salon_email').attr('value', '<?=get_option("g_options")["email_".$post->post_name]?>');

						})
					})
					</script>
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget_salon') ) : ?>
<?php endif; ?>
	<?php
get_footer()
?>