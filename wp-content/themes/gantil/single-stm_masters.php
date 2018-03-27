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
                                    <a href="/masters/" itemprop="item">
                                        <span itemprop="name">Мастера</span>
                                    </a>
                                </span>


                                <?php
                                /* добавить в breadcrumb цепочку {салон > специальность} */
                                foreach($tags as $k => $v)
                                {
                                    ?>
                                    <span class="kb_sep"> &gt; </span>
                                        <span itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                            <a href="<? echo '/masters/?'.$v[0].'='.$v[2];?>" itemprop="item">
                                                <span itemprop="name"><?=$v[1]?></span>
                                            </a>
                                        </span>
                                    <?                                    
                                }
                                /* /добавить в breadcrumb цепочку {салон > специальность} */
                                ?>

                                
                                <span class="kb_sep"> &gt; </span>
                                <span class="kb_title active"><?php the_title(); ?></span></div>
                                <!-- /breadcrumbs -->
    


                                <div class="content-article">

                                    <h1><?php the_title(); ?></h1>
                                    
                                    <?
                                    // $post = get_post();
                                    // setup_postdata($post);
                                   
                                    ?>

                                    <!-- social-block -->
                                        <?php get_template_part('inc/social/social-block');?>
                                        <!-- /social-block -->

                                                                     
                                    
                                    
                                    <!-- мастер -->

                                    <div class="inner-menu-wrap">

                                        <div class="col-md-3 master-pic">
                                            <?                                        
                                            the_post_thumbnail('post-thumbnail');                                        
                                            ?>
                                            <div></div>
                                            <!-- специальность и салон -->
                                            <?
                                         

                                            $arr = array();
                                            foreach($tags as $k => $v)
                                            {
                                                echo '<span class="master-tag"><a class="" href="/masters/?'.$v[0].'='.$v[2].'">#'.$v[1].'</a></span><br>';
                                                $arr[$v[0]] = $v[1];
                                            }
                                            ?> 
                                            <!-- /специальность и салон -->

                                            <div></div>
                                            


                                            
                                            <div class="our-team" style="background:none; border:0">
                                                    
                                                <h5 class="member-name" style="display:none"><?=the_title();?></h5>
                                                <p class="member-post"  style="display:none"></p>
                                                <p class="member-tags"  style="display:none"><?=$arr['spec']?><br><?=$arr['salon']?></p>      

                                                <?
                                                //echo  do_shortcode('[contact-form-7 id="1074" title="Запись к мастеру"]');
                                            ?>                                              
                                                            
                                                
                                                <!-- <button class="master-button" onclick="splite_loader(); return false;">Записаться</button> -->
                                                <li class="fancybox-inline" style="list-style:none">
                                                    <h4>
                                                        <a data-salon="" href="#contact_form_pop_up_5" onclick="return false;" class="arrow" style="color:#fff">
                                                            <button class="master-button" onclick="splite_loader(); return false;">Записаться</button>
                                                        </a>
                                                    </h4>
                                                </li>
                                                
    
                                             </div>


                                        
                                        </div>  

                                        <div class="col-md-9 master-info">                                             

                                            <?   
                                           // echo $post -> post_content;
                                            the_content();
                                            ?>                                           
                                            
                                       
                                        </div>  
                                    </div>
                                    <!-- /мастер -->
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /content -->
					</div>
					<!-- /left-block -->

	<?php
get_footer()
?>