<?php
		
	$arr = array();

    $args = array(
		'taxonomy'      => array( 'gallery_category'), // название таксономии с WP 4.5
		'orderby'       => 'id', 
		'order'         => 'ASC',
		'hide_empty'    => false, 
		'object_ids'    => null, // 
		'include'       => array(),
		'exclude'       => array(), 
		'exclude_tree'  => array(), 
		'number'        => '', 
		'fields'        => 'all', 
		'count'         => false,
		'slug'          => '', 
		'parent'         => '', // УСЛУГИ
		'hierarchical'  => true, 
		'child_of'      => 0, 
		'get'           => '', // ставим all чтобы получить все термины
		'name__like'    => '',
		'pad_counts'    => false, 
		'offset'        => '', 
		'search'        => '', 
		'cache_domain'  => 'core',
		'name'          => '', // str/arr поле name для получения термина по нему. C 4.2.
		'childless'     => false, // true не получит (пропустит) термины у которых есть дочерние термины. C 4.2.
		'update_term_meta_cache' => true, // подгружать метаданные в кэш
		'meta_query'    => '',
	); 

$myterms = get_terms( $args );





//printArray($myterms);
$i = 0;
foreach( $myterms as $term )
{
	
	$name 	= '';
	$img 	= '';
	$link 	= '/gallery_category/';
	$video  = '';

	// получим ID картинки из метаполя термина
	$image_id = get_term_meta( $term -> term_id, '_thumbnail_id', 1 );
	//echo $image_id;

	// ссылка на полный размер картинки по ID вложения
	//$image_url = wp_get_attachment_image_url( $image_id, 'gallery_thumb' );


	//$thumb_id = get_post_thumbnail_id();
	$thumb_url = wp_get_attachment_image_src($image_id, 'gallery_thumb', true);
			

	// выводим картинку на экран

	//$img = '<img class="salons-item-img" src="'. $image_url .'" alt="" />';

	$img = '<img class="salons-item-img img-mono img'.$i++.'"  src="'.makeGrayPic($thumb_url[0]).'">
			<img class="salons-item-img img-color" onload="initVideo()"  src="'.$thumb_url[0].'">';

	
	if($term->slug == 'video-na-glavnuyu')
	{
		$arg = array( 
			'gallery_category' 	=> 'video-na-glavnuyu' , 
			'post_type'   		=> 'stm_gallery', 
			'orderby' 			=> 'rand', 
			'order' 			=> 'DESC',
			/*'meta_key'    		=> 'on_main_page',
			'meta_value'  		=> 1,*/
			'numberposts' 		=> 1
		);

		$arr1 = get_posts($arg);

		//printArray($arr1);
		$video = $arr1[0] -> post_content;
	}
	else
	{
		$arr[] = array(
			'name' 	=> $term->name,
			'slug'	=> $term->slug,
			'img'	=> $img,
			'link'	=> $link.$term->slug.'/',
			'dscr'	=> $term->description
		);
	}
	//printArray($term);	
}

?>

<div class="container-fluid grid-gallery">

	<h2 class="frontpage-h2">Галерея</h2>

	<!-- <div class="row-fluid ">
		<div class="video-noslick">	
			<?=$video?>											
		</div>	
	</div> -->
	

	<div class="row-fluid grid-gallery-slider ">		

		<div class="col-md-8 col-sm-8 col-xs-12 gallery-item video"  style=" overflow: hidden">
			<?/*=$video*/?>
            <a href="/galleries/krasota-i-stil-ot-zhantil/" style="display: block; position: relative; height: 100%">
                <img src="/wp-content/themes/gantil/img/video_banner_bg.jpg" width="1080" height="515">
                <div class="video-banner-title" style="position: absolute; bottom:0; width: 100%">
                    <img src="/wp-content/themes/gantil/img/video_banner_title.png" style="width: 100%;">
                </div>
            </a>

		</div>	

		<?
		foreach($arr as $k => $v)
		{
			/*if($v['slug'] == 'video')
				continue;*/
			?>
			<div class="col-md-4 col-sm-4 col-xs-6 gallery-item ">
				<a href="<?=$v['link']?>">
					<?=$v['img']?>					
					<!-- <div class="gallery-name"><?=$v['name']?></div>		 -->	

					<?
					if($v['slug'] == 'video')
					{
						?>
						<img class="icon-yt img-color" src="/wp-content/themes/gantil/img/yt.png">
						<img class="icon-yt img-mono" src="/wp-content/themes/gantil/img/yt-mono.png"><?
					}
					?>	

					<?php 
					if( $v['dscr'] ) :?>
						<div class="over-text"><?=$v['dscr']?></div>
					<?php endif;?>	
				</a>

				<div class="service-item-name grid-block-button"><?=$v['name']?></div>
				
			</div>
			<?
		}
		?>		
<div style="clear: both"></div>
	</div>
</div>

<style>
	
.over-text {
	    display: block;
	    text-align: center;
	    font-size: 14px;
	    text-transform: none;
	    font-weight: normal;
	    margin-left: 0;
	    position: absolute;
	    bottom: 0;
	    background: rgba(96, 96, 96, 0.64);
	    padding: 10px;
	    color: #fff;
	    width: 100%;
	}
</style>

<script type="text/javascript">
function initVideo()
{//alert('v')

   /* $('.video iframe').attr(
	{			
		'height' : $('.img0').height(),
	})*/

    $('.video').css(
        {
            'height' : $('.img0').height(),
            'overflow' : 'hidden'
        })
}

$(document).ready(function(){

	//initVideo()
	/*$('.img0').bind('load', function (e) 
	{
		alert('img')
	    // Do stuff on load
	   // initVideo()
  	});*/

	$('.img0').load(function() 
	{
	  initVideo() // действия, в ответ на загрузку изображения
	});

	$(window).resize(function() 
	{
		initVideo()		
	})

	$('.gallery-item').mouseenter(function()
	{
		$(this).find('.grid-block-button').css('color', '#000')
		
		
		$(this).find('.img-color').show()
		$(this).find('.img-mono').animate({opacity: 0}, 300);
	}).mouseleave (function()
	{
		$(this).find('.grid-block-button').css('color', '#606060')
		
		$(this).find('.img-mono').animate({opacity: 1}, 500);		
	})
		
});

</script>