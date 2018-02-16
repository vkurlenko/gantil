				
					<style>
					.slider-sertif{display: none;}
					.slick-prev:before, .slick-next:before { font-family: 'slick'; font-size: 20px; line-height: 1; opacity: .75; color: #000; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale;}
					.slick-prev-my{background:url(/wp-content/themes/gantil/plugin/slick/prev.png);}
					</style>
					
					

					<div class="col-md-12 col-sm-12">

						<div class="row-fluid">
							<div class="container-fluid content content-index ">
								
								<div class="slider-sertif">
									
									<?php
						            $args = array( 'post_type' => 'sertif', 'orderby' => 'menu_order', 'order' => 'ASC' );
						            $query = new WP_Query( $args );
						            while( $query->have_posts() ) {
						                $query->the_post();
						                /*get_template_part( 'template-parts/content', 'taxnews' );*/
						                ?>
						                <div class="sertif-item">
											<a href="<?php the_permalink(); ?>"><? the_post_thumbnail( 'sertif_thumb', array('class' => 'sertif-item-img') )?> <!-- <img class="sertif-item-img" src="/wp-content/uploads/2017/08/sertif1.jpg"> --></a>
											<div class="sertif-item-name"><?php the_title(); ?></div>
											<div class="sertif-item-btn"><a href="<?php the_permalink(); ?>">купить</a></div>
										</div>
										
						                <?
						            } wp_reset_postdata();
						        ?>									

								</div>

								
							</div>
						</div>
						<!-- /content -->
					</div>
					
					<script type="text/javascript">
					$(document).ready(function(){

						make_sertif_slick();	
									  
					});
					</script>