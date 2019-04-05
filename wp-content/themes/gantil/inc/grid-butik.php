<?php
		
	$arr = array();

    $args = array(
	'taxonomy'      => array( 'product_cat'), // название таксономии с WP 4.5
	'orderby'       => 'menu_order', 
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
	'parent'         => 80, // БУТИК
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
	$link 	= '/product-category/butik/';

	$thumbnail_id 	= get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
	$image 			= wp_get_attachment_url( $thumbnail_id );

	
	if($image) 
	{
		$img = '<img class="service-item-img" src="' . $image . '" alt="'.$term->name.'" />';
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
	<h2 class="frontpage-h2">Бутик</h2>
	<div class="row-fluid grid-service-slider grid-service-slider2">

		<?
		$i = 0;
		foreach($arr as $k => $v)
		{
			if($i > 3)
			{
				$i = 0;
				echo '</div><div class="row-fluid grid-service-slider grid-service-slider2">';
			}
			?>
			<div class="service-item">

				<a href="<?=$v['link']?>"><?=$v['img']?></a>

				<div class="service-item-name grid-block-button"><?=$v['name']?></div>
				
			</div>
			<?
			$i++;
		}
		?>

	</div>
</div>

