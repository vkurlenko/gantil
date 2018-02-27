<?php
/*
Template Name: Вакансии
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
										      	'echo' => false
										    ) 
										); 

										echo $arr_menu;
										
										?>
										</ul>
										<div style="clear:both"></div>
										<!-- /submenu -->


										<!-- <div class="container-fluid"> -->
											<div class="row-fluid">												

												<div class="col-md-6 col-sm-12 col-xs-12">

													<?php echo do_shortcode('[contact-form-7 id="21458" title="Форма отправки резюме"]'); ?>
													
													<script src="/wp-content/themes/gantil/plugin/jquery_chained-1.0.1/jquery.chained.js"></script>

													<?php
													// параметры по умолчанию
														$args = array(
															'numberposts' => 0,
															'category'    => 0,
															'orderby'     => 'date',
															'order'       => 'DESC',
															'include'     => array(),
															'exclude'     => array(),
															'meta_key'    => '',
															'meta_value'  =>'',
															'post_type'   => 'vacancy',
															'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
														);

														$arr_vacancy = array();

														$posts = get_posts( $args );

														//printArray($posts);

														foreach($posts as $post) { 

															setup_postdata($post);
														    
														   
														    $arr = get_the_category( $post->ID );
													   

														    foreach($arr as $k) {
														    	$arr_vacancy[$post->post_title][] = array($k->slug, $k->name);
														    }
														}


														wp_reset_postdata(); 

														//printArray($arr_vacancy);

														

														echo '<select class="vacancy_spec_replace">
														<option value="">---</option>';
														foreach($arr_vacancy as $k => $v) {
															echo '<option value="'.$k.'">'.$k.'</option>';
														}
														echo '</select>';

														echo '<select class="vacancy_salon_replace">
														<option value="">---</option>';
														foreach($arr_vacancy as $k => $v) {
															foreach($v as $k1 => $v1){
																echo '<option value="'.$v1[1].'" class="'.$k.'">'.$v1[1].'</option>';
															}
														}
														echo '</select>';


													?>
													<script type="text/javascript">
													$(document).ready(function()
													{
														var spec = $('.vacancy_spec_replace').html();
														var salon = $('.vacancy_salon_replace').html();
														
														$('#vacancy-spec').html(spec);
														$('#vacancy-salon').html(salon);

														$("#vacancy-salon").chained("#vacancy-spec");
													})
													</script>

													<style>
													.vacancy_spec_replace, .vacancy_salon_replace{display: none;}
													</style>

												</div>

												<div class="col-md-6 col-sm-6 col-xs-12">
													<!-- social-block -->
													<?php get_template_part('inc/social/social-block');?>
													<!-- /social-block -->
													<div class="content-img-service"><?php the_post_thumbnail();?></div>
													<div>									
														<?php the_content();?>
														
													</div>
												</div>
											</div>

										<!-- </div> -->


										

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