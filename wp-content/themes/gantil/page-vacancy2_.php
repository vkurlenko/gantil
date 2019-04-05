<?php
/*
Template Name: Вакансии 2
*/

get_header();

function get_vacancies()
{
    // параметры по умолчанию
    $args = array(
        'numberposts' => 0,
        'category'    => 0,
        'orderby'     => 'menu_order',
        'order'       => 'ASC',
        'include'     => array(),
        'exclude'     => array(),
        'meta_key'    => '',
        'meta_value'  =>'',
        'post_type'   => 'vacancy',
        'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
    );

    $posts = get_posts( $args );

    return $posts;
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

            <?php
            if ( have_posts() ) :
                while ( have_posts() ) :
                    the_post();
            ?>

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


                <div class="row-fluid">

                    <div class="vacancy-promo">

                        <div class="vacancy-fitch">
                            <div id="w"></div>

                            <div class="vacancy-girls">
                                <!--<img src="/wp-content/uploads/2018/12/Без-имени-2-1024x241.png">-->
                                <img src="/wp-content/themes/gantil/img/girls2.jpg">
                            </div>

                            <?php echo $post->post_content;?>
                        </div>


                        <!-- спойлеры -->

                        <h2 style="text-align: center; font-weight: bold;">Наши ВАКАНСИИ</h2>
                        <div style="margin:20px 0;">
                        <?php
                        $posts = get_vacancies();
                        foreach( $posts as $post ) {
                            ?>
                            <div class="spoiler-wrapper">
                                <div class="spoiler folded">
                                    <i class="fa fa-caret fa-caret-right" aria-hidden="false"></i>
                                    <a href="javascript:void(0);"><?=$post->post_title?></a>
                                </div>
                                <div class="spoiler-text"><?=$post->post_content;?></div>
                            </div>
                            <?php
                        }
                        ?>
                        </div>
                        <!-- /спойлеры -->

                        <!-- form -->
                        <div class="vacancy-form">
                            <p>
                                <strong>Если Вас заинтересовали наши вакансии, заполните форму ниже</strong>
                            </p>

                            <?php
                            echo do_shortcode('[contact-form-7 id="21458" title="Форма отправки резюме"]');

                            $posts = get_vacancies();

                            foreach($posts as $post) {
                                setup_postdata($post);
                                $arr = get_the_category( $post->ID );
                                foreach($arr as $k) {
                                    $arr_vacancy[$post->post_title][] = array($k->slug, $k->name);
                                }
                            }
                            wp_reset_postdata();

                            echo '<select class="vacancy_spec_replace">
                                                            <option value="">---</option>';
                            foreach($arr_vacancy as $k => $v) {
                                echo '<option value="'.$k.'">'.$k.'</option>';
                            }
                            echo '</select>';

                            echo '<select class="vacancy_salon_replace">
                                                            <option value="">---</option>';
                            foreach($arr_vacancy as $k => $v) {
                                foreach($v as $k1 => $v1){
                                    echo '<option value="'.$v1[1].'" class="'.$k.'">'.$v1[1].'</option>';
                                }
                            }
                            echo '</select>';
                            ?>
                        </div>
                        <!-- /form -->

                    </div>
                </div>

            <?php endwhile; ?>
            <?php endif; ?>

        </div>
    </div>
</div>
<!-- /content -->
</div>
<!-- /left-block -->

<script src="/wp-content/themes/gantil/plugin/jquery_chained-1.0.1/jquery.chained.js"></script>

<script type="text/javascript">// <![CDATA[

    function setYouTubeSize(){
        $('.vacancy-promo iframe').each(function () {
            var w = $('#w').width();
            var h = (720 * w) / 1280;
            //var h = (280 * w) / 500;

            $(this).attr({
                'width' : w,
                'height': h
            })
        })
    }


    jQuery(document).ready(function(){

        jQuery('.spoiler-text').hide();
        jQuery('.spoiler').click(function(){
            jQuery(this).toggleClass("folded").toggleClass("unfolded").next().slideToggle()
        })

        $('.spoiler').click(function(e){

            var obj = $(this).find('.fa').eq(0);

            if($(obj).hasClass('fa-caret-down')){
                $(obj).removeClass('fa-caret-down').addClass('fa-caret-right');
                //$(this).find('td.sp').text('развернуть')
            }
            else{
                $(obj).removeClass('fa-caret-right').addClass('fa-caret-down');
                //$(this).find('td.sp').text('свернуть')
            }
        });

        setYouTubeSize();

        $('iframe').each(function (){
          $(this).css('display', 'block');
        })

        $(window).on('resize', function(){
            setYouTubeSize();
        });

        var spec = $('.vacancy_spec_replace').html();
        var salon = $('.vacancy_salon_replace').html();

        $('#vacancy-spec').html(spec);
        $('#vacancy-salon').html(salon);

        $("#vacancy-salon").chained("#vacancy-spec");
    })
    // ]]>
</script>


<?php
get_footer()
?>
