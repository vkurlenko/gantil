<?php
session_start();

require 'controllers/masters.php';
/*
Template Name: Мастера
*/

get_header(); 
?>


                        <!-- content masters -->
                        
                        <div class="row-fluid">
                            <div class="container-fluid content">                                
                                
                                
                                <!-- breadcrumbs -->
                                <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(' > '); ?>
                                <!-- /breadcrumbs -->
    
                                <div class="content-article">

                                    <h1>Мастера</h1>
                                    
                                    
                                    <!-- submenu -->
                                    <!-- <ul class="submenu">
                                    <?php  
                                    $arr_menu = wp_list_pages( 
                                        array(
                                            'title_li' => '',
                                            'child_of' => $post->post_parent,
                                            'depth' => 1,
                                            'echo' => true
                                        ) 
                                    ); 
                                    ?>
                                    </ul> -->
                                    
                                    <div style="clear:both"></div>
                                    <!-- /submenu -->


                                    <!-- форма выбора специальности и салона для вывода мастеров -->
                                    <div style="clear:both">
                                        <form method="post" id="form-masters">
                                            <?
                                            //printArray($_POST);

                                             if(isset($_GET['salon']))
                                             {
                                                $_SESSION['salon'] = $_GET['salon'];
                                                $_SESSION['spec'] = 'all';
                                             }
                                                
                                            if(isset($_GET['spec']))
                                            {
                                                $_SESSION['spec'] = $_GET['spec'];
                                                $_SESSION['salon'] = 'all';
                                            }
                                                

                                            if(isset($_POST['salon']))
                                                $_SESSION['salon'] = $_POST['salon'];
                                            if(isset($_POST['spec']))
                                                $_SESSION['spec'] = $_POST['spec'];

                                            //printArray($_SESSION);
                                            ?>
                                        <?php include('inc/salons-menu.php');?>  
                                        <?php include('inc/spec-menu.php');?>  
                                        </form>
                                        <script language="javascript">
                                            $(document).ready(function()
                                            {
                                                $('#select-spec, #select-salon').change(function(){
                                                    //alert($(this).val())
                                                    $('#form-masters').submit()
                                                })
                                            })
                                        </script>
                                    </div>
                                    <div style="clear:both"></div>
                                    <!-- /форма выбора специальности и салона для вывода мастеров -->

                                                                     
                                    
                                    
                                    <!-- мастера -->

                                    <div class="inner-menu-wrap">
                                        <?php

                                        // выберем мастеров по специальностям и салона, сохраненным в сессии
                                        $slug = array();

                                                                          
                                        /* выберем слаги всех салонов и всех специальностей и сведем их в два отдельных массива */
                                        $args = array(
                                            'taxonomy'      => array( ST_Masters::CATEGORY_TAXONOMY_SLUG ), 
                                            'orderby'       => 'menu_order', 
                                            'order'         => 'ASC',
                                            'hide_empty'    => true, 
                                            'object_ids'    => null, // 
                                            'include'       => array(),
                                            'exclude'       => array(424, 425), // исключим из выборки Администраторов и Директоров
                                            'exclude_tree'  => array(), 
                                            'number'        => '', 
                                            'fields'        => 'all', 
                                            'count'         => false,
                                            'slug'          => $slug, // здесь выбранный салон и специальность 
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

                                        $arr_skip = array('salon', 'spec', 'color', 'rating');
                                        foreach( $myterms as $term )
                                        {                                                                                   
                                            if (in_array($term->slug, $arr_skip))
                                                continue;

                                            $arr[$term->parent][] = $term->slug;
                                        }
                                        
                                        
                                        
                                        // сформируем список мастеров в зависимости от наличия фильтра                                        
                                        $posts = getMasters($arr, isFilter());

                                                               
                                        /* получили массив мастеров */


                                      

                                    
                                        /* вывод мастеров */    

                                        $arr_temp = array();
                                        $i = 1;
                                        foreach($posts as $pst)
                                        {
                                            $cat = get_the_terms( $pst->ID , ST_Masters::CATEGORY_TAXONOMY_SLUG);                                                 
                                            

                                            $s = '';
                                            $master_spec = $salon_name = $master_color = $master_rating = '';

                                            foreach($cat as $parent_cat)
                                            {    

                                                // специальность
                                                if($parent_cat->parent == 25)   
                                                    $master_spec = $parent_cat->name; 

                                                // салон
                                                if($parent_cat->parent == 26)   
                                                {
                                                    if(!empty($_SESSION['salon']) && $_SESSION['salon'] != 'all' )
                                                    {                                                        
                                                        if($parent_cat->slug == $_SESSION['salon'])
                                                            $salon_name = $parent_cat->name; 
                                                    }
                                                    else
                                                        $salon_name = $parent_cat->name;                                                   
                                                }

                                                // цвет смены
                                                //$master_color = '';
                                                if ($parent_cat->parent == 151 || $parent_cat->parent == 152)  
                                                {
                                                    $master_color = 'watch-'.$parent_cat->slug;  
                                                }      

                                                // рейтинг
                                                if($parent_cat->parent == 499)   
                                                    $master_rating = $parent_cat->name;                                                                                      
                                     
                                            }

                                            // фото мастера
                                            $thumbnail = get_the_post_thumbnail( $pst->ID, 'master_thumb', '' );

                                             
                                            ?>

                                            <div class="five-column">
                                                <div class="our-team ">
                                                   <?php
                                                   if(user_admin()) {
                                                    ?>
                                                    <div><?=$master_rating?></div>
                                                    <?php
                                                   } 
                                                   ?>
                                                    <div class="team-member">
                                                        <a href="<?php echo get_permalink( $pst->ID )?>">
                                                            <?=$thumbnail;?>
                                                        </a>
                                                    </div> 
                                                    <h5 class="member-name"><?php echo $pst->post_title?> </h5>
                                                    <p class="member-post"></p>
                                                    <p class="member-tags"><?=$master_spec?><br><?=$salon_name?></p>
                                                    <!-- <span class="watch <? echo $master_color;?>"></span> -->
                                                    <p></p>
                                                                
                                                    <div class="speaker-topic-title">                                       
                                                        <!-- <h4><a style="color:#ffffff" onclick="splite_loader(); return false;" href="<?php echo get_permalink( $pst->ID )?>">Записаться</a></h4> -->
                                                        <h4><a style="color:#ffffff" onclick="splite_loader(); return false;" href="#">Записаться</a></h4>
                                                        <!-- <a data-salon="" href="#contact_form_pop_up_5" onclick="return false;" class=" arrow">Записаться</a> -->
                                                    </div>
        
                                                 </div>
                                             </div>

                                            <?php  
                                            $i++;
                                            if($i > 5)      
                                            {
                                                echo '<div class="masters-delimiter"></div>';
                                                $i = 1;
                                            } 
                                        }

                                        if(empty($posts))
                                        {
                                            ?>
                                            <p>В данном салоне нет мастеров выбранной специальности</p>
                                            <?
                                        }

                                        /* /вывод мастеров */

                                        ?>
                                    </div>
                                    <!-- мастера -->
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /content -->
                    </div>
                    <!-- /left-block -->




<?php
get_footer()
?>