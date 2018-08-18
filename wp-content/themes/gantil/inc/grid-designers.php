<?php

require $_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/gantil/controllers/designerController.php';
$designers = new Designer();

$arr = array();

$param = array(
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
                    /*if ( $designers->getImage($v['id'])) {
                        echo $designers->getImage($v['id']);
                    }*/
                    if ($v['image_url']) {
                        ?>
                        <img class="salons-item-img img-mono" src="<?=makeGrayPic($v['image_url'])?>">
                        <img class="salons-item-img img-color" src="<?=$v['image_url']?>">
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

<script language="javascript">

$(document).ready(function(){

    /*$('.grid-designers').slick({
    dots: false,
    infinite: false,                        
    slidesToShow: 4,
    slidesToScroll: 4,
    arrows: true,
    mobileFirst: true,
    responsive: [                   
        {
          breakpoint: 980,
          settings: {slidesToShow: 3, slidesToScroll: 3, dots: false }
        },
        {
          breakpoint: 680,
          settings: {slidesToShow: 2, slidesToScroll: 2, arrows: true }
        },
        {
          breakpoint: 480,
          settings: { slidesToShow: 1, slidesToScroll: 1, arrows: true }
        },
        {
          breakpoint: 300,
          settings: { slidesToShow: 1, slidesToScroll: 1, arrows: true }
        }
    ]
    // prevArrow : '<button type="button" class="slick-prev slick-prev-my">Prev</button>',
    
  });*/
})

</script>



