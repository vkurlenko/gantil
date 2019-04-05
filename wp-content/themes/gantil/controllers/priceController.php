<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 20.08.2018
 * Time: 12:53
 */

class priceController
{
    public $arr_s_n = array(
        'salon_leninsky' => 'в салоне на Ленинском',
        'salon_bratis' 	 => 'в салоне на Братиславской',
        'salon_sokol' 	 => 'в салоне на Соколе',
        'salon_kolom' 	 => 'в салоне на Коломенской',
        'salon_shodnya'  => 'в салоне на Сходненской',
        'salon_dom_krasoty' => 'в салоне Дом Красоты'
    );

    public $arr_spec = array(
        'veduschiispetcialist' 	=> 'Индивидуальный специалист',
        'topstilist' 			=> 'Топ-стилист',
        'stilist' 				=> 'Стилист',
        'modelier' 				=> 'Модельер',
        'universal'				=> 'Универсал',
        'veduschiispetcialistnogtevogoservisa' => 'Ведущий специалист ногтевого сервиса',
        'spetcialistnogtevogoservisa' => 'Специалист ногтевого сервиса',
        'masternogtevogoservisa' => 'Мастер ногтевого сервиса',
        'kosmetolog' 			=> 'Косметолог',
        'potayuibali' 			=> 'Топ-мастер тайского массажа',
        'mastertaiskogomassaga' => 'Мастер тайского массажа',
        'balimaster' 			=> 'Бали-мастер'
    );

    // получим все подкатегории категории $cid (одного уровня)
    public function getRootCat($cid){
        $a = [];

        $args = array(
            'taxonomy'      => array( 'product_cat'), // название таксономии
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
            'parent'        => $cid, // родительская категория
            'hierarchical'  => true,
            'child_of'      => $cid,
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

        return $a;
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
            $arr_child[] = array(
                'term_id'   => $term->term_id,
                'name'      => $term->name,
                'slug'      => $term->slug,
                'parent'    => $term->parent,
                'arr_child' => self::getCatTree($term->term_id)
                );
        }

    return $arr_child;
    }

    // список (дерево) категорий в облегченном виде
    public function getCatElems($a)
    {
        $list = array();
        foreach($a as $k => $v)
        {
            $list[] = array(
                'lvl'	=> 0,
                'id'	=> $v['term_id'],
                'name' 	=> $v['name'],
                /*'slug'	=> $v['slug'],*/
            );

            if(!empty($v['arr_child']))
            {
                foreach($v['arr_child'] as $k1 => $v1)
                {
                    $list[] = array(
                        'lvl'	=> 1,
                        'id'	=> $v1['term_id'],
                        'name'  => $v1['name'],
                        'slug'	=> $v1['slug']
                    );

                    if(!empty($v1['arr_child']))
                    {
                        foreach($v1['arr_child'] as $k2 => $v2)
                        {
                            $list[] = array(
                                'lvl'	=> 2,
                                'id'	=> $v2['term_id'],
                                'name'  => $v2['name'],
                                'slug'	=> $v2['slug']
                            );

                            if(!empty($v2['arr_child']))
                            {
                                foreach($v2['arr_child'] as $k3 => $v3)
                                {
                                    $list[] = array(
                                        'lvl'	=> 3,
                                        'id'	=> $v3['term_id'],
                                        'name'  => $v3['name'],
                                        'slug'	=> $v3['slug']

                                    );
                                    if(!empty($v3['arr_child']))
                                    {
                                        foreach($v3['arr_child'] as $k4 => $v4)
                                        {
                                            $list[] = array(
                                                'lvl'	=> 4,
                                                'id'	=> $v4['term_id'],
                                                'name' => $v4['name'],
                                                'slug'	=> $v4['slug']
                                            );
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return $list;
    }

    /**
     *список товаров категории $slug
     */
    public function getCatItems($slug)
    {
        $goods = [];

        $args = array(
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    //'field'    => 'slug',
                    'field'    => 'term_id',
                    'terms'    => $slug,
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
        return $goods;
    }

    /**
     * сформируем массив вариаций
     */
    public function getItemData($id)
    {
        global $arr3;
        global $wpdb;
        global $salon;

        $sql = "SELECT * FROM `gn_postmeta` 
		WHERE post_id IN (SELECT post_id 
			FROM gn_postmeta 
			WHERE post_id IN (SELECT ID 
				FROM gn_posts 
				WHERE post_parent = ".$id.") 
			AND meta_value = '".$salon."') 
		AND meta_key IN ('_regular_price', 'attribute_pa_main-key', 'attribute_pa_item_spec', 'attribute_pa_item_salon', '_variation_description', '_purchase_note')";

        $res = $wpdb->get_results($sql);

        $arr1 = $arr2 = array();

        foreach ($res as $row)
        {
            if($row->meta_key == 'attribute_pa_main-key')
                $arr2[$row->meta_value] = $arr3;

            $arr1[$row->post_id][$row->meta_key] = $row->meta_value;
        }

      

        foreach($arr1 as $var => $param)
        {
            $arr2[$param['attribute_pa_main-key']][$param['attribute_pa_item_spec']] = $param['_regular_price'];

            if(empty($arr2[$param['attribute_pa_main-key']]['_variation_description'])){

                if(empty($param['_variation_description']))
                    $param['_variation_description'] = '';

                $arr2[$param['attribute_pa_main-key']]['_variation_description'] = $param['_variation_description'];
            }
        }

        return $arr2;
    }

    /**
     * сформируем парвильную ссылку на услугу/товар
     */
    public function getLink($id = null, $name = '', $tax = 'product_cat')
    {
        $link = '';

        if($id){
            $cur_terms = get_the_terms( $id, $tax );
            $link = get_term_link( $cur_terms[0]->term_id, $tax ).$name."/";

            // преобразуем ссылку вида  http://gantil2/PRODUCT-CATEGORY/service/kosmetologija/inektsionnye-metodiki/
            // в                        http://gantil2/PRODUCT/service/kosmetologija/inektsionnye-metodiki/
            $link = str_replace('product-category', 'product', $link);
        }

        return $link;
    }


    // сформируем строку цен для разных вариаций
    public function getPriceString($pr){
        $string = '';

        foreach($pr as $s => $p)
        {
            if($s == '_variation_description' || $s == '_purchase_note' )
                continue;
            $string .= '<td>'.$p.'</td>';
        }

        return $string;
    }

    // ключевой параметр
    public function getMainKey($main_key) {
        $a = ['name' => ''];

        $a = get_term_by('slug', $main_key, 'pa_main-key' );

        return $a->name;
    }

    // получим предупреждение из поля Дополнительно -> Примечание к покупке
    public function getPurchaseNote($id)
    {
        $purchase_note = get_post_meta( $id, '_purchase_note', true);

        //echo $id;

        if($purchase_note)
            return $purchase_note;
        else
            return false;

    }
}