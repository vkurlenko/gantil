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

						$cats = get_the_category( $post->ID );

						//printArray($cats);

						
						$is_action = false;
						$in_salons = [];

						foreach($cats as $cat){
							if($cat->slug == 'actions')
								$is_action = true;

							// склеим в строку массив салонов, в которых проходит акция
							// эту строку передадим в script.js, где будет формироваться select выбора салонов

							$salons_category_id = 431; // id категории Салоны

							if($cat->category_parent == $salons_category_id){								
								$string = explode(' ', $cat->name);
								$s = $string[count($string) - 1];
								$salons[] = mb_substr($s, 2, 4);
								$st = implode('|', $salons);

								$in_salons[] = $cat->name;
							}
						};

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

										<?php
										if($is_action):
										
											$content = str_replace(array('</li>'), '</li><br>', $post->post_content);		
											$content = strip_tags($content, '<br>');
											$content = str_replace(array('<br>'), '\n', $content);		

											$url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; 

											if(!empty($in_salons)){
												$html = '<div style="clear:both"><strong>Акция действует в салонах:</strong>'.'<ul>';
												foreach($in_salons as $salon){
													$html .= '<li>'.$salon.'</li>';
												}
												$html .= '</ul></div>' ;

												echo $html;
											}
											

											?>											

											<div class="button form7">
												<ul>
													<li class="fancybox-inline" style="list-style:none">
														<a data-actiontitle="<?php the_title();?>" data-actioncontent="<?= $content;?>" data-url="<?=$url;?>" data-salons="<?=$st?>" href="#contact_form_pop_up_7" onclick="return false;"><button class="master-button">Заказать по условиям акции</button></a>
													</li>
												</ul>
											</div>	

										<?php
										endif;
										?>						
									

									
								</div>
							</div>
						</div>
						<!-- /content -->

						

			
					</div>
					<!-- /left-block -->

	<?php
get_footer()
?>