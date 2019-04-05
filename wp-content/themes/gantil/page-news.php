<?php
/*
Template Name: Список новостей и акций
*/

get_header(); 
?>


						<!-- content -->
						<?php
						$post = get_post();
						
						//print_r($post);
						$post_name = $post->post_name;
						//echo $post_name;
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
										<?php 
										// выводим меню (подменю) НОВОСТИ

										$args = array(
											'theme_location'  => 'menu-news',
											'menu'            => '', 
											'container'       => '', 
											'container_class' => 'collapse navbar-collapse', 
											'container_id'    => 'bs-example-navbar-collapse-1',
											'menu_class'      => '', 
											'menu_id'         => '',
											'echo'            => true,
											'fallback_cb'     => 'wp_page_menu',
											'before'          => '',
											'after'           => '',
											'link_before'     => '',
											'link_after'      => '',
											'items_wrap'      => '<ul id="%1$s" class="submenu %2$s">%3$s</ul>',
											'depth'           => 0,
											'walker'          => ''
											);


										if($post_name != 'actions')
											wp_nav_menu( $args );
										?>
										<!-- /submenu -->


					
										<!-- список новостей -->
										<div style="clear:both"></div>
										<div class="news-list dinamic">

										

											<?php 

																						
											$args = array(
												'numberposts' => 0,
												'category_name' => $post_name,
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

											//printArray($posts);

											add_filter('excerpt_more', function($more) 
												{	return '...'; });

											$i = 1;
											foreach($posts as $post)
											{ 
												setup_postdata($post);


											    ?>
											    <div class="news_item_2 <? if(($i%2)==1) echo 'even'?> ">
													<div class="news_item_2_img">
														<?php
														if ( has_post_thumbnail()) 
														{
															?>
															<a class="" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(270, 270), array("class"=>"alignleft post_thumbnail"));?><span></span></a>
															<?php
														}
														?> 
													</div>
													<a class="" href="<?php the_permalink(); ?>">
														<div class="news_item_2_text">															
															<?php the_date('d.m.Y', '<span class="news_item_date">', '</span>'); ?>
															<span class="news_item_2_title"><?php the_title(); ?></span>
															<br>
															<?php the_excerpt() ?>
														</div>
													</a>
												</div>

												
												<?php
												$i++;	
												//if($i > 9) $i = 1;
											}



											wp_reset_postdata(); // сброс
											?>
										</div>

										<!-- /список новостей -->

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