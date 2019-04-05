<?php
/*
Template Name: Landing Page
*/

$post = get_post(); //printArray($post); die;

$shortcode = '[contact-form-7 id="25909" title="Запись в салон (LP)"]';

include 'controllers/serviceController.php';
$services = new Service();
$arr_services = $services->getServiceCat([49]); // категории услуг (без имиджконсультирования)

include 'controllers/lpController.php';
$lp = new lpController();
$arr_salons = $lp->getSalons([299, 303]);	// адреса салонов


?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<?php get_template_part('inc/google.analitycs');?>
		<!-- <meta charset="UTF-8"> -->
		<meta http-equiv=Content-Type content="text/html;charset=UTF-8">
		<title>Жантиль - Дом красоты и моды <?php wp_title(); ?></title>
		<!-- <meta name="keywords" content="" />
		<meta name="description" content="" /> -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<?php 
			wp_head();
		?>

		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/plugin/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/reset.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/font.css">
		<link rel="stylesheet" href="/wp-content/themes/gantil/css/lp4.css?v=2.3">
 		<link rel="stylesheet" href="/wp-content/themes/gantil/plugin/FlipClock-master/compiled/flipclock.css">

		<link rel="stylesheet" href="/wp-content/themes/gantil/plugin/font-awesome-4.7.0/css/font-awesome.min.css">

		
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="https://code.jquery.com/jquery.min.js"></script>
		<script src="/wp-content/themes/gantil/plugin/FlipClock-master/compiled/flipclock.js"></script>
	
	</head>
	<body name="top" <?php body_class(); ?>>

	<!-- Yandex.Metrika counter -->
	
	<!-- /Yandex.Metrika counter -->

	<div class="container container-main lp-main">
	
	
		<!-- навигация -->
		<header>
	
			<nav class="navbar navbar-default menu navbar-fixed-top">
			  <div class="container-fluid">
				
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				  <a class="navbar-brand" href="https://gantil.ru" target=_blank><img src="/wp-content/uploads/2017/05/logo-new_bl.png" ></a>
				</div>
	
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				  
				  
				<!-- меню -->
				  <ul class="nav navbar-nav lp-nav" style="float:right">
					<!-- <li><a class="first lp-nav-link" href="#action">акция</a></li> -->
					<!--<li><a class="lp-nav-link" href="#service">услуги</a></li>-->
					<li><a class="lp-nav-link" href="#contacts">контакты</a></li>		        
				  </ul>
				 <!-- /меню -->
				  
				  
				  <!-- ссылка на обратный звонок -->
				  <!-- <ul class="nav navbar-nav navbar-right">
				  					<li class="lp-btn">
				  						<a href="#" class="link">обратный звонок</a>
				  						<a href="#" class="backcall"><span class="glyphicon glyphicon-phone-alt"></span></a>	
				  					</li>	
				  </ul> -->
				  <!-- /ссылка на обратный звонок -->
				  
				  
				</div><!-- /.navbar-collapse -->
			  </div><!-- /.container-fluid -->
			  
			  
			 <!-- <a href="#" class="backcall-top"><span class="glyphicon glyphicon-phone-alt"></span></a>-->
			  
			  
			</nav>
	
		</header>
		<!-- /навигация -->
		<?
		$img_url = get_the_post_thumbnail_url( $post, 'full' );
		?>
		<div class="promo">
			<img class="horiz" src="<?=$img_url?>">
			<img class="vert" src="/wp-content/uploads/2018/10/KOLESTON-PERFECT_vert.jpg">
		</div>		

		
		
		
		<div class="content">
			<div class="container container-card">
			
			
				<!-- Услуги -->	
				<!--<div class="anchor">
					<a name="service"></a>
				</div>		

				<h4>Услуги</h4>
			
				<div class="row">

					<?php
/*                    $i = 0;
                    //printArray($arr_services);
					foreach($arr_services as $service):

                        if($service['id'] == 183)
                            $service['name'] = 'Имидж-консультирование';
					*/?>
                        <div class="col-md-2 col-sm-4 col-xs-6">
                            <div class="card">
                                <a class="card-img" target="_blank" href="<?/*=$service['link']*/?>"><?/*=$service['thumb']*/?></a>
                                <a class="card-href" target="_blank" href="<?/*=$service['link']*/?>"><?/*=$service['name']*/?></a>
                            </div>
                        </div>

                        <?php
/*                        if($i % 2){
                            echo '<div class="delimiter" style="clear: both"></div>';
                        }
                        $i++;
                        */?>

					<?php /*endforeach;
					*/?>
					
				</div>	-->
				<!-- /Услуги -->
				
				
				<!-- Акция -->
				<div class="anchor">
					<a name="action"></a>
				</div>
				
				<!-- <h4>Акция</h4> -->				
				
				<div class="row padding15">
				
					<div class="col-md-8 col-sm-12 padding0">
						
						<div class="special padding15">
							<span class="special-title">Специальное предложение</span>
							<span class="counter-title">До конца акции осталось</span>
							<div class="counter">
								
								<!-- countdown -->

								<?php
									/*$date_to = mktime(date('H'), date('i'), date('s'), date('d'), date('m'), date('Y'));
									echo $date_to.' = '.time();
									echo date()*/
								?>

								
								<div class="clock" style="margin:2em;"></div>
									<div class="message"></div>

									<script type="text/javascript">
										var clock;
										
										$(document).ready(function() {
											var clock;

											clock = $('.clock').FlipClock({
										        clockFace: 'DailyCounter',
										        autoStart: false,
										        callbacks: {
										        	stop: function() {
										        		$('.message').html('Счетчик остановлен!')
										        	}
										        }
										    });

										    <?
										    //$date_start = mktime(0, 0, 0, 3, 9, 2016);
										    $date_start = time();
										    $date_stop = mktime(0, 0, 0, 10, 10, 2018);
											//$date_stop = mktime(0, 0, 0, intval($lp_date_stop[1]), intval($lp_date_stop[2]), intval($lp_date_stop[0]));
											$setTime = $date_stop - $date_start;
											
											
											
											if($setTime < 0)
												$setTime = 0;
										    ?>
												
												//alert(<?=$setTime?>);		    
										    //clock.setTime(86400);
										    clock.setTime(<?=$setTime?>);
										    clock.setCountdown(true);
										    
											<?
											if($setTime > 0)
											{
												?>clock.start();<?
											}
											else
											{
												?>$('.counter-title').text('Акция еще не началась')<?	
											}										
											?>
											

										});
									</script>

								<!-- /countdown -->

							</div>
							<div class="special-text">
								<span class="special-text-title"><!-- Дорогие гости! --></span>	

								<?
								$meta = get_post_meta( $post->ID, 'prev text', true );
								//printArray($meta);
								echo $meta;
								?>	

								
								
								<span class="special-text-ps"></span>
							</div>					
						</div>
						
					</div>
									
					
					

					<div class="col-md-4 col-sm-12 form form1">
					<a name="form"></a>
						<span class="form-title">Запишитесь к нам прямо сейчас</span>
						<span class="form-text">Пожалуйста, заполните контактную информацию. Наш администратор свяжется с вами в ближайшее время.</span>						
						<?
						echo do_shortcode($shortcode);
						?>
					</div>
					<!-- /форма -->
					
										
					<div class="about">
						<!-- <?=the_title();?> 						
						-->
						<?=$post->post_content?>
					</div>
					
				</div>


				<div class="row padding15 row2">
					<div class="col-md-4 form form2">
						<span class="form-title">Запишитесь к нам прямо сейчас</span>
						<span class="form-text">Пожалуйста, заполните контактную информацию. Наш администратор свяжется с вами в ближайшее время.</span>
						<?
						echo do_shortcode($shortcode);
						?>
					</div>

					<div class="col-md-6 col-md-offset-2 why-list">
						<h4>Почему наши клиенты довольны?</h4>

						<ul class="list">
							<li>
								<span class="list-title">Гарантия качества</span>
								<span class="list-text">Мы гарантируем, что вы останетесь довольны результатом нашей работы</span>
							</li>
							<li>
								<span class="list-title">ТОЛЬКО ОПЫТНЫЕ МАСТЕРА</span>
								<span class="list-text">Для нас очень важно, чтобы каждый наш клиент был доволен результатом нашей работы, поэтому у нас работают только опытные мастера.</span>
							</li>
							<li>
								<span class="list-title">ПЕРСОНАЛЬНЫЙ ПОДХОД</span>
								<span class="list-text">Наши специалисты всегда готовы порекомендовать то, что подойдёт именно вам</span>
							</li>
							<li>
								<span class="list-title">УДОБНОЕ МЕСТОПОЛОЖЕНИЕ</span>
								<span class="list-text">До нас легко добраться как на общественном транспорте, так и на автомобиле. Перед каждым из наших салонов есть возможность парковаться.</span>
							</li>
						</ul>
					</div>
				</div>

				<div style="text-align: center">
                    <img class="horiz" src="/wp-content/themes/gantil/img/lp/shema.gif">
                    <img class="vert" src="/wp-content/themes/gantil/img/lp/shema_vert_2.gif">
                </div>
				<!-- /Акция -->



				<!-- Контакты -->
				<div class="contacts">
					<div class="anchor">
						<a name="contacts"></a>
					</div>

					<h4>Контакты</h4>	
					<ul>
						<?php
						foreach ($arr_salons as $k => $v) {
							?><li><?=$v['salon_name'].' - '.$v['salon_addr']?></li><?php
						}
						?>
					</ul>

					<div class="gantil-map">
						<a name="map"></a>
						<div class="map">
							<!--<script type="text/javascript" charset="utf-8" src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=pPlCZpxo2w_0NHxME5elMNwItucLAayl&width=&height=480&lang=ru_RU&sourceType=constructor"></script>-->
							<!--<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3ApPlCZpxo2w_0NHxME5elMNwItucLAayl&amp;width=100%25&amp;height=480&amp;lang=ru_RU&amp;scroll=false"></script>-->
							<iframe src="https://www.google.com/maps/d/embed?mid=1w49Ir8qC7ll0FyhM4--7JfOJYxj4T92i&hl=ru" width="100%" height="480"></iframe>
						</div>						
					</div>
				</div>
				<!-- /Контакты -->




				<!-- График -->
				<div class="gr">
					<h4>График работы</h4>	
					<span>Ждем вас в наших салонах</span>

					<div class="conteiner gr-div clearfix">
						<div>
							<div><img src="/wp-content/themes/gantil/img/lp/1.png"><span>10-22</span></div>
							<div><img src="/wp-content/themes/gantil/img/lp/2.png"><span>10-22</span></div>
							<div><img src="/wp-content/themes/gantil/img/lp/3.png"><span>10-22</span></div>
							<div><img src="/wp-content/themes/gantil/img/lp/4.png"><span>10-22</span></div>
							<div><img src="/wp-content/themes/gantil/img/lp/5.png"><span>10-22</span></div>
							<div><img src="/wp-content/themes/gantil/img/lp/6.png"><span>10-22</span></div>
							<div><img src="/wp-content/themes/gantil/img/lp/7.png"><span>10-22</span></div>
						</div>
					</div>
				</div>	
				<!-- /График -->




				<!-- Форма обратной связи в футере -->
				<div class="form form3 form-foot-2 clearfix">
					<span class="form-title">Запишитесь к нам прямо сейчас</span>
					<span class="form-text">Пожалуйста, заполните контактную информацию. Наш администратор свяжется с вами в ближайшее время.</span>					
					<?
					echo do_shortcode($shortcode);
					?>	
				</div>
				<!-- /Форма обратной связи в футере -->


				<div class="footer">
					<span>Присоединяйтесь к нам в социальных сетях:</span>
					<ul class="social clearfix">
						<li><a href="<?=get_option('g_options')['social_vk']?>" target="_blank">Вконтакте</a></li>
						<li><a href="<?=get_option('g_options')['social_ok']?>" target="_blank">Одноклассники</a></li>
						<li><a href="<?=get_option('g_options')['social_fb']?>" target="_blank">Facebook</a></li>
						<li><a href="<?=get_option('g_options')['social_tw']?>" target="_blank">Twitter</a></li>
						<li><a href="<?=get_option('g_options')['social_yt']?>" target="_blank">YouTube</a></li>
						<li><a href="<?=get_option('g_options')['social_in']?>" target="_blank">Instagram</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>	
	

<?php wp_footer(); ?>

<script src="<?php echo get_template_directory_uri(); ?>/plugin/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/plugin/bootstrap/js/validator.js"></script>
	<script type="text/javascript" src="https://malsup.github.io/min/jquery.form.min.js"></script>
	<script src="/wp-content/themes/gantil/js/mask.js"></script>
	<script src="/wp-content/themes/gantil/js/script.js"></script>
	<script>	
		var maskOptions = {
		  mask: '+{7}(000)000-00-00'
		};

		var x = document.getElementsByName("tel-698");
		var i;
		for (i = 0; i < x.length; i++) {
				var mask = new IMask(x[i], maskOptions);
		}

	</script>
</body>
</html>
	
