<?php

/*
Template Name: Личный кабинет
*/

get_header(); 
?>


<!-- content -->
                        
                        <div class="row-fluid">
                            <div class="container-fluid content">                                
                                
                                
                               
    
                                <div class="content-article">

                                    <h1><?php the_title();?></h1>
                                    
                                    <?
                                    $post = get_post();
                                    ?>

                                    
                                                                       
                                    <?php echo $post -> post_content;  ?>

<?
echo do_shortcode( '[woocommerce_my_account]' );
?>
                                   
                                </div>
                            </div>
                        </div>
                        <!-- /content -->
                    </div>
                    <!-- /left-block -->




<?php
get_footer()
?>