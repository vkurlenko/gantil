<?php
/*
Template Name: Страница описания услуги
*/

get_header(); 
?>


						<!-- content -->
						<?php
						$post = get_post();
						
						//print_r($post);
						?>
						<div class="row-fluid">
							<div class="container-fluid content">
								
								<ol class="breadcrumb">
									<li><a href="#">Главная</a></li>
									<li><a href="#">САЛОНЫ</a></li>
									<li><a href="#">САЛОН НА КОЛОМЕНСКОЙ</a></li>
									<li><a href="#">УСЛУГИ</a></li>
									<li><a href="#">НОГТЕВОЙ СЕРВИС</a></li>
									<li><a href="#">ПЕДИКЮР</a></li>
									<li class="active">ПОКРЫТИЕ "ФРЕНЧ"</li>
								</ol>
								<div class="content-article">
									
									<h1>Покрытие "френч"</h1>
									<div class="content-img-service"><img src="/wp-content/uploads/2017/04/343.jpg"></div>
									
									<div class="container-fluid lr0">
										<div class="row-fluid">
											<div class="col-md-9 col-sm-7 col-xs-12 left0">
												<div>												
												

												<?php
												echo $post -> post_content;
												?>
											</div>

												<blockquote>
													<p>Данная услуга доступна в салонах:</p>
													<ul>
														<li><a href="#">Салон на Ленинском</a></li>
														<li><a href="#">Салон на Коломенской</a></li>
														<li><a href="#">Салон на Сходненской</a></li>
														<li><a href="#">Салон на Братиславской</a></li>
													</ul>
												</blockquote>
											</div>
											<div class="col-md-3 col-sm-5 col-xs-12 right0 left0">
												<div class="btn-order"><a href="#" class="btn btn-primary btn-lg active" role="button">заказать услугу</a></div>
											</div>
										</div>
									</div>
									
									
								</div>
							</div>
						</div>
						<!-- /content -->
					</div>
					<!-- /left-block -->

	<?php
get_footer()
?>