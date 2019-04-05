<?php
//echo 'service';
class Service
{

	public function getServiceCat()
	{
		$arr = array();

	    $args = array(
			'taxonomy'      => array( 'product_cat' ), // название таксономии с WP 4.5
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
			
			$name 	= '';
			$thumb 	= '';
			$img 	= '';
			$link 	= '/product-category/service/';

			// thumbnail
			$thumbnail_id 	= get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
			$thumbnail_img	= wp_get_attachment_url( $thumbnail_id );

			// attached image
			$image_id = get_term_meta( $term->term_id, '_thumbnail_id', 1 );
			

			if($thumbnail_img) 
			{
				$thumb = '<img class="service-item-img" src="' . $thumbnail_img . '" alt="" />';
			}

			if ($image_id) {
				$image_url = wp_get_attachment_image_url( $image_id, 'full' );
				$img =  '<img src="'. $image_url .'" alt="" />';			
			}

			$arr[] = array(
				'id'	=> $term->term_id,
				'name' 	=> $term->name,
				'thumb'	=> $thumb,
				'img'	=> $img,
				'link'	=> $link.$term->slug.'/'
				);

			//printArray($term);
			
		}
		//printArray($arr);
		return $arr;
	}
	
}
		
	
