<?php
/*
Template Name: Страница
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
								
								
	
								<div class="content-article">
									
									<div>									
											<div>
										     <br>
										</div>
										<div>
										     <br>
										</div>
										<div style="text-align:center">
										     Ошибка 404. Нет такой страницы<br>
										     <a href="/">Перейти на главную</a>
										</div>
										<div>
										     <br>
										</div>
										<div>
										     <br>
										</div>
										<script type="text/javascript">
										     setTimeout(function () {
										     window.location.href = "/"; //will redirect to your blog page (an ex: blog.html)
										     }, 2000);
										</script> 
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