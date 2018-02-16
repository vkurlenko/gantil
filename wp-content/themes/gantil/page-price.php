<?php
/*
Template Name: Цены (плитка салонов)
*/

get_header(); 
?>


						<!-- content -->
						
						<div class="row-fluid">
							<div class="container-fluid content">
								
																
								<!-- breadcrumbs -->
								<?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(' > '); ?>
								<!-- /breadcrumbs -->
	
								<div class="content-article">
									
									
								   		
								   		<h1><?php the_title();?></h1>											

										
										<!-- Our salons -->
										<?php get_template_part('inc/grid-salons');?>
										<!-- /Our salons -->

									
									
								</div>
							</div>
						</div>
						<!-- /content -->
					</div>
					<!-- /left-block -->

	<?php
get_footer()
?>