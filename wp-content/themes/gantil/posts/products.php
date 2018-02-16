<?php
	/**
	 * Products custom post types
	 */

	ST_Products::init();
	
	class ST_Products extends ST_PostType {

		const POST_TYPE = 'stm_products';
		const CATEGORY_TAXONOMY = 'Category';
		const CATEGORY_TAXONOMY_SLUG = 'products_category';
		

		public static function init(){

			/* Register type */
			self::registerPostType( self::POST_TYPE, __('Products', STM_DOMAIN), array(
				'pluralTitle'	=> __('Медицинское оборудование'),
				'public'		=> true,
				'rewrite'		=> array('slug' => 'products'),
				'supports'		=> array('title', 'thumbnail', 'editor')
			));
			
			/* Register taxonomy */
			self::addTaxonomy(self::CATEGORY_TAXONOMY, self::CATEGORY_TAXONOMY_SLUG, self::POST_TYPE );
		}
	}

	function stm_query_products($args = ''){
		$defaults = array(
			'post_type'		=> ST_Products::POST_TYPE,
			'posts_per_page'=> -1,
		);
		$args = wp_parse_args($args, $defaults);
		return new WP_Query($args);
	}

