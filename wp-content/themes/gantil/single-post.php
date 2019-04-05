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

						/* для АКЦИИ или НОВОСТИ с меткой 'акция' покажем форму заказа по условиям акции */
						$is_action = false;

						$tags = get_the_terms( $post->ID, 'post_tag');

						if(!empty( $tags )){
						    foreach( $tags as $tag ){
						        if( $tag->slug == 'akciya')
                                    $is_action = true;
                            }
                        }
                        /* /для АКЦИИ или НОВОСТИ с меткой 'акция' покажем форму заказа по условиям акции */

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

                                        /* форма заказа по условиям акции */

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

											<!--<div class="button form7">
												<ul>
													<li class="fancybox-inline" style="list-style:none; text-align:center">
														<a data-actiontitle="<?php /*the_title();*/?>" data-actioncontent="<?/*= $content;*/?>" data-url="<?/*=$url;*/?>" data-salons="<?/*=$st*/?>" href="#contact_form_pop_up_7" onclick="return false;">
                                                            <button class="master-button">Заказать по условиям акции</button>
                                                        </a>
													</li>
												</ul>
											</div>-->


										<?php
										endif;

                                        /* /форма заказа по условиям акции */

										?>						
									

									
								</div>
							</div>
						</div>
                            <!-- Callback animated icon -->
                            <div id="callback-expecto" style="display: block;">
                                <div class="callback-btn form7">
                                    <div class="callback-btn-overlay step1 blink1">
                                        <svg height="152" width="152" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 152 152">
                                            <path fill="#ff3300" opacity="0.2" fill-rule="evenodd" d="M 76 151.9 C 117.92 151.9 151.9 117.92 151.9 76 C 151.9 34.08 117.92 0.1 76 0.1 C 34.08 0.1 0.1 34.08 0.1 76 C 0.1 117.92 34.08 151.9 76 151.9 Z M 76 151.9"></path>
                                        </svg>
                                    </div>

                                    <li class="fancybox-inline" style="list-style:none; text-align:center">
                                        <a data-actiontitle="<?php the_title();?>" data-actioncontent="<?= $content;?>" data-url="<?=$url;?>" data-salons="<?=$st?>" href="#contact_form_pop_up_7" onclick="return false;">
                                            <div class="callback-btn-overlay callback-ico tada">
                                                <svg height="75" width="75" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 81 81">
                                                    <path stroke-linejoin="miter" stroke-linecap="butt" stroke-width="5" stroke="#ffffff" fill="#ff3300" fill-rule="evenodd" d="M 40.5 78 C 61.21 78 78 61.21 78 40.5 C 78 19.79 61.21 3 40.5 3 C 19.79 3 3 19.79 3 40.5 C 3 61.21 19.79 78 40.5 78 Z M 40.5 78"></path>
                                                    <path fill="#ffffff" fill-rule="evenodd" d="M 53.81 54.12 L 51.62 56.3 C 51.23 56.69 50.09 56.94 50.05 56.94 C 43.13 56.99 36.46 54.28 31.56 49.39 C 26.65 44.49 23.93 37.81 24 30.87 C 24 30.87 24.25 29.76 24.64 29.38 L 26.83 27.19 C 27.63 26.39 29.17 26.03 30.25 26.39 L 30.71 26.54 C 31.78 26.9 32.91 28.08 33.21 29.18 L 34.31 33.21 C 34.61 34.3 34.21 35.86 33.4 36.66 L 31.94 38.12 C 33.38 43.42 37.54 47.58 42.86 49.02 L 44.32 47.56 C 45.12 46.76 46.68 46.36 47.78 46.65 L 51.82 47.76 C 52.91 48.05 54.1 49.17 54.46 50.25 L 54.61 50.71 C 54.97 51.79 54.61 53.32 53.81 54.12 L 53.81 54.12 Z M 42.56 40.47 L 44.62 40.47 C 44.62 38.19 42.78 36.35 40.5 36.35 L 40.5 38.41 C 41.64 38.41 42.56 39.33 42.56 40.47 L 42.56 40.47 Z M 50.81 40.47 C 50.81 34.78 46.2 30.18 40.5 30.18 L 40.5 32.23 C 45.05 32.23 48.75 35.93 48.75 40.47 L 50.81 40.47 L 50.81 40.47 Z M 40.5 24 L 40.5 26.06 C 48.46 26.06 54.94 32.52 54.94 40.47 L 57 40.47 C 57 31.37 49.61 24 40.5 24 L 40.5 24 Z M 40.5 24"></path>
                                                </svg>
                                            </div>
                                        </a>
                                    </li>
                                </div>
                            </div>

                        <?php
                        $src = get_template_directory_uri().'/css/call_button.css?v=1';
                        wp_enqueue_style( 'call', $src );
                        ?>
                            <!-- /Callback animated icon -->
						<!-- /content -->

						

			
					</div>
					<!-- /left-block -->
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget_action') ) : ?>
<?php endif; ?>
	<?php
get_footer()
?>