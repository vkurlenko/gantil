<?php
/*
Template Name: Главная страница v.3.1
*/

get_header(); 
?>
<style type="text/css">
	.grid-promo-item{/*margin-bottom:30px;*/ padding:0 5px }
	.grid-promo-item div{position: relative;}
        /* .grid-promo-item span{position: absolute; bottom: 0; color:#fff; text-align: center; width: 100%; background: rgba(96, 96, 96, 0.64);  display: block;padding: 10px} */
    .grid-promo-item span{
        /*position: absolute;*/
        /* font-family:'Roboto Condensed Bold'; */
        bottom: 0;
        color: #333;
        text-align: center;
        width: 100%;
        font-weight: bold;
        /* background: rgba(96, 96, 96, 0.64); */
        display: block;
        padding: 5px 0;
        text-transform: uppercase;
    }
        .banner-align-left{padding-left:0; text-align: left}
        .banner-align-right{padding-right:0; text-align: right}
        .banner-align-left a, .banner-align-right a{display: block; position: relative;}
        .main-promo-text{font-size: 1.3em; padding:10px 0}
    	.service-icons{padding:0}
</style>

			<!-- content -->			
	
			<div style="text-align:center">
				<h1><?= the_title()?></h1>
			</div>

			<div class="container-fluid" style="margin-top:60px;">
				<div class="row-fluid">
					
					<div class="col-md-4 col-sm-4 col-xs-12 banner-align-left">
						<a href="/product-category/service/imidzhkonsultirovanie/">
							<?php
							$src = '/wp-content/themes/gantil/img/banner4.jpg';
							?>
							<img class="img-mono" src="/wp-content/themes/gantil/img/banner4-mono2.jpg" >
							<img class="img-color" src="/wp-content/themes/gantil/img/banner4.jpg"  >
							<!-- <img src="/wp-content/uploads/2018/05/banner-new-2.jpg" width="560"> -->
						</a>
					</div>

					<div class="col-md-4  col-sm-4 col-xs-12 service-icons">
						<div class="row-fluid">
							<?php
							get_template_part('inc/grid-service-on-top');							
							?>
						</div>
					</div>

					<div class="col-md-4  col-sm-4 col-xs-12  banner-align-right">
						<a href="/product-category/sertifikaty/">
							<img class="img-mono" src="/wp-content/themes/gantil/img/banner-sertif-mono.jpg" width="560">
							<img class="img-color" src="/wp-content/themes/gantil/img/banner-sertif-color.jpg" width="560">
						</a>
					</div>

                    <div style="clear: both"></div>
				</div>

				<div class="main-promo-text"><?= the_content();?></div>

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


            <!-- grid SERVICE -->
            <?php
            if(get_option('g_options')['on_main_designers']) :
                get_template_part('inc/grid-designers');
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