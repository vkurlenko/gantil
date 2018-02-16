<?php
/*
Template Name: Страница
*/

get_header(); 
?>


						<!-- content -->
						<?php
						$post = get_post();
						
						//print_r($post);
						?>
						<div class="row-fluid">
							<div class="container-fluid content">
								
																
								<!-- breadcrumbs -->
								<?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(' > '); ?>
								<!-- /breadcrumbs -->
	
								<div class="content-article">
									
									<?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>
								   		
								   		<h1><?php the_title();?></h1>	
										

										<!-- submenu -->
										<ul class="submenu">
										<?php  
										$arr_menu = wp_list_pages( 
										    array(
										        'title_li' => '',
										        'child_of' => $post->ID,
										        'depth' => 1,
										      	'echo' => true
										    ) 
										); 

										//echo $arr_menu;

										
										?>
										</ul>
										<div style="clear:both"></div>
										<!-- /submenu -->

					
										<!-- кнопки -->
										<div class="contacts-tabs">											
												<button class="master-button tab1 master-button-unactive">Адреса салонов</button>																																		
												<button class="master-button tab2">Салоны на карте</button>																							
										</div>
										<div style="clear:both"></div>
										<!-- /кнопки -->

										

										<!-- адреса -->
										<div class="contacts-content-tab1 contacts-address">
											<?php the_content();?>
										</div>
										<!-- /адреса -->


										<!-- карта -->
										<div class="contacts-content-tab2">
											<script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=pPlCZpxo2w_0NHxME5elMNwItucLAayl&width=&height=400&lang=ru_RU&sourceType=constructor"></script>
										</div>
										<!-- /карта -->

										<style>
										


										</style>

										<script language="javascript">
										$(document).ready(function()
										{
											$('.tab1, .tab2').click(function()
											{
												$('.tab1, .tab2').removeClass('master-button-unactive');
												$(this).addClass('master-button-unactive');
											})

											$('.tab1').click(function()
											{

												$('.contacts-content-tab2').css('display', 'none');
												$('.contacts-content-tab1').css('display', 'block');
												return false;
											})

											$('.tab2').click(function()
											{
												
												$('.contacts-content-tab1').css('display', 'none');
												$('.contacts-content-tab2').css('display', 'block');
												return false;
											})
										})
										</script>
										

									<?php endwhile; ?>
									<?php endif; ?>
									
									
								</div>
							</div>
						</div>
						<!-- /content -->
					</div>
					<!-- /left-block -->

	<?php
get_footer()
?>