<?php
/*
Template Name: Салоны - главная
*/

get_header(); 
?>


						<!-- content -->
						<?php
						$post = get_post();

						//printArray($post);
						
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
										<!-- <ul class="submenu">
										<?php  
										$arr_menu = wp_list_pages( 
										    array(
										        'title_li' => '',
										        'child_of' => $post->ID,
										        'depth' => 1,
										      	'echo' => false
										    ) 
										); 
										
										echo $arr_menu;
										
										?>
										</ul> -->
										<div style="clear:both"></div>
										<!-- /submenu -->

					
										<div class="content-img-service"><?php the_post_thumbnail();?></div>
										<div>							
											<?php the_content();?>



											<!-- Our salons -->
											<?
											$post = get_post();
											$post_name = $post->post_name;


											$is_price = false;
											if(@$post_name && $post_name == 'price')
												$is_price = true;
											?>

											<style type="text/css">
												.grid-salons .salons-item-img{/* display: none; */}
											</style>

											<div class="container-fluid grid-salons">

												<h2 class="frontpage-h2">Наши салоны</h2>												

												<div class="row-fluid grid-salons-slider ">

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

													shuffle($pages);

													$arr_replace_2 = array(
															'salon_leninsky' 	=> 'Жантиль на Ленинском',
															'salon_kolom' 		=> 'Жантиль на Коломенской',
															'salon_bratis' 		=> 'Жантиль на Братиславской',
															'salon_sokol' 		=> 'Жантиль на Соколе',
															'salon_shodnya' 	=> 'Жантиль на Сходненской',
															'salon_dom_krasoty' => 'Жантиль м.Аэропорт'
															);

													
													foreach( $pages as $post )
													{
														setup_postdata( $post );

														$meta = get_metadata( 'post', $post->ID, 'salon_address', true);
														$salon_address_short = get_metadata( 'post', $post->ID, 'salon_address_short', true);
														
														$arr_replace = array(
															'salon_leninsky' 	=> 'На Ленинском',
															'salon_kolom' 		=> 'На Коломенской',
															'salon_bratis' 		=> 'На Братиславской',
															'salon_sokol' 		=> 'На Соколе',
															'salon_shodnya' 	=> 'На Сходненской',
															'salon_dom_krasoty' => 'На м.Аэропорт'
															);

														// формат вывода
														?>
														<div class="col-md-4 col-sm-6 col-xs-12 salons-item ">
															<?															
															$link = get_page_link( $post->ID );
															?>
															<a href="<?php echo $link ?>">															
																			
															<?
															$thumb_id = get_post_thumbnail_id();
															$thumb_url = wp_get_attachment_image_src($thumb_id,'salon_thumb', true);
															?>
															<img class="salons-item-img img-mono" src="<?=makeGrayPic($thumb_url[0])?>">
															<img class="salons-item-img img-color" src="<?=$thumb_url[0]?>">
																													
															<div class="salons-item-name grid-block-button"><? echo $arr_replace[$post->post_name];?>					
																<div class="salons-address"><?=$salon_address_short?></div>
															</div>	
															
														</a>
														
														

														<ul class="box-menu">
															<li class="box-menu-left "><a class="" href="<?php echo get_page_link( $post->ID ); ?>">Подробнее</a></li>
															<li class="box-menu-right fancybox-inline "><a onclick="return false;" class="order-to-salon " data-salon="<? echo $arr_replace_2[$post->post_name];?>" href="#contact_form_pop_up">Записаться</a></li>
															<div style="clear:both"></div>
														</ul>


														
													</div>	
														<?														
													}  
													wp_reset_postdata();

													?> 
													
												</div>
											</div>


											<script type="text/javascript">

											$(document).ready(function(){

												//make_gallery_slick();

												$('.salons-item').mouseenter(function()
												{
													/*$(this).find('.salons-item-name').animate({bottom: '45px'}, 500);*///addClass('salons-item-name-over')
													$(this).find('.salons-address').animate({height: 'show'}, 500);//.toggle('slow')
													
													$(this).find('.img-color').show()
													$(this).find('.img-mono').animate({opacity: 0}, 300);
												}).mouseleave (function()
												{
													/*$(this).find('.salons-item-name').animate({bottom: '5px'}, 500);*///.removeClass('salons-item-name-over')
													$(this).find('.salons-address').animate({height: 'hide'}, 500);

													$(this).find('.img-mono').animate({opacity: 1}, 500);		
												})
													
											});

											</script>

											
											<!-- /Our salons -->
										</div>

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