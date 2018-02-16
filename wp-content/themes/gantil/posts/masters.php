<?php
	/**
	 * Products custom post types
	 */

	ST_Masters::init();
	
	class ST_Masters extends ST_PostType {

		const POST_TYPE = 'stm_masters';
		const CATEGORY_TAXONOMY = 'Category';
		const CATEGORY_TAXONOMY_SLUG = 'masters_category';
		

		public static function init(){

			/* Register type */
			self::registerPostType( self::POST_TYPE, __('Masters', STM_DOMAIN), array(
				'pluralTitle'	=> __('Мастера'),
				'public'		=> true,
				'rewrite'		=> array('slug' => 'masters'),
				'supports'		=> array('title', 'thumbnail', 'editor')/*,
				'taxonomies'	=> array('post_tag')*/
			));
			
			/* Register taxonomy */
			self::addTaxonomy(self::CATEGORY_TAXONOMY, self::CATEGORY_TAXONOMY_SLUG, self::POST_TYPE );
		}
	}

	function stm_query_masters($args = ''){
		$defaults = array(
			'post_type'		=> ST_Masters::POST_TYPE,
			'posts_per_page'=> -1,
		);
		$args = wp_parse_args($args, $defaults);
		return new WP_Query($args);
	}

