<?php
/*
Template Name: Страница
*/

get_header(); 
?>


						<!-- content -->
						<?php
						$post = get_post();
						setup_postdata($post);
						//printArray($post);

						$cat = get_the_terms($post->ID, 'gallery_category');
						foreach($cat as $c)
						{
							$arr_cat[] = $c->slug;

							$arr_bc[] = array(
								'is_category' => true,
								'slug' => $c->slug,
								'name' => $c->name
								);
						}

						if($post->post_parent > 0)
						{
							$post_parent = get_post($post->post_parent);
							//printArray($post_parent);

							$arr_bc[] = array(
								'is_category' => false,
								'slug' => $post_parent->post_name,
								'name' => $post_parent->post_title
								);
						}
						
						//printArray($arr_bc);
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
								
								
									<?
									
									foreach($arr_bc as $bc)
									{
										$url = '';
										if($bc['is_category'] == true)
											$url .= '/gallery_category/'.$bc['slug'].'/';
										else
											$url .= '/galleries/'.$bc['slug'].'/';
										//$url .= '/'.$bc['slug'].'/';

										?>
										<span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
											<a href="<?=$url?>" itemprop="item">
												<span itemprop="name"><?=$bc['name']?></span>
											</a>
										</span>
										<span class="kb_sep"> &gt; </span>
										<?
									}
									?>
									
								
									<span class="kb_title active"><?=$post->post_title?></span>
								</div>


								<!-- /breadcrumbs -->
	
								<div class="content-article">
										

									<!-- submenu -->
                                    <ul class="submenu">
                                    <?php  
                                    $args = array(
                                            'taxonomy'      => array( 'gallery_category'), 
                                            'orderby'       => 'menu_order', 
                                            'order'         => 'ASC',
                                            'hide_empty'    => true, 
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

                                        $arr = array();
                                        foreach($myterms as $k => $v)
                                        {
                                        	if($v->slug == 'video-na-glavnuyu')
                                                continue;

                                            $arr[] = $v->slug;

                                            if(in_array($v->slug, $arr_cat))
                                                $class='class="active"';
                                            else
                                                $class = '';
                                            ?><li class="page_item"><a <?=$class?> href="/gallery_category/<?=$v->slug;?>/"><?=$v->name;?></a></li><?
                                        }

                                        wp_reset_postdata();
                                        //printArray($myterms);
                                    ?>
                                    </ul>
                                    
                                    <div style="clear:both"></div>
                                    <!-- /submenu -->


									<h1><? the_title();?></h1>
									<!-- single-stm_gallery.php -->
									<div id="gallery-content">
										<? the_content();?>

										<style>

											.v-pl{margin:1px;}
										</style>
									</div>

									<?
							
									

									$childrens = get_children( array( 
										'post_parent' => $post->ID,
										'post_type'   => 'stm_gallery', 
										'numberposts' => -1,
										'post_status' => 'any'
									) );

									if( $childrens )
									{
										foreach( $childrens as $v )
										{											

											$thumb = get_the_post_thumbnail( $v->ID, array(288, 288), array("class"=>"alignleft post_thumbnail") );

											// 2016-04-10 00:00:00
											$d = explode(' ', $v->post_date);
											$d = explode('-', $d[0]);
											$date = $d[2].'.'.$d[1].'.'.$d[0];
											
											?>
											<div class="news-list-item container-fluid item-<?php echo $i++;?>">
												
													<div class="news-list-img">														
														<a class="" href="/galleries/<?=$v->post_name;?>/"><?=$thumb;?></a>															
													</div>

													<div class="news-list-text "><a href="/galleries/<?=$v->post_name;?>/"><?=$v->post_title?><br><?=$date?></a></div>
											</div>
											
											<?php												
										}
									}

									?> 
									
									<?php wp_reset_postdata();?>
								</div>
							</div>
						</div>
						<!-- /content -->
					</div>
					<!-- /left-block -->

	<?php
get_footer()
?>