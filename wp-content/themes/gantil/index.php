<?php
/*
Template Name: Главная страница
*/

get_header(); 
?>

	

						<!-- content -->
						<div class="row-fluid" >
							<div class="container-fluid content content-index"  >
							
								
								<div class="content-text">

									<?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>
								   		<h1><?php the_title();?></h1>									
								
										<?php the_content();?>
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
	