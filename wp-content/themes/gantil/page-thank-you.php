<?php

/*
Template Name: Спасибо за заказ
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

                                    <h1>&nbsp;<?php /*the_title();*/?></h1>
                                    
                                    <?
                                    $post = get_post();
                                    ?>

                                    
                                    <h1 style="text-align:center">Спасибо за заказ!</h1>
                                   
                                    <?php echo $post -> post_content;?>

                                    <!-- <p align="center"></p> -->
                                   

                                    
                                    
                                </div>
                            </div>
                        </div>
                        <!-- /content -->
                    </div>
                    <!-- /left-block -->




<?php
get_footer()
?>