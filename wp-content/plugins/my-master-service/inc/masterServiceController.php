<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 30.08.2018
 * Time: 11:58
 */

class masterServiceController
{
    // список мастеров
    public function getMasters(){
        $param = array(
            'posts_per_page' => 1000,
            'post_type' => ST_Masters::POST_TYPE,
            'orderby'   => 'title ',
            'order'     => 'ASC'/*,
                'tax_query' => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
                        'field'    => 'slug',
                        'terms'    => $spec //  специальности
                    ),
                    array(
                        'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
                        'field'    => 'slug',
                        'terms'    => $salon //   салоны
                    ),
                    array(
                        'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
                        'field'    => 'slug',
                        'terms'    => $v //   рейтинг
                    ),
                    array(
                        'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
                        'field'    => 'slug',
                        'terms'    => $arr_exclude, //  исключим азиатов
                        'operator' => 'NOT IN'
                    )

                ),*/
        );

        $a = get_posts($param);

        return $a;
    }

    public function getMaster($id){
        $arr = get_post($id);

        return $arr;
    }

    // сохраним в БД список услуг мастера в виде serialize массива
    public function setMasterServices($id, $str){
        global $wpdb;

        $table = 'gn_master_service';
        $data = [
            'master_id' => $id,
            'service_arr' => $str
            ];

        $where = ['master_id' => $id];

        $update = $wpdb->update( $table, $data, $where, ['%d', '%s'], '%d' );

        if(!$update)
            $wpdb->insert( $table, $data, ['%d', '%s'] );
    }

    public function getMasterServices($id){
        global $wpdb;

        $table = 'gn_master_service';
        $query = 'SELECT * FROM '.$table.' 
                    WHERE master_id = '.$id;

        //echo $query;

        $row = $wpdb->get_row($query, ARRAY_A , 0);

        return $row;

    }

    // получим дерево КАТЕГОРИЙ товаров
    public function getCatTree($pid)
    {
        $arr_child = array();

        $args = array(
            'taxonomy'      => array( 'product_cat'), // название таксономии с WP 4.5
            'orderby'       => 'menu_order',
            'order'         => 'ASC',
            'hide_empty'    => false,
            'object_ids'    => null, //
            'include'       => array(),
            'exclude'       => array(),
            'exclude_tree'  => array(),
            'number'        => '',
            'fields'        => 'all',
            'count'         => false,
            'slug'          => '',
            'parent'        => $pid, // родительская категория
            'hierarchical'  => true,
            'child_of'      => $pid,
            'get'           => '', // ставим all чтобы получить все термины
            'name__like'    => '',
            'pad_counts'    => true,
            'offset'        => '',
            'search'        => '',
            'cache_domain'  => 'core',
            'name'          => '', // str/arr поле name для получения термина по нему. C 4.2.
            'childless'     => false, // true не получит (пропустит) термины у которых есть дочерние термины. C 4.2.
            'update_term_meta_cache' => true, // подгружать метаданные в кэш
            'meta_query'    => ''
        );

        $a = get_terms( $args );

        foreach( $a as $term )
        {
            $child = [];
            $is_products = false;

            $child = self::getCatTree($term->term_id);

            if(empty($child)){
                $child = self::getCatItems($term->term_id);
                if(!empty($child))
                    $is_products = true;
            }

            $arr_child[] = array(
                'term_id'   => $term->term_id,
                'name'      => $term->name,
                'slug'      => $term->slug,
                'parent'    => $term->parent,
                'is_products' => $is_products,
                'arr_child' => $child
            );
        }

        return $arr_child;
    }

    /**
     *список товаров категории $slug
     */
    public function getCatItems($cat_id)
    {
        $goods = [];

        $args = array(
            'tax_query' =>array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'term_id',
                    'terms'    => $cat_id,
                    'include_children' => false
                )
            ),
            'post_type' => 'product',
            'posts_per_page' => -1,
            'meta_key'    => '',
            'meta_value'  =>'',
            'orderby'       => 'menu_order',
            'order'         => 'ASC',
        );


        $goods = get_posts( $args );
        $arr = [];

        foreach($goods as $good){
            $arr[] = [
                'ID' => $good->ID,
                'post_title' => $good->post_title,
                'post_name' => $good->post_name
            ];
        }


        return $arr;
    }

    public function getServices(){

    }
}