<?php
//session_start();
/*
Template Name: Галереи
*/

get_header(); 
?>


                        <!-- content -->
                        
                        <div class="row-fluid">
                            <div class="container-fluid content">                                
                                
                                
                                <!-- breadcrumbs -->
                                <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(' > '); ?>
                                <!-- /breadcrumbs -->
    
                                <div class="content-article">

                                    <?
                       //              echo ST_Galleries::CATEGORY_TAXONOMY;
                       //              //$current_term = get_term_by('slug', get_query_var( 'term' ), ST_Galleries::CATEGORY_TAXONOMY_SLUG);
                       //  $post = get_post();
                       //  echo $post->ID;
                       //  setup_postdata($post);
                       //  echo $post->post_title;
                       // printArray($post);

                       //              $this_slug = $current_term->slug;
                       //              $this_name = $current_term->name;
                                    ?>

                                    <h1>Галереи</h1>
                                    
                                    <?
                                    //$post = get_post();
                                    //printArray($post);
                                    ?>


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
                                            'slug'          => '', // здесь выбранный салон и специальность 
                                            'parent'        => '',
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

                                            if($v->slug == 'instagram')
                                                $v->name = '<i class="fa fa-instagram" aria-hidden="true"></i> instagram';
                                            
                                            $arr[] = $v->slug;

                                            if($v->slug == $arr[0])
                                                $class='class="active"';
                                            else
                                                $class = '';
                                            ?><li class="page_item"><a <?=$class?> href="/gallery_category/<?=$v->slug;?>/"><?=$v->name;?></a></li><?
                                        }

                                        wp_reset_postdata();
                                    ?>
                                    </ul>
                                    
                                    <div style="clear:both"></div>
                                    <!-- /submenu -->


                                    <!-- archive-stm_gallery.php -->


                                    
                                    <!-- gallery -->

                                    <div style="clear:both"></div>
                                    <div class="news-list"> 

                                    <?php

                                    if($arr[0] == 'instagram'){
                                        //echo do_shortcode('[ap_instagram_mosaic_lightview]');
                                        echo do_shortcode('[my_instagram]');
                                    }
                                    else {

                                        $arr1 = array();
                                        $arr1 = get_posts(array(
                                            'gallery_category' => $arr[0],
                                            'post_type' => 'stm_gallery',
                                            'orderby' => 'date',
                                            'order' => 'DESC',
                                            'numberposts' => 1000
                                        ));


                                        foreach ($arr1 as $k => $v) {

                                            if ($v->post_parent > 0)
                                                continue;
                                            /*printArray($v);

                                            die;*/

                                            $thumb = get_the_post_thumbnail($v->ID, array(288, 288), array("class" => "alignleft post_thumbnail"));

                                            // 2016-04-10 00:00:00
                                            $d = explode(' ', $v->post_date);
                                            $d = explode('-', $d[0]);
                                            $date = $d[2] . '.' . $d[1] . '.' . $d[0];

                                            $childrens = get_children(array(
                                                'post_parent' => $v->ID,
                                                'post_type' => 'stm_gallery',
                                                'numberposts' => -1,
                                                'post_status' => 'any'
                                            ));

                                            $ch = '';
                                            if ($childrens)
                                                $ch = ' [' . count($childrens) . ']';
                                            ?>
                                            <div class="news-list-item container-fluid item-<?php echo $i++; ?>">

                                                <div class="news-list-img">

                                                    <a class=""
                                                       href="/galleries/<?= $v->post_name; ?>/"><?= $thumb; ?></a>

                                                </div>
                                                <div class="news-list-text "><a
                                                            href="/galleries/<?= $v->post_name; ?>/"><?= $v->post_title . $ch ?>
                                                        <br><?= $date ?></a></div>
                                            </div>


                                            <?php

                                            if ($i > 9) $i = 1;
                                        }

                                    }
                                    
                                    //wp_reset_postdata(); // сброс
                                    ?>
                                </div>

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