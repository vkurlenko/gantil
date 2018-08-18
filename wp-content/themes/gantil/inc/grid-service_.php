<?php
		
	$arr = array();

    $args = array(
	'taxonomy'      => array( 'product_cat'), // название таксономии с WP 4.5
	'orderby'       => 'menu_order', 
	'order'         => 'ASC',
	'hide_empty'    => false, 
	'object_ids'    => null, // 
	'include'       => array(),
	'exclude'       => array(49, 183),  // исключим 49-студия загара, 183 - имиджконсультирование
	'exclude_tree'  => array(), 
	'number'        => '', 
	'fields'        => 'all', 
	'count'         => false,
	'slug'          => '', 
	'parent'         => 79, // УСЛУГИ
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

foreach( $myterms as $term )
{
	/*$arr_skip = array('studija-zagara', 'imidzhkonsultirovanie');
	if(in_array($term->slug, $arr_skip))//$term->slug == 'studija-zagara')
		continue;*/
	
	$name 	= '';
	$img 	= '';
	$link 	= '/product-category/service/';

	$thumbnail_id 	= get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
	$image 			= wp_get_attachment_url( $thumbnail_id );

	
	if($image) 
	{
		$img = '<img class="service-item-img" src="' . $image . '" alt="" />';
	}

	$arr[] = array(
		'id'	=> $term->term_id,
		'name' 	=> $term->name,
		'img'	=> $img,
		'link'	=> $link.$term->slug.'/'
		);

	//printArray($term);
	
}

?>

<style type="text/css">
	.grid-service-slider{display: none;}
</style>

<div class="container-fluid grid-service">
	<h2 class="frontpage-h2">Наши услуги</h2>
	<div class="row-fluid grid-service-slider grid-service-slider1">

		<?
		foreach($arr as $k => $v)
		{
			?>
			<div class="service-item">
				<a href="<?=$v['link']?>"><?=$v['img']?></a>
				<div class="service-item-name grid-block-button"><?=$v['name']?></div>

				<ul class="box-menu">
					
					<li class="box-menu-left"><a class="" href="/price/">Цены</a></li>
					<li class="box-menu-right fancybox-inline "><a class="" onclick="return false;" href="#contact_form_pop_up">Записаться</a></li><div style="clear:both"></div>
					
				</ul>				
			</div>
			<?
		}
		?>

	</div>
</div>

<!-- Имиджконсультирование -->

<?
if(get_option('g_options')['on_main_image']) :

$post = get_post(1053); // ID Имиджконсультирование

if(user_admin())
{
	/*printArray(get_post_meta(1053));
	printArray($post);*/
}

setup_postdata( $post );
?>

<div class="container-fluid block-image">
	<div class="row-fluid ">
		
		<?
		$thumb_id = get_post_thumbnail_id();
		$thumb_url = wp_get_attachment_image_src($thumb_id, 'imageconsult_thumb', true);
		$thumb_url_mobi = 'http://gantil.ru/wp-content/uploads/2018/01/IMG_5746_2.jpg';

		//$url = get_page_link( $post->ID );
		$url = '/product-category/service/imidzhkonsultirovanie/';
		?>

		<a class="image-img" href="<?php echo $url; ?>">
			<?php //echo the_post_thumbnail('imageconsult_thumb') ?>
			<img class="desktop" src="<?=makeGrayPic($thumb_url[0])?>">
			<img class="mobi" src="<?=makeGrayPic($thumb_url_mobi)?>">
				
			<!--<img src="/wp-content/uploads/2017/08/image.jpg">-->

		</a>
		 <div class="image-name grid-block-button">Имиджконсультирование как искусство создания вашего имиджа</div>
		
		
		<div class="image-menu">
			<ul>
				<li class="menu-left"><a class="grid-block-button" href="/price/">Цены</a></li>
				<li class="menu-center"><a class="grid-block-button" href="<?php echo $url; ?>">Подробнее</a></li>
				<li class="menu-right fancybox-inline"><a class="grid-block-button" onclick="return false;" href="#contact_form_pop_up">Записаться</a></li>
				<div style="clear:both"></div>
			</ul>
		</div> 
	</div>
</div>
<?
endif;
?>
<!-- /Имиджконсультирование -->

<!-- grid SERVICE -->
	<?php 
	if(get_option('g_options')['on_main_butik']) :
		get_template_part('inc/grid-butik');
	endif;
	?>	
<!-- /grid SERVICE -->



<script type="text/javascript">
$(document).ready(function(){
  $('.grid-service-slider').show().slick({
    dots: true,
    infinite: false,				        
    slidesToShow: 4,
    slidesToScroll: 4,
    arrows: false,
    responsive: [
    {
      breakpoint: 980,
      settings: {slidesToShow: 3, slidesToScroll: 3, dots: true }
    },
    {
      breakpoint: 680,
      settings: {slidesToShow: 2, slidesToScroll: 2, arrows: true }
    },
    {
      breakpoint: 480,
      settings: { slidesToShow: 1, slidesToScroll: 1, arrows: true }
    }]
    // prevArrow : '<button type="button" class="slick-prev slick-prev-my">Prev</button>',
    
  });

  	max = 0;
	$('.service-item-name').each(function()
	{
		//alert($(this).height())

		if($(this).height() > max)
			max = $(this).height()
	})
	$('.service-item-name').height(max)

});
</script>

