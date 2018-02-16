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
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/font.css">

		<!-- <script src="https://use.fontawesome.com/88eba596a5.js"></script> -->
		<link rel="stylesheet" href="/wp-content/themes/gantil/plugin/font-awesome-4.7.0/css/font-awesome.min.css">

		<link rel="stylesheet" type="text/css" href="/wp-content/themes/gantil/plugin/slick/slick.css"/>					
		<link rel="stylesheet" type="text/css" href="/wp-content/themes/gantil/plugin/slick/slick-theme.css"/>
		
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="http://code.jquery.com/jquery.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/plugin/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/plugin/bootstrap/js/validator.js"></script>
		<script type="text/javascript" src="http://malsup.github.io/min/jquery.form.min.js"></script>
		

		

		<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>					
		<script type="text/javascript" src="/wp-content/themes/gantil/plugin/slick/slick.min.js"></script>
		<script type="text/javascript" src="/wp-content/themes/gantil/js/script.js"></script>
	
		<?php get_template_part('inc/social/vk');?>
	</head>
	<body name="top" <?php body_class(); ?>>
		
		<?php get_template_part('inc/ya.metrica');?>
		<?php get_template_part('inc/social/fb');?>

		<a  id="top"></a>

		<!-- main menu fixed -->
		<div class="container-fluid clone clone-hide" id="fix">
			<div class="row-fluid">
				
				<!-- left-block -->
				<div class="col-md-12 col-sm-12 right0 left0">
					

					<!-- header -->
					<div class="row-fluid" >
						<div class="container-fluid top">
							<div class="row-fluid">

								<!-- logo -->
								<?php get_template_part('inc/logo-block');?>
								<!-- /logo -->

								<!-- main-menu -->

								<?php get_template_part('inc/main-menu');?>
								
								<!-- /main-menu -->
							</div>
							
						</div>
					</div>
					<!-- /header -->
				</div>
			</div>
		</div>
		<!-- /main menu fixed -->
	

		<div id="main">
