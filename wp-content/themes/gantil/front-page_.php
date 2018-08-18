<?php
/*
Template Name: Главная страница длинная
*/

get_header(); 
?>


			<!-- content -->
			<?php
			//$post = get_post();			
			?>

			<div class="container-fluid full-width">
				<div class="row-fluid">
					
					<!-- slider PROMO -->
					<?
					if(get_option('g_options')['on_main_promo']) :					
						get_template_part('inc/block-slider-promo');
					endif;
					?>
					<!-- /slider PROMO -->


					<!-- slider SERTIF -->
					<? 
					if(get_option('g_options')['on_main_sertif']) :
						get_template_part('inc/slider-sertif');
					endif;
					?>
					<!-- /slider SERTIF -->
				</div>
			</div>


			<!-- grid NEWS -->
			<?
			if(get_option('g_options')['on_main_news']) :					
			  get_template_part('inc/grid-news');
			endif;
			?>		
			<!-- /grid NEWS -->

			<!-- grid SERVICE -->
			<?php 
			if(get_option('g_options')['on_main_service']) :
				get_template_part('inc/grid-service');
			endif;
			?>	
			<!-- /grid SERVICE -->

			

			<!-- block IMAGE -->
				<?php /*get_template_part('inc/block-image');*/?>
			<!-- /block IMAGE -->

			<!-- Our salons -->
			<?php 
			if(get_option('g_options')['on_main_salons']) :
				get_template_part('inc/grid-salons');
			endif;
			?>
			<!-- /Our salons -->

			<!-- grid gallery -->
			<?php 
			if(get_option('g_options')['on_main_gallery']) :
				get_template_part('inc/grid-gallery');
			endif;
			?>
			<!-- /grid gallery -->

			<!-- block Call us -->
			<?php 
			if(get_option('g_options')['on_main_callus']) :
				get_template_part('inc/block-callus');
			endif;
			?>
			<!-- /block Call us -->

			<!-- block partners -->
				<?php /*get_template_part('inc/block-partners');*/?>
			<!-- /block partners -->

			
			



<?php
get_footer()
?>