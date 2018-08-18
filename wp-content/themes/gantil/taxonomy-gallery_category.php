<?php
/*
Template Name: Страница
*/

get_header(); 
?>


						<!-- content -->
						<?php
						
						 $current_term = get_term_by('slug', get_query_var( 'term' ), ST_Galleries::CATEGORY_TAXONOMY_SLUG);

						 $this_slug = $current_term->slug;
						 $this_name = $current_term->name;

						 
						?>
						<div class="row-fluid">
							<div class="container-fluid content">
								
																
								<!-- breadcrumbs -->
								<?php /*if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(' > ');*/ ?>

								<div class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">
									<span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
										<a href="/" itemprop="item">
											<span itemprop="name">Главная</span>
										</a>
									</span>
									<span class="kb_sep"> &gt; </span>

									<span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
										<a href="/galleries/" itemprop="item">
											<span itemprop="name">Галереи</span>
										</a>
									</span>
									<span class="kb_sep"> &gt; </span>


									<!-- <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
										<a href="/gallery_category/<?=$this_slug?>/" itemprop="item">
											<span itemprop="name"><?=$this_name?></span>
										</a>
									</span>
									<span class="kb_sep"> &gt; </span> -->

									<span class="kb_title active"><?=$this_name?></span>
								</div>
								<!-- /breadcrumbs -->


	
								<div class="content-article">
									<h1><?php echo $this_name;?></h1>

									<!-- taxonomy-gallery_category.php -->

									<!-- submenu -->
                                    <ul class="submenu">
                                    <?php  
                                    $args = array(
                                            'taxonomy'      => array( 'gallery_category'), 
                                            'orderby'       => 'menu_order', 
                                            'order'         => 'ASC',
                                            'hide_empty'    => false, 
                                            'object_ids'    => null, // 
                                            'include'       => array(),
                                            'exclude'       => array(), 
                                            'exclude_tree'  => array(), 
                                            'number'        => '', 
                                            'fields'        => 'all', 
                                            'count'         => false,
                                            'slug'          => '', 
                                            'parent'         => '',
                                            'hierarchical'  => true, 
                                            'child_of'      => 0, 
                                            'get'           => 'all', // ставим all чтобы получить все термины
                                            'name__like'    => '',
                                            'pad_counts'    => false, 
                                            'offset'        => '', 
                                            'search'        => '', 
                                            'cache_domain'  => 'core',
                                            'name'          => '', // str/arr поле name для получения термина по нему. C 4.2.
                                            'childless'     => true, // true не получит (пропустит) термины у которых есть дочерние термины. C 4.2.
                                            'update_term_meta_cache' => true, // подгружать метаданные в кэш
                                            'meta_query'    => '',
                                        ); 

                                        $myterms = get_terms( $args );
                                       // $arr = array();
                                        

                                        foreach($myterms as $k => $v)
                                        {
                                        	//$arr[] = $v->slug;
                                        	if($v->slug == 'video-na-glavnuyu')
                                                continue;

                                        	if($this_slug == $v->slug)
                                        		$class = 'class="active"';
                                        	else
                                        		$class = '';
                                            ?><li class="page_item"><a <?=$class;?> href="/gallery_category/<?=$v->slug;?>/"><?=$v->name;?></a></li><?
                                        }

                                        
                                        //printArray($myterms);

                                    ?>
                                    </ul>
                                    
                                    <div style="clear:both"></div>
                                    <!-- /submenu -->

                                    <!-- gallery -->

									<div style="clear:both"></div>
									<div class="news-list">	

										<?php 

										$arr1 = array();
										$arr1 = get_posts( array( 
											'gallery_category' =>  $this_slug , 
											'post_type'   => 'stm_gallery', 
											'orderby' => 'date', 
											'order' => 'DESC', 
											'numberposts' => 1000
											) );

										$i = 0;
										
										foreach($arr1 as $k => $v)
										{

											if($v->post_parent > 0 /*|| get_post_meta( $v->ID, 'on_main_page')*/)
												continue;
											

											$thumb = get_the_post_thumbnail( $v->ID, array(288, 288), array("class"=>"alignleft post_thumbnail") );

											/*if(user_admin())
											{*/
												//$thumb_url = wp_get_attachment_image_src($v->ID, 'gallery_thumb', true);
												$post_meta = get_post_meta($v->ID);
												$image_id = $post_meta['_thumbnail_id'][0];

												$thumb_url = wp_get_attachment_image_src($image_id, array(288, 288), true);

												$img = '<img class=" img-mono"  src="'.makeGrayPic($thumb_url[0]).'">
														<img class=" img-color" src="'.$thumb_url[0].'">';
												/*echo $img;
												die;*/
												$thumb = $img;
											/*}*/

											// 2016-04-10 00:00:00
											$d = explode(' ', $v->post_date);
											$d = explode('-', $d[0]);
											$date = $d[2].'.'.$d[1].'.'.$d[0];
											
											$childrens = get_children( array( 
												'post_parent' => $v->ID,
												'post_type'   => 'stm_gallery', 
												'numberposts' => -1,
												'post_status' => 'any'
											) );

											$ch = '';
											if($childrens)
												$ch = ' ['.count($childrens).']';

											if(get_query_var( 'term' ) != 'video') :
											?>
											<div class="news-list-item container-fluid item-<?php echo $i++;?>" style="padding:0">
												
													<div class="news-list-img">
													
														<a class="" href="/galleries/<?=$v->post_name;?>/"><?=$thumb;?></a>
														
													</div>
													<div class="news-list-text " style="left:0; right:0; bottom:0"><a href="/galleries/<?=$v->post_name;?>/"><?=$v->post_title.$ch?><br><?=$date?></a></div>
											</div>

                                            <?php
                                            else:
                                                ?>

                                            <!-- VIDEO -->

                                            <div class="news_item_2 <? if(($i%2) == 1) echo 'even'?> ">
                                                <div class="news_item_2_img">
                                                    <div class="news-list-img row">
                                                        <a class="col-md-3" style="text-align: left;  padding:0; display:block;" href="/galleries/<?=$v->post_name;?>/"><?=$thumb;?><span></span></a>

                                                        <div class="col-md-9 video-list-title" style=" ">                                                        	
                                                        	<a class="" href="/galleries/<?=$v->post_name;?>/">			                                                   
			                                                        <span class="video-date"><?=$date?></span>
			                                                        <span class="video-title"><?=$v->post_title.$ch?></span>			                                                
			                                                </a>
                                                        </div>
	

                                                        <div style="clear: both"></div>
                                                    </div>
                                                </div>
                                                <!-- <a class="" href="/galleries/<?=$v->post_name;?>/">
                                                    <div class="news_item_2_text">
                                                        <span class="news_item_date"><?=$date?></span>
                                                        <span class="news_item_2_title"><?=$v->post_title.$ch?></span>
                                                
                                                    </div>
                                                </a> -->
                                            </div>

                                            <!-- /VIDEO -->

											
											<?php
                                            endif;

                                            $i++;
										}

										
										//wp_reset_postdata(); // сброс
										?>
									</div>
										
									<!--<script type="text/javascript">
									$(document).ready(function(){
										$('.news-list-img').mouseenter(function()
											{
												
												$(this).find('.img-color').show()
												$(this).find('.img-mono').animate({opacity: 0}, 300);
											}).mouseleave (function()
											{
																								
												$(this).find('.img-mono').animate({opacity: 1}, 500);		
											})

									})
									</script>-->

									<script type="text/javascript">
									$(document).ready(function()
									{	
										/*$('.news-list-img').mouseenter(function()
										{			
											$(this).find('.img-color').show()
											$(this).find('.img-mono').animate({opacity: 0}, 300);
										}).mouseleave (function()
										{		
											$(this).find('.img-mono').animate({opacity: 1}, 500);		
										})*/

										$('.news-list-img a').mouseenter(function()
											{												
												$(this).find('.img-color').animate({opacity: 1, 'z-index':0}, 50);
												$(this).find('.img-mono').animate({opacity: 0}, 100);
											}).mouseleave (function()
											{
												$(this).find('.img-color').animate({opacity: 0, 'z-index':-1}, 100);
												$(this).find('.img-mono').animate({opacity: 1}, 300);		
											})
									});
									</script>



									<!-- /gallery -->
									
									
								</div>
							</div>
						</div>
						<!-- /content -->
					</div>
					<!-- /left-block -->

	<?php
get_footer()
?>