<?php
/*
Template Name: Создать реферальную ссылку
*/

/*require_once $_SERVER['DOCUMENT_ROOT'].'/wp-content/plugins/my-referal/Referal.php';
$referal = new Referal();*/

get_header();
?>


    <!-- content -->
<?php
$post = get_post();

//print_r($post);?>
    <div class="row-fluid">
        <div class="container-fluid content">


            <!-- breadcrumbs -->
            <?php if( function_exists('kama_breadcrumbs') ) kama_breadcrumbs(' > '); ?>
            <!-- /breadcrumbs -->

            <div class="content-article">

                <?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>

                    <h1><?php the_title();?></h1>


                    <!-- submenu -->
                    <ul class="submenu">
                        <?php
                        $arr_menu = wp_list_pages(
                            array(
                                'title_li' => '',
                                'child_of' => $post->ID,
                                'depth' => 1,
                                'echo' => false
                            )
                        );

                        echo $arr_menu;

                        ?>
                    </ul>

                    <div style="clear:both"></div>
                    <!-- /submenu -->

                    <div class="col-md-4">
                        <?php
                        the_content();
                        //$referal->renderForm();
                        ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        //the_content();
                        ?>
                    </div>

                <?php endwhile; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <!-- /content -->
    </div>
    <!-- /left-block -->

<?php
get_footer()
?>