<?
$args = array(
    'taxonomy'      => array( 'gallery_category'), 
    'orderby'       => 'menu_order', 
    'order'         => 'ASC',
    'hide_empty'    => true, 
    'object_ids'    => null, // 
    'include'       => array(),
    'exclude'       => array(), 
    'exclude_tree'  => array(), 
    'number'        => '', 
    'fields'        => 'all', 
    'count'         => false,
    'slug'          => '', // здесь выбранный салон и специальность 
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

$arr = array();
foreach($myterms as $k => $v)
{
    if($v->slug == 'video-na-glavnuyu')
        continue;
    
    $arr[] = $v->slug;
    if($v->slug == $arr[0])
        $class='class="active"';
    else
        $class = '';
    ?><li class="page_item"><a <?=$class?> href="/gallery_category/<?=$v->slug;?>/"><?=$v->name;?></a></li><?
}

wp_reset_postdata();
?>