<?php
/*
Template Name: Контакты
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

										<?php
										/*if(user_admin()){
											?>
											<a href="tel:+74994310415" onclick="setStat('salon_sokol'); return false;">test</a>
											<?
										}*/
										?>

	                                    
										<!-- адреса -->
										<div class="contacts-content-tab1 contacts-address">
											<?php the_content();?>
										</div>
										<!-- /адреса -->

										<script language="javascript">
											
											function setStat(s){

												var tel = '';
												$('.contacts li a').each(function(){
													if($(this).attr('data-salon') == s)
														tel = $(this).attr('href');
												});

												var data = {
                                                    action      : 'callstatistic',
                                                    salon       : s,
                                                    referrer    : document.referrer
                                                };

												$.ajax({
													type: "POST",
													url: "/wp-admin/admin-ajax.php",
													data: data, //"action=callstatistic&salon="+salon+"&referrer=jhjh",
													complete: function(msg){
														//alert( "Прибыли данные: " + msg );
														window.location.replace(tel);
													}
												});												
												
                                            }
										</script>

										

										<!-- карта -->
										
										<div class="contacts-content-tab2">
											<script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=pPlCZpxo2w_0NHxME5elMNwItucLAayl&width=&height=400&lang=ru_RU&sourceType=constructor"></script>
										</div>
										
										
										<!-- /карта -->

										<script language="javascript">

										

										$(document).ready(function()
										{

										    $('.contacts li a').click(function(e){
                                                setStat($(this).attr('data-salon'))
                                            })

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

											$('.contacts li a').prepend('<i class="fa fa-phone" aria-hidden="true"></i>');

											/* запись в БД данных о звонке в салон с мобильного */
                                            /*$('.contacts li a').on("click", function (e){   

                                            	//e.preventDefault;                                         	

                                                var data = {
                                                    action      : 'callstatistic',
                                                    salon       : $(this).attr('data-salon'),
                                                    referrer    : document.referrer
                                                };

                                                // сделаем AJAX запрос на запись в БД 
                                                jQuery.post('/wp-admin/admin-ajax.php', data, function(response){                                                    
                                                })

                                            })*/

                                            /*$('.test1').on("click", function (e){

                                                var data = {
                                                    action      : 'callstatistic',
                                                    salon       : $(this).attr('data-salon'),
                                                    referrer    : document.referrer
                                                };*/

                                                // сделаем AJAX запрос на запись в БД 
                                               /* jQuery.get('/wp-admin/admin-ajax.php', data, function(response){                                                    
                                                })*/

	                                            /*$.ajax({
														type: "POST",
														url: "/wp-admin/admin-ajax.php",
														data: "action=callstatistic&salon="+$(this).attr('data-salon')+"&referrer="+document.referrer,
														success: function(msg){
															alert( "Прибыли данные: " + msg );
														}
												});

	                                        })*/

												/*return false;
											}
                                            /* /запись в БД данных о звонке в салон с мобильного */
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