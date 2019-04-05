<?php

require $_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/gantil/controllers/designerController.php';
$designers = new Designer();

$arr = array();

$param = array(
    //'posts_per_page' => 1000,
    'posts_per_page' => 1000,
    'post_type' => ST_Designers::POST_TYPE,
    'orderby'   => 'rand',
    'order'     => 'DESC',
    'tax_query' => array(
        array(
            'taxonomy' => ST_Designers::CATEGORY_TAXONOMY_SLUG,
            'field'    => 'slug',                    
            'terms'    => array('rating5', 'rating4', 'rating3'), //  рейтинг
            'operator' => 'IN'
        )         
    ),
);

$myterms = get_posts($param);

//printArray($myterms);

$i = 0;
foreach( $myterms as $term )
{
    $i++;
    $name 	= '';
    $img 	= '';
    $link 	= '/designers/';

    $thumbnail 	= get_the_post_thumbnail( $term->ID, 'thumbnail_id', true );

   
    $image = get_field("image_img", $term->ID);
    
    if ($image) 
        $image_url = wp_get_attachment_image_src($image['id'], array(400, 400), true);
    else
        $image_url = '';

    $rating = $designers->getRating($term->ID);

    //printArray($rating);

    $arr[] = array(
        'id'	=> $term->ID,
        'name' 	=> $term->post_title,
        'rating'=> $rating,
        'img'	=> $thumbnail,             // лого дизайнера (thumbnail записи) тег <img>
        'image_url' => $image_url[0],         // образ дизайнера (прикрепленный файл)
        'link'	=> $link.$term->post_name
    );

    if($i == 4)
        continue;
}

$arr = $designers->sortDesigners($arr, 'DESC');
array_splice($arr, 8);

?>



<div class="container-fluid grid-service grid-designers grid-salons">
    <h2 class="frontpage-h2">Наши дизайнеры</h2>
    <div class="row-fluid grid-service-slider grid-service-slider1 grid-salons-slider">
        <?
        foreach($arr as $k => $v)
        {
            ?>
            <div class="service-item salons-item">
                <a href="<?=$v['link']?>">
                    
                    <?php 

                    if ($v['image_url']) {
                        ?>
                        <!--<img class="salons-item-img img-mono" src="<?/*=makeGrayPic($v['image_url'])*/?>" data-imgcolor="<?/*=$v['image_url']*/?>">-->
                        <img class="salons-item-img <?=wp_is_mobile() ? '' : 'img-mono';?>" src="<?=makeGrayPic($v['image_url'])?>" alt="<?php the_title(); ?>" data-imgcolor="<?=wp_is_mobile() ? '' : $v['image_url'];?>">
                        <?php
                    }
                    else
                        echo $v['img'];
                    ?>
                </a>
                <div class="service-item-name grid-block-button"><?php if(user_admin()) echo $v['rating']['name'].'<br>';?><?=$v['name']?></div>
            </div>
            <?
        }
        ?>
    </div>

    <div class="grid-news-menu">
        <ul>
            <li class="menu-left"><span class="grid-block-button" >&nbsp;</span></li>
            <li class="menu-center "><a class="grid-block-button" href="/designers/">Все&nbsp;дизайнеры</a></li>
            <li class="menu-right"><span class="grid-block-button" >&nbsp;</span></li>
            <div style="clear:both"></div>
        </ul>
    </div>

</div>



