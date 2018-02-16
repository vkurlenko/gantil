<?php
/*
Template Name: Страница
*/

get_header(); 
?>


						<!-- content -->
						<?php
						$post = get_post();
						setup_postdata($post);
						
						//print_r($post);
						?>
						<div class="row-fluid">
							<div class="container-fluid content">
								
								
								<!-- breadcrumbs -->
								<?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(' > '); ?>
								<!-- /breadcrumbs -->


	
								<div class="content-article">
									

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

										<div style="clear:both"></div>

										<h1><?php the_title();?></h1>	

										<!-- social-block -->
										<?php get_template_part('inc/social/social-block');?>
										<!-- /social-block -->

										<?php the_content();?>


									
									

									
								</div>
							</div>
						</div>
						<!-- /content -->

						

			
					</div>
					<!-- /left-block -->

	<?php
get_footer()
?>