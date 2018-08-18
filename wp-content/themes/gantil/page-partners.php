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
										</ul>
										<div style="clear:both"></div> -->
										<!-- /submenu -->

					
										<div class="content-img-service"><?php the_post_thumbnail();?></div>
										<div>									
											<?php the_content();?>
										</div>

										<!-- <div class="partners">
											<?
											$partners = new WP_Query('cat=131&posts_per_page=-1');
											//printArray($partners);
										
											while($partners -> have_posts())
											{
												$partners -> the_post();
												//the_title();
												
												the_post_thumbnail();
											}
										
											?>
										</div> -->

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