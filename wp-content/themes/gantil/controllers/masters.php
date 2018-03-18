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
/*function getMasters($arr, $filter = false)
{

	$posts = array();

	//азиаты
	$arr_exclude = array('mastertaiskogomassaga', 'balimaster'); 

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
	                    'terms'    => $arr_exclude, // азиаты
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
	                    'terms'    => $arr_exclude, //  исключить азиатов                                                            
	                    'operator' => 'NOT IN'
	                )                

	            ),    
	        );

			$a = get_posts($param);   
			$b = array_merge($b, $a);   
		}


		// добавим в конец массива азиатов
		foreach ($arr[499] as $v) {
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
	                    'terms'    => $arr_exclude //  азиаты 
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
}*/
/* /сформируем массив мастеров */

/* сформируем массив мастеров */
function getMasters2($arr, $filter = false)
{
	$rating_id = 499;
	$posts = array();

	//printArray($_SESSION);

	//азиаты
	$arr_exclude = array('mastertaiskogomassaga', 'balimaster'); 

	// проверим применен ли фильтр по салонам и/или специальностям
	if (isset($_SESSION['spec']) && $_SESSION['spec'] != 'all')
		$spec = $_SESSION['spec'];	
	else
		$spec = $arr[25];

	if (isset($_SESSION['salon']) && $_SESSION['salon'] != 'all')
		$salon = $_SESSION['salon'];
	else
		$salon = $arr[26];		
	
	// сортировка по рейтингу и рандомно по салонам и специальностям
	$b = array();

	foreach ($arr[$rating_id] as $v) {
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

            ),    
        );

		$a = get_posts($param);   
		$b = array_merge($b, $a);   
	}


	// добавим в конец массива азиатов
	if (!isset($_SESSION['spec']) || $_SESSION['spec'] == 'all' || in_array($_SESSION['spec'],  $arr_exclude)) {

		// если в фильтре выбрана одна из специальностей азиатов, то в выборке используем только ее
		if(in_array($_SESSION['spec'],  $arr_exclude))
			$arr_exclude = $_SESSION['spec'];

		// применим фильтр
    	foreach ($arr[$rating_id] as $v) {
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
	                    'terms'    => $arr_exclude //  азиаты 
	                ),
	                array(
	                    'taxonomy' => ST_Masters::CATEGORY_TAXONOMY_SLUG,
	                    'field'    => 'slug',
	                    'terms'    => $salon //   все салоны                                                             
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
    }

	$posts = $b;
		
	
	

   return $posts; 
}
/* /сформируем массив мастеров */