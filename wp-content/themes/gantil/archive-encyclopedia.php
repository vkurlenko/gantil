<?php
/*
Template Name: Энциклопедия - главная
*/
get_header();

/*$wpdb2 = new wpdb( 'gantil_mysql', 'icbi0dws', 'gantil_2', 'gantil.mysql' );
//$wpdb2 = new wpdb( 'gantil_user', 'gantil_pwd', 'gantil_db', 'localhost' );

if( ! empty($wpdb2->error) ) wp_die( $wpdb2->error );

// Готово, теперь используем функции класса wpdb
$results = $wpdb2->get_results("SELECT termin_name, termin_descr FROM `gantil_encyc`");*/


function getContent($title = null){
    global $wpdb;
    global $results;

    $res = $wpdb->get_results( "SELECT post_title, post_content FROM `gn_posts` WHERE post_title = '".$title."' AND post_status = 'publish' AND id > 25973");
    printArray($res);

    foreach($results as $row){
        $wpdb->show_errors();

        if(mb_strtolower($title) == mb_strtolower($row->termin_name)){

            $res = $wpdb->query("
                UPDATE `gn_posts` SET post_content = '".$row->termin_descr."' 
                WHERE `gn_posts`.`post_title` = '".$title."' 
                AND `gn_posts`.`post_status` = 'publish'
                AND `gn_posts`.`ID` > 25973");

            if($res === false){
                echo 'error';
                $wpdb->print_error();
            }
        }
    }
}
?>
<!-- content -->
<?php
$post = get_post();
?>
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


                <div class="content-img-service"><?php the_post_thumbnail();?></div>
                <div>
                    <?php the_content();?>

                    <?php
                    //getContent();
                    ?>

                    <ul class="en-ul">

                    <?php
                    $posts = get_posts( array(
                        'numberposts' => 0,
                        'category_name' => 'encyclopedia',
                        'orderby'     => 'post_title',
                        'order'       => 'ASC',
                        'include'     => array(),
                        'exclude'     => array(),
                        'meta_key'    => '',
                        'meta_value'  =>'',
                        'post_type'   => 'post',
                        'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                    ) );

                    foreach($posts as $post):
                        $href = '#'; ///encyclopedia/'.$post->post_name;
                        //getContent($post->post_title);
                        //die;
                        ?>
                        <li>
                            <a class="en-title" href="<?=$href?>"><?=$post->post_title?></a>
                            <div class="en-content"><?=$post->post_content?></div>
                        </li>
                    <?php
                    endforeach;
                    ?>

                    </ul>
                    <?php
                    //printArray($posts);
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

<style>
    .en-ul, .en-ul li{
        list-style: none;
    }
    .en-content{
        display: none;
        margin-bottom:20px;
    }

    .en-title-active{
        font-weight: bold;
        color:#f30;
        margin-top:20px;
        display: block;
    }

    a.en-title:focus, a.en-title:active{color:#f30 !important;}

</style>

<script>
    $(document).ready(function(){
        $('.en-title').click(function () {
            $('.en-title').removeClass('en-title-active');
            $(this).addClass('en-title-active');

            $('.en-content').hide('fast');

            $(this).next('.en-content').toggle('fast')
            return false;
        })
    })
</script>

<?php
get_footer()
?>
