<?php
/*
Template Name: Страница салона (старая)
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
										<ul class="submenu">
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
										<div style="clear:both"></div>
										<!-- /submenu -->


										<div class="row-fluid">

											<!-- адрес -->
											<div class="col-md-6 left0">												
												<p class="salon-address">
												<?
												echo get_post_meta($post->ID, 'salon_address', true);
												?>
												<ul class="salons-item-menu">
													<li class="pr li-call"><a class="grid-block-button ecp-trigger arrow" data-modal="modal" onclick="return false;" href="#">Заказать звонок</a></li>
													<li class="ord fancybox-inline "><a onclick="return false;" class="order-to-salon grid-block-button" data-salon="<?=$post->post_title?>" href="#contact_form_pop_up">Записаться</a></li>
												</ul>
												</p>												
											</div>
											<!-- /адрес -->

											<div style="clear:both"></div>

											<!-- карта -->
											<div class="col-md-6 left0">												
												<div>
												<?
												echo get_post_meta($post->ID, 'salon_map', true);
												?>
												</div>												
											</div>
											<!-- /карта -->

											<!-- картинка -->
											<div class="col-md-6 right0">
												<div style="margin:20px 0">
													<?php the_post_thumbnail(array(445, 445));?>
												</div>
												<?
												//echo do_shortcode(get_post_meta($post->ID, 'salon_gallery_short_code', true));
												?>
											</div>
											<!-- /картинка -->
										</div>
					
										<!-- контент -->
										<div style="clear:both">									
											<?php the_content();?>											 
										</div>
										<!-- /контент -->

										
										<!-- администрация -->
										<div style="clear:both">	
											
											<!-- <h2>Администрация салона</h2> -->

											<div class="inner-menu-wrap">
	                                        <?php

	                                        // выберем мастеров по специальностям и салону, сохраненным в сессии
	                                        $slug = array();
	                                        $arr_adm = array('administrator', 'direktor');

	                                                                          
	                                        /* выберем слаги всех салонов и всех специальностей и сведем их в два отдельных массива */
	                                        $args = array(
	                                            'taxonomy'      => array( ST_Masters::CATEGORY_TAXONOMY_SLUG ), 
	                                            'orderby'       => 'menu_order', 
	                                            'order'         => 'ASC',
	                                            'hide_empty'    => true, 
	                                            'object_ids'    => null, // 
	                                            'include'       => array(), // выборка только Администраторов и Директоров
	                                            'exclude'       => array(), 
	                                            'exclude_tree'  => array(), 
	                                            'number'        => '', 
	                                            'fields'        => 'all', 
	                                            'count'         => false,
	                                            'slug'          => $slug, // здесь выбранный салон и специальность 
	                                            'parent'        => '',
	                                            'hierarchical'  => true, 
	                                            'child_of'      => 0, 
	                                            'get'           => 'all', // ставим all чтобы получить все термины
	                                            'name__like'    => '',
	                                            'pad_counts'    => false, 
	                                            'offset'        => '', 
	                                            'search'        => '', 
	                                            'cache_domain'  => 'core',
	                                            'name'          => '', // str/arr поле name для получения термина по нему. C 4.2.
	                                            'childless'     => true, // true не получит (пропустит) термины у которых есть дочерние термины. C 4.2.
	                                            'update_term_meta_cache' => true, // подгружать метаданные в кэш
	                                            'meta_query'    => '',
	                                        ); 

	                                        
	                                        $myterms = get_terms( $args ); 


	                                        $arr = array();                                        

	                                        foreach( $myterms as $term )
	                                        {
	                                            if($term->slug == 'salon' || $term->slug == 'spec') continue;                                              


	                                            //$arr[$term->parent][] = $term->slug;
	                                        }
	                                        
	                                        /* /выберем слаги всех салонов и всех специальностей и сведем их в два отдельных массива */


	                                        /*  
	                                        для каждой комбинации {салон, специальность} выберем мастеров в случайной последовательности и сведем их в отдельные массивы,
	                                        которые склеим в один большой массив 
	                                        */
	                                        $posts = array();                                                                

	                                        foreach($arr[25] as $k)
	                                        {                                            
	                                            if(!in_array($k, $arr_adm))
	                                            	continue;

	                                            $b = array();

	                                            
                                                $v = $post->post_name;

                                                foreach($arr[499] as $r) { 

                                                	$n = array();

	                                                $param = array(
	                                                    'posts_per_page' => 1000,
	                                                    'post_type' => ST_Masters::POST_TYPE,
	                                                    'orderby'   => 'rand',  
	                                                    'order'     => 'DESC' ,
	                                                    'tax_query' => array(
	                                                        'relation' => 'AND',
	                                                        array(
	                                                            'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
	                                                            'field'    => 'slug',
	                                                            'terms'    => $k // специальность 
	                                                        ),
	                                                        array(
	                                                            'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
	                                                            'field'    => 'slug',
	                                                            'terms'    => $v, // салон	                                                            
	                                                        ),
	                                                        array(
	                                                            'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
	                                                            'field'    => 'slug',
	                                                            'terms'    => $r // рейтинг	                                                            
	                                                        )
	                                                    ),    
	                                                );

													$n = get_posts($param);
													// склеиваем массивы 
                                                	$b = array_merge($b, $n);
												}                                                	                                                
                                               
	                                            //shuffle($b);
	                                            $posts = array_merge($posts, $b);
	                                        }                                        
	                                        /* получили массив мастеров */

                                

	                                    
	                                        /* вывод мастеров */        
	                                        $arr_temp = array();
	                                        $i = 1;
	                                        foreach($posts as $pst)
	                                        {
	                                            $cat = get_the_terms( $pst->ID , ST_Masters::CATEGORY_TAXONOMY_SLUG);   

	                                            $s = '';
	                                            $master_spec = $salon_name = $master_color = '';

	                                            foreach($cat as $parent_cat)
	                                            {    
	                                                // специальность
	                                                if($parent_cat->parent == 25)   
	                                                    $master_spec = $parent_cat->name;	   

	                                                // рейтинг
	                                                if($parent_cat->parent == 499)   
	                                                    $master_rating = $parent_cat->name;                                                                                            
	                                            }

	                                            // фото мастера
	                                            $thumbnail = get_the_post_thumbnail( $pst->ID, 'master_thumb', '' );

	                                            
	                                            ?>

	                                            <div class="five-column">
	                                                <div class="our-team ">
	                                                	<?php
	                                                   if(user_admin()) {
	                                                    ?>
	                                                    <div><?=$master_rating?></div>
	                                                    <?php
	                                                   } 
	                                                   ?>
	                                                    <div class="team-member">
	                                                        <!-- <a href="<?php echo get_permalink( $pst->ID )?>"> -->
	                                                            <?=$thumbnail;?>
	                                                        <!-- </a> -->
	                                                    </div> 
	                                                    <h5 class="member-name"><?php echo $pst->post_title?></h5>
	                                                    <p class="member-post"></p>
	                                                    <p class="member-tags"><?=$master_spec?><br><?=$salon_name?></p>
	                                                    
	                                                    <p></p>
	                                                     <div class="speaker-topic-title "> 
	                                                     	<h4>           
		                                                     <?php 
			                                                     if($master_spec == 'Директор')
			                                                     {
			                                                     	?>                                      
			                                                        <li class="fancybox-inline" style="list-style:none"><a style="color:#ffffff" class="director" onclick="return false;" data-salon="<?=$post->post_title?>" data-salonslug="<?=$post->post_name?>" data-person="<?=$pst->post_title?>" href="#contact_form_pop_up_6">Написать письмо</a></li>
			                                                    	<?
			                                                     }
			                                                     else
			                                                     	echo '&nbsp;';
		                                                    ?>
		                                                	</h4>
	        											</div>
	                                                 </div>
	                                             </div>

	                                            <?php  
	                                            $i++;
	                                            if($i > 5)      
	                                            {
	                                                echo '<div class="masters-delimiter"></div>';
	                                                $i = 1;
	                                            } 
	                                        }	                                        

	                                        /* /вывод мастеров */

	                                        ?>
	                                    </div>

																					 
										</div>
										<!-- /администрация -->

										

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

	<?php
get_footer()
?>