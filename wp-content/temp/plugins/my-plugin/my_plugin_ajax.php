<?php
//header('Content-type: text/html; charset=utf-8');

/*

Plugin Name: AJAX подгрузка списка

*/

add_action('wp_ajax_hello', 'say_hello');
add_action('wp_ajax_nopriv_hello', 'say_hello');

function say_hello()
{

	$html = '';

   
    if(!empty($_GET['spec']) && !empty($_GET['salon']))
    {        
        make_list($_GET['spec'], $_GET['salon']);
    }        
    else
    {
        $html = '<span>Выберите салон и специальность мастера</span>';
        echo $html;
        wp_die(); 
    }
        	
}

function make_list($spec, $salon)
{
    $slug = array();
    $slug[] = $spec;
    $slug[] = $salon;

    $html = '';

    $args = array(
        'taxonomy'      => array( ST_Masters::CATEGORY_TAXONOMY_SLUG ), 
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
        'slug'          => $slug, // здесь выбранный салон и специальность 
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

    foreach( $myterms as $term )
    {
        if($term->slug == 'salon' || $term->slug == 'spec') continue;     
        //$arr[] = $term->slug;
        $arr[] = $term->slug;
    }

    //print_r($arr);

    $args1 = array(
        'numberposts' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
                'field'    => 'slug',
                'terms'    => $arr,
                'operator' => 'AND'
            )
        ),
        'orderby' => 'rand',
        'post_type' => ST_Masters::POST_TYPE
    ) ;

    

    $posts = get_posts( $args1 );

    $master_color = 'watch-all';
    foreach($posts as $k)
    {
        //$arr[] = array('title' => $k->post_name, 'name' => $k->post_name);
        //$html .= '<option value="'.$k->post_title.'"  class="attached enabled">'.$k->post_title.'</option>';
        $thumbnail = get_the_post_thumbnail( $k->ID, array(50, 50), '' );

        $cat = get_the_terms(  $k->ID, ST_Masters::CATEGORY_TAXONOMY_SLUG);
        foreach($cat as $a)
        {
            if($a->parent == 151)  $master_color = 'watch-'.$a->slug; // цвет
        }

        //print_r($cat);
        
        $html .= '<li class="item-master '.$master_color.'">'.$thumbnail.'<a href="#" ><span class="master_name">'.$k->post_title.'</span></a></li>';
        
    }

    if($html != '')
        $html .= '<li class="item-master watch-all"><img src="/wp-content/uploads/2017/08/1.gif" width=50><a href="#" ><span class="master_name">Любой мастер</span></a></li>';
    else
        $html = '<span>Нет мастеров выбранной специальности</span>';

    echo $html;
    //wp_send_json($arr);
    //print_r($posts);

    // $master = get_post(290);

    // $name = $master->post_title;

    // echo $name;

    wp_die(); 
}
