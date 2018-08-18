<?php
/*
Template Name: Главная страница v.3.2
*/

get_header(); 
?>
<style type="text/css">
	.grid-promo-item{/*margin-bottom:30px;*/ }
	.grid-promo-item div{position: relative;}
        /* .grid-promo-item span{position: absolute; bottom: 0; color:#fff; text-align: center; width: 100%; background: rgba(96, 96, 96, 0.64);  display: block;padding: 10px} */
    .grid-promo-item span{
        /*position: absolute;*/
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
        .banner-align-left{padding-left:0}
        .banner-align-right{padding-right:0}
        .main-promo-text{font-size: 1.3em; padding:10px 0}
    .service-icons{padding:0}
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
						<h1><?= the_title()?></h1></div>

			<div class="container-fluid" style="margin-top:60px;">
				<div class="row-fluid">
					
					<div class="col-md-6 col-sm-6 col-xs-12 banner-align-left"><a href="/"><img src="/wp-content/themes/gantil/img/banner1-2.jpg" ></a></div>

                    <div class="col-md-6 col-sm-6 col-xs-12 banner-align-right">
                        <div class="row-fluid">
                            <div class="col-md-12  col-sm-12 col-xs-12 service-icons">
                                <div class="row-fluid">

                                    <div class="col-xs-4  grid-promo-item"><a href="/"><img src="/wp-content/themes/gantil/img/banner2-2.jpg"></a></div>

                                    <?php
                                    $i = 0;
                                    foreach($arr as $k) {
                                        ?>
                                        <div class="col-xs-4 grid-promo-item" >
                                            <div>
                                                <a href="<?=$k[1]?>">
                                                    <img  src="<?=$k[2]?>" alt="">
                                                </a>
                                                <span><?=$k[0]?></span>
                                            </div>
                                        </div>
                                        <?php
                                        if ($i == 1) {
                                            //echo '<div style="clear:both"></div>';
                                        }
                                        $i++;
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>


<!--					<div class="col-md-4  col-sm-4 col-xs-12  banner-align-right"><a href="/"><img src="/wp-content/themes/gantil/img/banner2.jpg"></a></div>
-->                    <div style="clear: both"></div>
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