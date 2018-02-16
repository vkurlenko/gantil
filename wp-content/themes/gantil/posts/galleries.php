<?php
	/**
	 * Products custom post types
	 */

	ST_Galleries::init();
	
	class ST_Galleries extends ST_PostType {

		const POST_TYPE = 'stm_gallery';
		const CATEGORY_TAXONOMY = 'Galleries';
		const CATEGORY_TAXONOMY_SLUG = 'gallery_category';
		

		public static function init(){

			/* Register type */
			self::registerPostType( self::POST_TYPE, __('Галереи', STM_DOMAIN), array(
				'pluralTitle'	=> __('Галереи'),
				'public'		=> true,
				'rewrite'		=> array('slug' => 'galleries'),
				'supports'		=> array('title', 'thumbnail', 'editor', 'custom-fields', 'page-attributes'),
				'hierarchical'	=> true
			));
			
			/* Register taxonomy */
			self::addTaxonomy(self::CATEGORY_TAXONOMY, self::CATEGORY_TAXONOMY_SLUG, self::POST_TYPE );
		}
	}

	function stm_query_galleries($args = ''){
		$defaults = array(
			'post_type'		=> ST_Galleries::POST_TYPE,
			'posts_per_page'=> -1,
		);
		$args = wp_parse_args($args, $defaults);
		return new WP_Query($args);
	}

	

