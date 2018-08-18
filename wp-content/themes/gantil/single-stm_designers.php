<?php
/*
Template Name: Страница дизайнера
*/

get_header(); 
require 'controllers/designerController.php';
?>


						<!-- content -->


                        <?php   
                        $post = get_post();
                        //printArray(get_post_custom());
                        //echo __FILE__;
                        ?>
                        
                        <div class="row-fluid">
                            <div class="container-fluid content">                                
                                
                                
                                <!-- breadcrumbs -->
                             <?php 
                                /*if( function_exists('kama_breadcrumbs') ) 
                                    kama_breadcrumbs(' > '); */
                                ?>
                                <!-- /breadcrumbs -->    

                                <!-- breadcrumbs -->
                                 
                                 <div class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">
                                    <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                        <a href="/" itemprop="item">
                                            <span itemprop="name">Главная</span>
                                        </a>
                                    </span>
                                    
                                    <span class="kb_sep"> &gt; </span>
                                    <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                        <a href="/designers/" itemprop="item">
                                            <span itemprop="name">Дизайнеры</span>
                                        </a>
                                    </span>


                                    <?php
                                    /* добавить в breadcrumb цепочку {салон > специальность} */
                                    /*foreach($tags as $k => $v)
                                    {
                                        ?>
                                        <span class="kb_sep"> &gt; </span>
                                            <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                                <a href="<? echo '/masters/?'.$v[0].'='.$v[2];?>" itemprop="item">
                                                    <span itemprop="name"><?=$v[1]?></span>
                                                </a>
                                            </span>
                                        <?                                    
                                    }*/
                                    /* /добавить в breadcrumb цепочку {салон > специальность} */
                                    ?>

                                    
                                    <span class="kb_sep"> &gt; </span>
                                    <span class="kb_title active"><?php the_title(); ?></span></div>
                                    <!-- /breadcrumbs -->
        


                                <div class="content-article">

                                    <?php
                                    $d = new Designer();
                                    $thumb = $d->getThumb($post->ID);
                                    ?>

                                    <h1><?php the_title(); ?></h1>   

                                    <!-- дизайнер -->      
                                    <div class="row">
                                        <div class="col-md-4"><?=$thumb;?></div>  
                                        <div class="col-md-8">
                                            <?the_content();?>
                                            <?php
                                           // echo $d->getImage($post->ID);
                                            ?>
                                        </div>                                                               
                                    </div>

                                    <div class="row">
                                         
                                        <?php
                                        $custom = get_post_custom();
                                        if( isset($custom['designer_gallery'][0] )) :
                                            ?>
                                            <div class="designer-gallery">
                                                <?=do_shortcode($custom['designer_gallery'][0]);?>
                                            </div>
                                         <?php
                                         endif;   
                                        ?>

                                        <?php
                                        $custom = get_post_custom();
                                        if( isset($custom['designer_video'][0] )) :
                                            ?>
                                            <div class="designer-gallery">
                                                <?=do_shortcode($custom['designer_video'][0]);?>
                                            </div>
                                         <?php
                                         endif;   
                                        ?>
                                        
                                    </div>
                                                                                                      

                                                                               
                                            
                                       
                                    <!-- /дизайнер -->
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /content -->
					</div>
					<!-- /left-block -->

	<?php
get_footer()
?>