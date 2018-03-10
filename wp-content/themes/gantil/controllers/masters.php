<?php

/* проверяем применяется ли фильтр по салонам/специальностям для вывода списка мастеров */
function isFilter($debug = false) 
{

	if($debug) {
		print_r($_SESSION);
	}

	if( (!empty($_SESSION['salon']) && $_SESSION['salon'] != 'all') || (!empty($_SESSION['spec']) && $_SESSION['spec'] != 'all' ) )
		return true;		
	else
		return false;
}
/* /проверяем применяется ли фильтр по салонам/специальностям для вывода списка мастеров */


/* сформируем массив мастеров */
function getMasters($arr, $filter = false)
{

	$posts = array();

	if ($filter) {

		// есть фильтр => рандомно по салонам и специальностям без учета рейтинга

		if (isset($_SESSION['spec']) && $_SESSION['spec'] != 'all')
			$spec = $_SESSION['spec'];
		else
			$spec = $arr[25];

		if (isset($_SESSION['salon']) && $_SESSION['salon'] != 'all')
			$salon = $_SESSION['salon'];
		else
			$salon = $arr[26];		

		$arr_exclude = array('mastertaiskogomassaga', 'balimaster');

		if (in_array($spec, $arr_exclude))
			$arr_exclude = '';

		$param = array(
            'posts_per_page' => 1000,
            'post_type' => ST_Masters::POST_TYPE,
            'orderby'   => 'rand',  
            'order'     => 'DESC',
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
                    'field'    => 'slug',
                    'terms'    => $spec //  специальность
                ),
                array(
                    'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
                    'field'    => 'slug',
                    'terms'    => $salon //   салон                                                              
                ),
                array(
                    'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
                    'field'    => 'slug',
                    'terms'    => $arr_exclude, //  исключить азиатов                                                            
                    'operator' => 'NOT IN'
               )     
            ),    
        );

        $posts = get_posts($param); 

        if (!isset($_SESSION['spec']) || $_SESSION['spec'] == 'all' ) {
        	$param = array(
	            'posts_per_page' => 1000,
	            'post_type' => ST_Masters::POST_TYPE,
	            'orderby'   => 'rand',  
	            'order'     => 'DESC',
	            'tax_query' => array(
	                'relation' => 'AND',
	                array(
	                    'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
	                    'field'    => 'slug',
	                    'terms'    => array('mastertaiskogomassaga', 'balimaster')
	                ),
	                array(
	                    'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
	                    'field'    => 'slug',
	                    'terms'    => $salon //   салон                                                              
	                ) 
	            ),    
	        );

	        $b = get_posts($param); 
	        $posts = array_merge($posts, $b);
        }
	}
	else {
		// нет фильтра => сортировка по рейтингу и рандомно по салонам и специальностям
		$b = array();

		foreach ($arr[499] as $v){
			$param = array(
	            'posts_per_page' => 1000,
	            'post_type' => ST_Masters::POST_TYPE,
	            'orderby'   => 'rand',  
	            'order'     => 'DESC',
	            'tax_query' => array(
	                'relation' => 'AND',
	                array(
	                    'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
	                    'field'    => 'slug',
	                    'terms'    => $arr[25] //  все специальности
	                ),
	                array(
	                    'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
	                    'field'    => 'slug',
	                    'terms'    => $arr[26] //   все салоны                                                             
	                ),
	                array(
                            'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
                            'field'    => 'slug',
                            'terms'    => $v //   рейтинг                                                              
                        ),
	                array(
	                    'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
	                    'field'    => 'slug',
	                    'terms'    => array('mastertaiskogomassaga', 'balimaster'), //  исключить азиатов                                                            
	                    'operator' => 'NOT IN'
	                )                

	            ),    
	        );

			$a = get_posts($param);   
			$b = array_merge($b, $a);   
		}


		// добавим в конец массива азиатов
		foreach ($arr[499] as $v){
			$param = array(
	            'posts_per_page' => 1000,
	            'post_type' => ST_Masters::POST_TYPE,
	            'orderby'   => 'rand',  
	            'order'     => 'DESC',
	            'tax_query' => array(
	                'relation' => 'AND',
	                array(
	                    'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
	                    'field'    => 'slug',
	                    'terms'    => array('mastertaiskogomassaga', 'balimaster') //  все специальности
	                ),
	                array(
	                    'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
	                    'field'    => 'slug',
	                    'terms'    => $arr[26] //   все салоны                                                             
	                ),
	                array(
                            'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
                            'field'    => 'slug',
                            'terms'    => $v //   рейтинг                                                              
                        )          

	            ),    
	        );

			$a = get_posts($param);   
			$b = array_merge($b, $a);   
		}

		$posts = $b;
		
	}
	

   return $posts; 
}
/* /сформируем массив мастеров */