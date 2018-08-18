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