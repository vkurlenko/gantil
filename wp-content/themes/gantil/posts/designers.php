<?php
	/**
	 * Products custom post types
	 */

	ST_Designers::init();
	
	class ST_Designers extends ST_PostType {

		const POST_TYPE = 'stm_designers';
		const CATEGORY_TAXONOMY = 'Category';
		const CATEGORY_TAXONOMY_SLUG = 'designers_category';
		

		public static function init(){

			/* Register type */
			self::registerPostType( self::POST_TYPE, __('Designers', STM_DOMAIN), array(
				'pluralTitle'	=> __('Дизайнеры'),
				'public'		=> true,
				'rewrite'		=> array('slug' => 'designers'),
				'supports'		=> array('title', 'thumbnail', 'editor', 'custom-fields')/*,
				'taxonomies'	=> array('post_tag')*/
			));
			
			/* Register taxonomy */
			self::addTaxonomy(self::CATEGORY_TAXONOMY, self::CATEGORY_TAXONOMY_SLUG, self::POST_TYPE );
		}
	}

	function stm_query_designers($args = ''){
		$defaults = array(
			'post_type'		=> ST_Designers::POST_TYPE,
			'posts_per_page'=> -1,
		);
		$args = wp_parse_args($args, $defaults);
		return new WP_Query($args);
	}

