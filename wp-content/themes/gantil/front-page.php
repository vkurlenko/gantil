<?php
/*
Template Name: Главная страница v.3.1
*/

get_header();
?>

			<!-- content -->

			<div style="text-align:center">
				<h1><?= the_title()?></h1>
			</div>

			<div class="container-fluid" style="margin-top:10px;">
				<div class="row-fluid">

					<div class="col-md-4 col-sm-4 col-xs-12 banner-align-left">
						<a href="/product-category/service/imidzhkonsultirovanie/">
							<?php
							$src = '/wp-content/themes/gantil/img/banner4.jpg';
							?>
							<img class="grid-item-img img-mono" src="/wp-content/themes/gantil/img/banner4-mono2.jpg" data-imgcolor="/wp-content/themes/gantil/img/banner4.jpg" >
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
							<img class="grid-item-img img-mono" src="/wp-content/themes/gantil/img/banner-sertif-mono.jpg" width="560" data-imgcolor="/wp-content/themes/gantil/img/banner-sertif-color.jpg">
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

<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget_salon') ) : ?>
<?php endif; ?>

<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget_subscribe') ) : ?>
<?php endif; ?>


<?php
get_footer()
?>