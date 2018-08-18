<?php
/*
Template Name: Дизайнеры (archive-designers)
*/ 
get_header(); 

require 'controllers/designerController.php';
?>
						<!-- content -->
						<?php
						
						//print_r($post);
						?>
						<div class="row-fluid">
							<div class="container-fluid content">
								
																
								<!-- breadcrumbs -->
								<?php 
								if( function_exists('kama_breadcrumbs') ) 
									kama_breadcrumbs(' > '); 
								?>
								<!-- /breadcrumbs -->
	
								<div class="content-article">
									
										
							   			<h1>Дизайнеры</h1>	
										

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
					
										<!-- social-block -->
										<?php //get_template_part('inc/social/social-block');?>
										<!-- /social-block -->
										
										<div class="grid-designers">													
											<?php

											$designers = new Designer();

											$arr = $designers->getDesigners();
											
											$i = 0;
											foreach( $arr as $k => $v ) {
											?>
												<div class="col-md-3 col-sm-3 col-xs-12" style="text-align:center">
													
													<a href="/designers/<?=$v['url'];?>/" class="des-name" >
														<?php 
														/*if ( $designers->getImage($v['id'])) {
															echo $designers->getImage($v['id']);
														}
														else*/
															echo $v['thumb'];
														?>
														<?php 
														if (user_admin()) {
															echo '<div class="des-rating">'.$v['rating'].'</div>';
														}
														?>														
														<br><?=$v['name'];?></a>
												</div>
												<?php	
												$i++;

												if ($i == 4){
													echo '<div style="clear:both"></div>';
													$i = 0;
												}									

											}											

											?>
										</div>							
									
								</div>
							</div>
						</div>
						<!-- /content -->
					</div>
					<!-- /left-block -->

	<?php
get_footer()
?>