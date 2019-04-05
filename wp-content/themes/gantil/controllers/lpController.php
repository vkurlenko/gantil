<?php

class lpController
{

	public function getSalons($exclude = []){
		
		$arr = [];

		$root_id = 117; // ID раздела САЛОНЫ


		$args = array(
			'sort_order'   => 'ASC',
			'sort_column'  => 'menu_order',
			'hierarchical' => 0,
			'exclude'      => $exclude,
			'include'      => '',
			'meta_key'     => '',
			'meta_value'   => '',
			'authors'      => '',
			'child_of'     => $root_id,
			'parent'       => -1,
			'exclude_tree' => '',
			'number'       => '',
			'offset'       => 0,
			'post_type'    => 'page',
			'post_status'  => 'publish',
		); 

		$salons = get_pages( $args );

		//printArray($salons); die;

		foreach($salons as $salon){

			setup_postdata( $salon );

			//$meta = get_metadata( 'post', $salon->ID, 'salon_address', true);
			$salon_address_short = get_metadata( 'post', $salon->ID, 'salon_address', true);

			$arr[] = [
				'salon_name' => $salon->post_title,
				'salon_addr' => strip_tags($salon_address_short)
			];

		}

		return $arr;
	}
}

