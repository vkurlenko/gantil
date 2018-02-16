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

                        $arr = get_the_terms( $post->ID, 'masters_category' );
                          // printArray($arr);
                            $tags = array();
                            if($arr)
                            {
                                foreach($arr as $k => $v)
                                {

                                    if($v->parent == 25)                                        
                                        $tags[1] =  array('spec', $v->name, $v->slug);

                                    if($v->parent == 26)
                                        $tags[0] = array('salon', $v->name, $v->slug);  
                                }                                                
                            }
                            ksort($tags);

                        ?>
                        
                        <div class="row-fluid">
                            <div class="container-fluid content">                                
                                
                                
                                <!-- breadcrumbs -->
                             <!--    <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(' > '); ?>  -->

                             <div class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                                <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                    <a href="/" itemprop="item">
                                        <span itemprop="name">Главная</span>
                                    </a>
                                </span>
                                
                                <span class="kb_sep"> &gt; </span>
                                <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                    <a href="/sertif/" itemprop="item">
                                        <span itemprop="name">Сертификаты</span>
                                    </a>
                                </span>


                                

                                
                                <span class="kb_sep"> &gt; </span>
                                <span class="kb_title active"><?php the_title(); ?></span></div>
                                <!-- /breadcrumbs -->
    


                                <div class="content-article">

                                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									    <h1><?php the_title(); ?></h1>
									    <div><?php the_content(); ?></div>
									</article>

                                    

                                                                     
                                    
                                    
                                    
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /content -->
					</div>
					<!-- /left-block -->

	<?php
get_footer()
?>