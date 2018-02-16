<?php
	/**
	 * Sertif custom post types
	 */

	ST_Sertif::init();
	
	class ST_Sertif extends ST_PostType {

		const POST_TYPE = 'stm_sertif';
		const CATEGORY_TAXONOMY = 'Category';
		const CATEGORY_TAXONOMY_SLUG = 'sertif_category';
		

		public static function init(){

			/* Register type */
			self::registerPostType( self::POST_TYPE, __('Sertifs', STM_DOMAIN), array(
				'pluralTitle'	=> __('Сертификаты'),
				'public'		=> true,
				'rewrite'		=> array('slug' => 'sertif'),
				'supports'		=> array('title', 'thumbnail', 'editor')
			));
			
			/* Register taxonomy */
			self::addTaxonomy(self::CATEGORY_TAXONOMY, self::CATEGORY_TAXONOMY_SLUG, self::POST_TYPE );
		}
	}

	function stm_query_sertif($args = ''){
		$defaults = array(
			'post_type'		=> ST_Sertif::POST_TYPE,
			'posts_per_page'=> -1,
		);
		$args = wp_parse_args($args, $defaults);
		return new WP_Query($args);
	}

