<?php
$args = array(
    'taxonomy'      => array( ST_Masters::CATEGORY_TAXONOMY_SLUG ), // название таксономии с WP 4.5
    'orderby'       => 'id', 
    'order'         => 'ASC',
    'hide_empty'    => true, 
    'object_ids'    => null, // 
    'include'       => array(),
    'exclude'       => array(), 
    'exclude_tree'  => array(), 
    'number'        => '', 
    'fields'        => 'all', 
    'count'         => false,
    'slug'          => '', 
    'parent'         => '',
    'hierarchical'  => true, 
    'child_of'      => 0, 
    'get'           => 'all', // ставим all чтобы получить все термины
    'name__like'    => '',
    'pad_counts'    => false, 
    'offset'        => '', 
    'search'        => '', 
    'cache_domain'  => 'core',
    'name'          => '', // str/arr поле name для получения термина по нему. C 4.2.
    'childless'     => true, // true не получит (пропустит) термины у которых есть дочерние термины. C 4.2.
    'update_term_meta_cache' => true, // подгружать метаданные в кэш
    'meta_query'    => '',
); 

$myterms = get_terms( $args );
print_r($myterms);

?>