<?php
/*
Template Name: Главная страница v.2
*/

get_header(); 
?>
<style type="text/css">
	.grid-promo-item{margin-bottom:30px; }
	.grid-promo-item div{position: relative;}
	/* .grid-promo-item span{position: absolute; bottom: 0; color:#fff; text-align: center; width: 100%; background: rgba(96, 96, 96, 0.64);  display: block;padding: 10px} */
	.grid-promo-item span{position: absolute;
    bottom: -35px;
    color: #333;
    text-align: center;
    width: 100%;
    /* background: rgba(96, 96, 96, 0.64); */
    display: block;
    padding: 10px;
    text-transform: uppercase;
}
</style>

			<!-- content -->
			<?php
			//$post = get_post();	

			/*global $wp_scripts;
printArray( $wp_scripts );*/

			$arr = [
					['Парикмахерские услуги', '', '/wp-content/uploads/2017/06/424-460x391-mono.jpg'],
					['Ногтевой сервис' , '', '/wp-content/uploads/2017/06/2167-460x391-mono.jpg'],
					['Косметология' , '', '/wp-content/uploads/2017/06/421-460x391-mono.jpg'],
					['Тайский и балийский массаж' , '', '/wp-content/uploads/2017/06/439-460x391-mono.jpg']
				];

			/*$arr = [
					['Парикмахерские услуги', '', '/wp-content/themes/gantil/img/icon/m1.jpg'],
					['Ногтевой сервис' , '', '/wp-content/themes/gantil/img/icon/m3.jpg', ],
					['Косметология' , '', '/wp-content/themes/gantil/img/icon/m2.jpg'],
					['Тайский и балийский массаж' , '', '/wp-content/themes/gantil/img/icon/m4.jpg']
				];*/
			?>
	
			<div style="text-align:center">
						<h1>Жантиль - мой любимый салон красоты в Москве</h1></div>

			<div class="container-fluid" style="margin-top:60px">
				<div class="row-fluid">
					
					<div class="col-md-8"><?php /*echo do_shortcode('[masterslider id="20"]');*/ echo do_shortcode('[masterslider id="21"]'); ?></div>
					<div class="col-md-4">
						<div class="row-fluid">
							<?php
							$i = 0;
							foreach($arr as $k) {
								?>
								<div class="col-xs-6 grid-promo-item" >
									<div>
										<a href="<?=$k[1]?>">
											<img  src="<?=$k[2]?>" alt="">
										</a>
										<span><?=$k[0]?></span>
									</div>
								</div>
								<?php
							}
							?>
						</div>

					</div>
					
				</div>

				<div>Значимость этих проблем настолько очевидна, что реализация намеченных плановых заданий в значительной степени обуславливает создание позиций, занимаемых участниками в отношении поставленных задач. Идейные соображения высшего порядка, а также дальнейшее развитие различных форм деятельности позволяет оценить значение форм развития. Таким образом рамки и место обучения кадров играет важную роль в формировании направлений прогрессивного развития. Разнообразный и богатый опыт укрепление и развитие структуры играет важную роль в формировании модели развития. Равным образом укрепление и развитие структуры в значительной степени обуславливает создание существенных финансовых и административных условий.</div>

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