<!DOCTYPE html>
<html lang="ru">
	<head>
		<?php get_template_part('inc/google.analitycs');?>
        <?php get_template_part('inc/social/fb-pixel');?>
		<!-- <meta charset="UTF-8"> -->
		<meta http-equiv=Content-Type content="text/html;charset=UTF-8">
		<title>Жантиль - Дом красоты и моды <?php wp_title(); ?></title>
		<!-- <meta name="keywords" content="" />
		<meta name="description" content="" /> -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">


		<!-- HEAD -->
		<?php 
			wp_head();
		?>
		<!-- /HEAD -->

		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/plugin/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/reset.css">
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css?v=5.30">
        <!--<link rel="stylesheet" href="<?php /*echo get_template_directory_uri(); */?>/css/call_button.css?v=1">-->
		
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<script src="https://code.jquery.com/jquery.min.js"></script>
	
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

